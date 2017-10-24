<?php
if (!defined('IN_IAEWEB')) exit();

use EasyWeChat\Foundation\Application;
use Ender\YunPianSms\SMS\YunPianSms;
use Curl\Curl;

abstract class Base
{

    protected $db;
    protected $view;
    protected $cookie;
    protected $session;
    protected $site_config;
    protected $category_cache;
    protected $content_model;
    protected $member_info;
    protected $self_url;
    protected $sex;

    public function __construct()
    {
        if (get_magic_quotes_runtime()) @set_magic_quotes_runtime(0);
        if (get_magic_quotes_gpc()) {
            $_POST = $this->strip_slashes($_POST);
            $_GET = $this->strip_slashes($_GET);
            $_SESSION = $this->strip_slashes($_SESSION);
            $_COOKIE = $this->strip_slashes($_COOKIE);
        }
        if (defined('IAEWEB_ADMIN') || defined('IAEWEB_MEMBER')) {
            define('SITE_PATH', self::get_a_url());
        } else {
            define('SITE_PATH', self::get_base_url());
        }
        if (!is_file(IAEWEB_PATH . 'data/install.lock')) self::redirect(url('install/index'));
        if (is_file(IAEWEB_PATH . 'member' . DIRECTORY_SEPARATOR . 'index.php'))
		define('IAEWEB_MEMBER', IAEWEB_PATH . 'member' . DIRECTORY_SEPARATOR);
        $this->db = iaeweb::load_class('Model');
        $this->view = iaeweb::load_class('view');
        $this->cookie = iaeweb::load_class('cookie');
        $this->session = iaeweb::load_class('session');
        $this->site_config = iaeweb::load_config('config');
        echo 111;exit;
        $this->category_cache = get_cache('category');
        $this->content_model = get_cache('content_model');
        $this->member_info =  self::get_member_info();
        $this->self_url =  self::get_self_url();
        $this->sex = ['未知','男','女'];
        $this->view->assign(array(
            'arraysex' => $this->sex,
            'cats' => $this->category_cache,
            'member' => $this->member_info,
            'site_url' => self::get_http_host() . SITE_PATH,
            'site_name' => $this->site_config['site_name'],
            'page' => (int)self::get('page') ? (int)self::get('page') : 1,
            'site_template' => SITE_PATH . basename(TEMPLATE_DIR) . '/' . basename(SYS_THEME_DIR) . '/',
        ));
    }

    public function show_message($msg, $status = 2, $url = HTTP_REFERER, $time = 1800)
    {
        if($this->get('ajax') || $this->post('ajax')) {
            header("Content-type: application/json");
            $re['code'] = $status;
            $re['msg'] = $msg;
            $re['url'] = $url;
            echo json_encode($re);
        } else {
            include CORE_PATH . 'img' . DIRECTORY_SEPARATOR . 'message' . DIRECTORY_SEPARATOR . 'iaeweb_msg.tpl.php';
        }
        exit;
    }

    protected function get_user_ip($default = '0.0.0.0')
    {
        $keys = array('HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'REMOTE_ADDR');
        foreach ($keys as $key) {
            if (!isset($_SERVER[$key]) || !$_SERVER[$key]) {
                continue;
            }
            return htmlspecialchars($_SERVER[$key]);
        }
        return $default;
    }

    public static function get($string)
    {
        if (!isset($_GET[$string])) return null;
        if (!is_array($_GET[$string])) return htmlspecialchars(trim($_GET[$string]));
        return null;
    }

    public static function post($string)
    {
        if (!isset($_POST[$string])) return null;
        if (!is_array($_POST[$string])) return htmlspecialchars(trim($_POST[$string]));
        $postArray = self::array_map_htmlspecialchars($_POST[$string]);
        return $postArray;
    }

    protected static function array_map_htmlspecialchars($string)
    {
        foreach ($string as $key => $value) {
            $string[$key] = is_array($value) ? self::array_map_htmlspecialchars($value) : htmlspecialchars(trim($value));
        }
        return $string;
    }

    public static function get_http_host()
    {
        $http_host = strtolower($_SERVER['HTTP_HOST']);
        $secure = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 1 : 0;
        return ($secure ? 'https://' : 'http://') . $http_host;
    }

    public static function get_base_url()
    {
        $url = str_replace(array('\\', '//'), '/', $_SERVER['SCRIPT_NAME']);
        $po= strripos($url,'/');
        return substr($url,0,$po+1);
    }

    public static function get_a_url()
    {
        $url = str_replace(array('\\', '//'), '/', $_SERVER['SCRIPT_NAME']);
        $po = strripos($url,'/');
        $url = substr($url,0,$po);
        $po = strripos($url,'/');
        return substr($url,0,$po+1);
    }

    protected function redirect($url)
    {
        if (!$url) return false;
        if (!headers_sent()) header("Location:" . $url);
        else  echo '<script type="text/javascript">location.href="' . $url . '";</script>';
        exit();
    }

    protected static function strip_slashes($string)
    {
        if (!$string) return $string;
        if (!is_array($string)) return stripslashes($string);
        foreach ($string as $key => $value) {
            $string[$key] = self::strip_slashes($value);
        }
        return $string;
    }

    protected function checkCode($value)
    {
        $code = $this->session->get('checkcode');
        $value = strtolower($value);
        $this->session->delete('checkcode');
        return $code == $value ? true : false;
    }

    protected function checksmsCode($value)
    {
        $code = $this->session->get('smsCode');
        $value = strtolower($value);
        $this->session->delete('smsCode');
        return $code == $value ? true : false;
    }

    protected function watermark($file)
    {
        if (!$this->site_config['site_watermark']) return false;
        $image = iaeweb::load_class('image');
        $image->watermark($file, $this->site_config['site_watermark_pos']);
    }

    protected function get_member_info()
    {
        if (!defined('IAEWEB_MEMBER') || defined('IAEWEB_ADMIN')) return false;
        if ($this->cookie->get('member_id') && $this->cookie->get('member_code')) {
            $id = (int)$this->cookie->get('member_id');
            $code = $this->cookie->get('member_code');
            if (!empty($id) && $code == substr(md5($this->site_config['rand_code'] . $id), 5, 20)) {
                $member = $this->db->setTableName('member')->find($id);
                if ($member) {
				    $member_model = get_cache('member_model');
                    $member_info = $this->db->setTableName($member_model[$member['modelid']]['tablename'])->find($id);
                    if ($member_info) {
                        $member = array_merge($member, $member_info);
                    }
                    if(empty($member['avatar'])) $member['avatar']="/assets/images/avatar.png";
                   return $member;
                }
            }
        }
        return false;
    }

    protected function get_data_fields($fields, $data = array())
    {
        if (empty($fields)) return false;
        $field = iaeweb::load_class('field');
        $data_fields = '';
        foreach ($fields as $t) {
            if (!defined('IAEWEB_ADMIN') && !$t['isshow']) continue;
            $data_fields .= '<tr><th>' . (!empty($t['pattern']) ? ' <font color="red">*</font> ' : '') . $t['name'] . '：</th><td>';
            $t['setting'] = $t['setting'] ? string2array($t['setting']) : 0;
            $content = !isset($data[$t['field']]) ? $t['setting']['defaultvalue'] : $data[$t['field']];
            if (method_exists($field, $t['formtype']))
                $data_fields .= $field->$t['formtype']($t['field'], $content, $t['setting']);
            $data_fields .= ($t['tips'] ? '<div class="onShow">' . $t['tips'] . '</div>' : '') . '</td></tr>';
        }
        return $data_fields;
    }

    protected function get_data_fields_wechat($fields, $data = array())
    {
        if (empty($fields)) return false;
        $field = iaeweb::load_class('fieldWechat');
        $data_fields = '';
        foreach ($fields as $t) {
            if (!defined('IAEWEB_ADMIN') && !$t['isshow']) continue;


            //$data_fields .= '<tr><th>' . (!empty($t['pattern']) ? ' <font color="red">*</font> ' : '') . $t['name'] . '：</th><td>';
            if($t['formtype'] == "select") {
                $data_fields .='<div class="weui_cell weui_cell_select weui_select_after">';
            } else {
                $data_fields .='<div class="weui_cell">';
            }
            if($t['formtype'] !='textarea') $data_fields .='<div class="weui_cell_hd"><label class="weui_label">' . $t['name'] . (!empty($t['pattern']) ? ' <font color="red">*</font> ' : '') . '</label></div>';
            $t['setting'] = $t['setting'] ? string2array($t['setting']) : 0;
            $content = !isset($data[$t['field']]) ? $t['setting']['defaultvalue'] : $data[$t['field']];
            $tips = $t['tips'] ? $t['tips'] : '请输入'.$t['name'];
            $inputtype = !empty($t['inputtype']) ? $t['inputtype'] : "text";
            if (method_exists($field, $t['formtype'])) $data_fields .= $field->$t['formtype']($t['field'], $content, $t['setting'], $tips,$inputtype);
            //$data_fields .= ($t['tips'] ? '<div class="onShow">' . $t['tips'] . '</div>' : '') . '</td></tr>';

            $data_fields .='</div>';
        }
        return $data_fields;
    }

    protected function post_check_fields($fields, $data)
    {
        foreach ($fields as $t) {
            if (!defined('IAEWEB_ADMIN') && !$t['isshow']) continue;
            if ($t['pattern']) {
                if ($t['pattern'] == 1) {
                    if ($data[$t['field']] == '') $this->show_message(empty($t['errortips']) ? $t['name'] . '不能为空' : $t['errortips'],2,1);
                } else {
                    if (!preg_match($t['pattern'], $data[$t['field']])) $this->show_message(empty($t['errortips']) ? $t['name'] . '格式不正确' : $t['errortips'],2,1);
                }
            }
//			if (in_array($t['formtype'], array('checkbox', 'files', 'diy'))) $data[$t['field']] = array2string($data[$t['field']]);
			if ($t['formtype']=='related'){
				$data[$t['field']]= explode(',', $data[$t['field']]);
				foreach( $data[$t['field']] as $k=>$v){
				   if(!$v) unset( $data[$t['field']][$k] );
				}
				$data[$t['field']] = implode(',', $data[$t['field']]);
			}
            if (is_array($data[$t['field']])) $data[$t['field']] = array2string($data[$t['field']]);
        }
        return $data;
    }

    protected function handle_fields($fields, $data)
    {
        foreach ($fields as $t) {
            if (in_array($t['formtype'], array('checkbox', 'files', 'diy'))) $data[$t['field']] = string2array($data[$t['field']]);
            if ($t['formtype'] == 'editor') $data[$t['field']] = htmlspecialchars_decode($data[$t['field']]);
        }
        return $data;
    }

    protected function listSeo($cat, $page = 1)
    {
        $seo_title = $seo_keywords = $seo_description = '';
        $seo_title = empty($cat['seo_title']) ? self::get_title($cat['catid']) : $cat['seo_title'] . ' - ';
        $seo_title = $page > 1 ? $cat['catname'] . ' - 第' . $page . '页 - ' . $this->site_config['site_name'] : $seo_title . $this->site_config['site_name'];
        $seo_keywords = empty($cat['seo_keywords']) ? self::get_title($cat['catid']) . ',' . $this->site_config['site_keywords'] : $cat['seo_keywords'];
        $seo_description = empty($cat['seo_description']) ? $this->site_config['site_description'] : $cat['seo_description'];
        return array('site_title' => $seo_title, 'site_keywords' => $seo_keywords, 'site_description' => $seo_description);
    }

    protected function showSeo($data, $page = 1)
    {
        $seo_title = $seo_keywords = $seo_description = '';
        $listseo = self::listSeo($this->category_cache[$data['catid']]);
        $seo_title = $data['title'] . ' - ' . ($page > 1 ? '第' . $page . '页' . ' - ' : '') . $listseo['site_title'];
        $seo_keywords = empty($data['keywords']) ? $listseo['site_keywords'] : $data['keywords'] . ',' . $listseo['seo_keywords'];
        $seo_description = empty($data['description']) ? $listseo['site_description'] : $data['description'];
        return array('site_title' => $seo_title, 'site_keywords' => $seo_keywords, 'site_description' => $seo_description);
    }

    protected function get_title($catid)
    {
        $catids = parentids($catid, $this->category_cache);
        $catids = explode(',', $catids);
        $title = '';
        foreach ($catids as $t) {
            if ($t) $title .= $this->category_cache[$t]['catname'] . ' - ';
        }
        return $title;
    }

    protected function getWechatServe($option_oauth = array()){
         $options = array(
            'debug'     => true,
            'app_id'    => $this->site_config['appid'],
            'secret'    => $this->site_config['appsecret'],
            'token'     => $this->site_config['token'],
            'aes_key'   => null, // 可选
            'log' => array(
                'level' => 'debug',
                'file'  => IAEWEB_PATH.'data/cache/easywechat.log',
            ),
        );
        if(count($option_oauth)>0) $options['oauth'] = $option_oauth;
        $app = new Application($options);
        return $app;
    }

    protected function get_self_url(){
        // $re = $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"];
        // if (empty($_SERVER["QUERY_STRING"])) $re = $_SERVER["PHP_SELF"];
        return $_SERVER["REQUEST_URI"];
    }

    protected function autoReg(){
        $modelid = $this->get('mid');
        // 未登录 写入 target_url
        //if(!$this->session->get('target_url') && (!$this->member_info || $this->member_info['status'] != 1)) $this->session->set('target_url',$this->self_url);
        $callback = "/";
        if(!empty($modelid)) $callback="/?mid=".$modelid;
        $option_oauth =  [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => $callback,
            ];
        if (empty($this->session->get('wechat_user'))) {
            $app = $this->getWechatServe($option_oauth);
            $oauth = $app->oauth;
            if($this->get('code')){
                $user = $oauth->user()->toArray();
                $this->session->set('wechat_user',$user);
            } else {
                $oauth->redirect()->send();
            }
        } else {
            $user = $this->session->get('wechat_user');
        }

        //判断 会员 类型 首次微信登录有效
        $user['modelid'] = $this->site_config['member_modelid'];
        if($modelid > 0) $user['modelid'] = $modelid;
        //print_r($user);
        //print_r($modelid);
        //exit(0);
        if(!$this->member_info || $this->get('mid')) $this->connectLogin($user); //登录并注册
    }

    protected function connectLogin($uinfo) {
        $target_url = $this->session->get('target_url');
        $member_model = get_cache('member_model');
        $oid = $uinfo['id'];
        $u = $this->db->setTableName('member_connect')->getOne(['openid=?','modelid='.$uinfo['modelid']], $oid);
        $qr = $this->db->setTableName('diy_qrcode')->getOne(['openid=?'], $oid);

        if (empty($u)){
            $data = array();
            $data['avatar'] = $uinfo['avatar'];
            $data['username'] = time();
            $data['name'] = !empty($uinfo['name']) ? $uinfo['name'] : $uinfo['nickname'];
            $data['password'] = rand(111111, 999979799);
            $data['email'] = !empty($uinfo['email']) ? $uinfo['email'] : time().'@yiyi.hnzhixi.com';
            $data['sex'] = $uinfo['sex'] != 0 ? $uinfo['sex'] : 1;
            $data['regdate']  = time();
            $data['regip']    = $this->get_user_ip();
            $data['status']   = $this->site_config['member_status'] ? 0 : 1;
            //$data['modelid']  = (!isset($data['modelid']) || empty($data['modelid'])) ? $this->site_config['member_modelid'] : $data['modelid'];
            $data['modelid'] = empty($uinfo['modelid']) ? $this->site_config['member_modelid'] : $uinfo['modelid'];

            if($data['modelid'] == 5 && !empty($qr)) $data['userid'] = $qr['docid'];//二维码过来的 关联 id

            if (!isset($member_model[$data['modelid']])) $this->show_message('会员模型不存在',2,1);
            $data['id']= $this->db->setTableName('member')->insert($data,true);
            if ($data['id']) {
                $this->db->setTableName($member_model[$data['modelid']]['tablename'])->insert($data);
                $u['uid'] = $data['id'];
                $u['openid'] = $oid;
                $u['modelid'] = $data['modelid'];
                $this->db->setTableName('member_connect')->insert($u);
            }else {
                $this->show_message('注册失败',2,10);
            }
            cookie::set('member_id', $data['id']);
            cookie::set('member_code', substr(md5($this->site_config['rand_code'] . $data['id']), 5, 20));
            //$this->show_message('注册成功',1, $_SESSION['target_url']);
            //$this->session->delete('target_url');
            $this->redirect('/');
        } else {
            $data = $this->db->setTableName('member')->getOne('id=?', $u['uid']);
            cookie::set('member_id', $data['id']);
            cookie::set('member_code', substr(md5($this->site_config['rand_code'] . $data['id']), 5, 20));
            //$this->show_message('注册成功',1, $_SESSION['target_url']);
            //$this->session->delete('target_url');
            $this->redirect('/');
        }
    }

    protected function createMassage($type,$userid,$url,$date = null){
        $userinfo = $this->db->setTableName('member')->find($userid);

        $phone = $userinfo['phone'];

        if($userinfo['modelid'] == 7) $doctor = $userinfo;

        if($userinfo['modelid'] != 7 && $userinfo['userid'] > 0) $doctor = $this->db->setTableName('member')->find($userinfo['userid']);

        $data['userid']= $userid;
        $data['type']= $type;
        $data['time'] = time();

        $datetime = date('Y年m月d日H:i:s',time());
        if(!empty($date)) $datetime = date('Y年m月d日H:i:s',$date);
        if($type==1) $data['msg']= "您好，{$doctor['name']} 医生，您辖区的居民在 {$datetime} 有寻医问药方面的问题咨询您，请您查看并回复。";
        if($type==2) $data['msg']= "您好，{$doctor['name']} 医生，您辖区的居民在 {$datetime} 有健康问题向您提问，请及时关注他的健康状况。";
        if($type==3) $data['msg']= "您好，{$userinfo['name']}，居民健康宝于 {$datetime} 收到您提交的健康问题，医生正在为您解答，请随时关注您的短信、微信或站内消息，及时查收问题答案。";

        if($type==4) $data['msg']= "您好，{$userinfo['name']}，您于{$datetime}在居民健康宝提出的健康问题已经有医生回复，请注意查看。";

        if($type==6) $data['msg']= "您好，{$userinfo['name']}，居民健康宝于 {$datetime} 收到您的投诉，我们将及时处理，并通过电话将处理结果反馈给您。";
        if($type==7) $data['msg']= "您好，{$userinfo['name']}，您的家庭医生（{$doctor['name']}）已于 {$datetime} 新增了您的体检报告（预警信息），你可以点击查看。";

        if($type==8) $data['msg']= "您好，{$doctor['name']}医生，您于{$datetime}向宜医助手反馈了您的意见，我们会尽快了解并及时给您答复。";
        if($type==9) $data['msg']= "{$userinfo['name']}，您于{$datetime}向宜医助手反馈了您的意见，我们会尽快了解并及时给您答复。";

        if($type==20) $data['msg']= "您的血压异常，请您按时服药或找您的家庭医生就医。";


        if($phone > 0) $this->sendYp($phone,'【宜医助手】'.$data['msg']);

        $data['url']= $url;
        $data['status']= 0;
        $this->db->setTableName('diy_message')->insert($data,true);
    }

    protected function sendYp($phone,$msg){
        $yunpianSms = new YunPianSms("215c3cd5786de5dea8eee04bea0ed781");
        return $response = $yunpianSms->sendMsg($phone,$msg);
    }


    /*API 签名*/
    protected function xywysign($gpParams,$secret = "xr2osW+QL*vYXdvP"){
        //var_dump($secret);
        $signStr = urldecode(http_build_query($gpParams));
        //var_dump($signStr);
        $sign = md5($signStr . $secret);
        return $sign;
    }

    /*API 寻医问药接口*/
    protected function askxywy($content,$catid){
        $con = $content['content'];
        if($catid == 8) $con = $con.$this->site_config['xywy_ask'];
        $files = unserialize($content['files']);

        if($this->member_info['modelid'] == 7) {
            $d = $this->db->setTableName('member_doctor')->where('id=?', $this->member_info['id'])->getOne();
            $age = birthday($d['brithday']);
        } else {
            $c = $this->db->setTableName('content_users')->where('id=?', $this->member_info['cid'])->getOne();
            $age = birthday($c['birthday']);
        }

        if(!$age) $age=20;

        $deviceid = "yiyi".$this->member_info['id'];
        $uerid = $this->member_info['pid'];

        $get_array = array(
            'os' => 'Ios',
            'api'=>809,
            'pro'=>'xywyf32l24WmcqquqqTdhXZ8lQ',
            'source'=>'yiyi',
            'version'=>'1.1'
        );
        $post_array = array(
            'con'=>$con,
            'sex'=>$this->member_info['sex'],
            'agetype'=>1,
            'age'=>$age,
            'ques_from'=>'yiyi'
        );
        if($uerid > 0) {
            $post_array['uid'] = $uerid;
        } else {
            $post_array['deviceid'] = $deviceid;
        }

        $array = array_merge($get_array,$post_array);
        ksort($array);
        reset($array);
        // var_dump($array);

        $sign = $this->xywysign($array);
        $get_array['sign'] = $sign;

        if(!empty($files)) {
            foreach ($files['fileurl'] as $key => $value) {
                if($key == 0) $post_array['imgfile'] = IAEWEB_PATH.$files['fileurl'][0];
                if($key == 1) $post_array['imgfile1'] = IAEWEB_PATH.$files['fileurl'][1];
                if($key == 2) $post_array['imgfile2'] = IAEWEB_PATH.$files['fileurl'][2];
            }
        }

        $url = 'http://api.wws.xywy.com/api.php/club/ask/index?'.http_build_query($get_array);

        $curl = new Curl;
        $curl->post($url,$array);


        if ($curl->error) {
            return $curl->error_code;
        } else {
            $response = json_decode($curl->response);

            if(!$uerid && $response->data->pid) {
                //var_dump($response);
                $me['pid'] = $response->data->pid;
                $this->db->setTableName('member')->update($me,'id=?',$this->member_info['id']);
            }

            return $response;
            // if($response['code'] == 10000) {
            //     // $this->db->setTableName('content_ask')->where('id=?', $cid)->update(array(
            //     //         'qid' => $response->qid,
            //     //         'departid' => $response->departid,
            //     //     ));
            // } else {

            // }
        }

    }

    protected function sendWechatSms($uid,$url,$data){
        $connect = $this->db->setTableName('member_connect')->getOne('uid=?',$uid);
        $userId = $connect['openid'];

        $app = $this->getWechatServe();
        $notice = $app->notice;

        $templateId = 'B8Lo3pvtcV7uWIQk1KN8MzoNo48Z7eIJMiVXAxzlmF0';
        //$templateId = 'OGVOQqYLN6cPiWgluBCmaHzwuaBbJz2L0yJqCBrSuK4';//test

        $url = $url;
        $color = '#FF0000';

        $messageId = $notice->uses($templateId)->withUrl($url)->andData($data)->andReceiver($userId)->send();

        return $messageId;

    }

}
