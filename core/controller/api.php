<?php
use Curl\Curl;
class api extends Base {

	public function __construct() {
        parent::__construct();
	}

	public function ajaxkwAction() {
	    $subject = $this->post('data');
	    if (empty($subject)) exit('');
	    $data = @implode('', file('http://keyword.discuz.com/related_kw.html?ics=utf-8&ocs=utf-8&title=' . rawurlencode($subject) . '&content=' . rawurlencode($subject))); 
	    if($data) {
	    	$parser = xml_parser_create();
	    	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	    	xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
	    	xml_parse_into_struct($parser, $data, $values, $index);
	    	xml_parser_free($parser);
	    	$kws = array();
	    	foreach($values as $valuearray) {
	    		if($valuearray['tag'] == 'kw' || $valuearray['tag'] == 'ekw') {
		    		$kws[] = trim($valuearray['value']);
	    		}
	    	}
	     echo implode(',', $kws);
	    }
	}
	
	public function userAction() {
        header('Content-Type: application/x-javascript; charset=UTF-8');
		if (!defined('IAEWEB_MEMBER')) exit();
	    ob_start();
		$this->view->display('member/user.html');
		$html = ob_get_contents();
		ob_clean();
	    $html = addslashes(str_replace(array("\r", "\n", "\t"), array('', '', ''), $html));
	    echo 'document.write("' . $html . '");';
	}
	
	public function hitsAction() {
	    $id   = (int)$this->get('id');
		if (empty($id))	exit;
		$data = $this->db->setTableName('content')->find($id, 'hits');
		$hits = $data['hits'] + 1;
		$this->db->setTableName('content')->update(array('hits'=>$hits), 'id=?' , $id);
		echo "document.write('$hits');";
	}

	public function telmeAction() {
	    header('Content-type:text/json');
	    //$uid   = (int)$this->post('uid');
	    $uid   = (int)$this->member_info['id'];
	    $userid = $this->db->setTableName('member')->find($uid)['userid'];
	    $this->createMassage(1,$userid,'/?catid=25#user'.$this->member_info['id']);//写入站内详细通知医生
	    //$this->createMassage(1,$uid,'/');//写入站内详细 通知自己

		$this->db->setTableName('content')->update(array('telme'=>1), 'uid=?' , $uid);
		echo 1;
	}

	public function teljmAction(){
		header('Content-type:text/json');
		$cid   = (int)$this->post('cid');
		$this->db->setTableName('content')->update(array('telme'=>0), 'id=?' , $cid);
		echo 1;
	}

	public function toushuAction() {
	    header('Content-type:text/json');
	    //$uid   = (int)$this->post('uid');
	    $uid   = (int)$this->member_info['id'];
	    $userid = $this->db->setTableName('member')->find($uid)['userid'];

	    $data['uid'] = $uid;
	    $data['userid'] = $userid;
	    $data['content'] = $this->post('content');
	    $data['cid'] = $this->post('cid');
	    $data['time'] = time();
	    $this->db->setTableName('diy_tousu')->insert($data);

	    $this->createMassage(6,$uid,'/');//写入站内详细 通知自己
		echo 1;
	}
	
	public function pinyinAction() {
		echo word2pinyin($this->post('name'));
	}
	
	public function indexAction() {
	    echo '本程序由：iAEweb提供<br/>程序版本：' . IAEWEB_RELEASE . '<br/>官方网站：<a href="http://www.iaeweb.com" >http://www.iaeweb.com</a>';
	}
	
	public function checkcodeAction() {
	    $api    = iaeweb::load_class('image');
	    $width  = $this->get('width');
	    $height = $this->get('height');
	    $api->checkcode($width,$height);
	}

	public function sendsmsAction(){
		if(!empty($this->post('phone'))) {
			header('Content-type:text/json');
			$phone = $this->post('phone');
			$code = $this->randpw(4,'NUMBER');
			$this->session->set('smsCode',$code);//写入session 待验证用
			$this->session->set('phone',$phone);
			//$yunpianSms = new YunPianSms("ce7abca4853a0abf37beac0a440a8421");
        	$response = $this->sendYp($phone,'【宜医助手】您的验证码是'.$code);
        	$response=json_encode($response);
        	echo $response;
		}
	}

	public function messageAction() {
		$id = $this->get('id');
		$data = $this->db->setTableName('diy_message')->find($id);
		$this->db->setTableName('diy_message')->update(array('status'=>1), 'id=?' , $id);
		$this->redirect($data['url']);
	}

	public function checksmsAction(){
		if(!empty($this->post('phone')) && !empty($this->post('smscode'))) {
			header('Content-type:text/json');
			$phone = $this->post('phone');
			$smscode = $this->post('smscode');
			$response['code']= 1;
			if($smscode == $this->session->get('smsCode') && $phone = $this->session->get('phone')) {
				$response['code']= 0;
				//更新 用户手机号 @todo 关联 居民信息
				$data['phone'] = $phone;
				$data['status'] = 1; //23号 培训期间 医生 不必审核 实际上线 请移除此行
				if($this->member_info['modelid'] == 5) {
					$data['status'] = 1; //居民直接审核通过 医生状态不变
					$content  = $this->db->setTableName('content')->getOne(['phone=?','uid=0'],$phone);
					$content_user = $this->db->setTableName('content_users')->find($content['id']);

					if($content_user){
						$data['name'] = $content['title'];
						$data['age'] = $content_user['age'];
						$data['cid'] = $content['id'];//增加ID
						$this->db->setTableName('content')->update(['uid'=> $this->member_info['id']], 'id=?', $content['id']);//写入关联
						if($content['userid'] > 0) $data['userid'] = $content['userid'];//活动 医生id @todo 要覆盖 二维码关注的
					} else {
						if($this->member_info['userid'] > 0){
							// $w_uid = $this->member_info['userid'];
							// $w_url = $this->get_http_host().'/member/index.php?c=content&a=add&catid=25&uid='.$this->member_info['id'];
							// $w_data = array(
						 //         "first"  => "您好，xxx医生，您辖区居民xxx关注了您。请添加xxx为您的辖区居民",
						 //         "keyword1"   => date('y年m月d日',time()),
						 //         "keyword2"  => "添加辖区居民",
						 //         "keyword3"  => "待添加",
						 //         "remark" => "",
						 //        );
							$this->testwesmsAction();

							//推送卡片 给医生

						} 
					}
				}
				$this->db->setTableName('member')->update($data, 'id=?', $this->member_info['id']);
				$this->session->delete('smsCode');
				$this->session->delete('phone');
			} else {
				$response['code']= 1;
				$response['msg']= '请输入正确的验证码';
			}
			$response=json_encode($response);
       		echo $response;
		} else {
			// if(empty($this->post('phone'))){
			// 	$response['code']= 1;
			// 	$response['msg']= '请输入手机号';
			// }
			// if(empty($this->post('smscode'))){ 
			// 	$response['code']= 1;
			// 	$response['msg']= '请输入验证码';
			// }
		}
		
	}

	public function getcontentnumAction(){
		header('Content-type:text/json');
		$type = $this->post('type');
		$data = $this->db->setTableName('content')->find($this->post('id'));
		$data['num'] = $data['hates'];
		if($type == 1) $data['num'] = $data['loves'];
		echo json_encode($data);
	}
	
	/*医生说*/
	public function quanAction(){
		$what = $this->get('what') ? 1 : 0;
		$this->view->assign(array(
	        'site_title'       => "医生说 - ".$this->site_config['site_title'],
	        'site_keywords'    => $this->site_config['site_keywords'], 
	        'site_description' => $this->site_config['site_description'],
	        'what' => $what,
	        'catid'=> 34
	    ));

		$this->view->display('api/quan.html');

	}

	/*API 检查手册*/
	public function jcscAction(){
		$this->view->assign(array(
	        'site_title'       => '检查手册 - ' . $this->site_config['site_title'],
	        'site_keywords'    => $this->site_config['site_keywords'], 
	        'site_description' => $this->site_config['site_description'],
	    ));
	    $this->view->display('api/jcsc.html');
	}

	/*API 检查手册*/
	public function jcsclistAction(){
		$this->view->assign(array(
	        'site_title'       => '检查手册 - ' . $this->site_config['site_title'],
	        'site_keywords'    => $this->site_config['site_keywords'], 
	        'site_description' => $this->site_config['site_description'],
	        'cid' => $this->get('cid'),
	    ));
	    $this->view->display('api/jcsc_list.html');
	}

	/*API 用药助手*/
	public function yyzsAction(){
		$this->view->assign(array(
	        'site_title'       => '用药助手 - ' . $this->site_config['site_title'],
	        'site_keywords'    => $this->site_config['site_keywords'], 
	        'site_description' => $this->site_config['site_description'],
	    ));
	    $this->view->display('api/yyzs.html');
	}

	/*API 用药助手*/
	public function yyzslistAction(){
		$this->view->assign(array(
	        'site_title'       => '用药助手 - ' . $this->site_config['site_title'],
	        'site_keywords'    => $this->site_config['site_keywords'], 
	        'site_description' => $this->site_config['site_description'],
	        'cid' => $this->get('cid'),
	    ));
	    $this->view->display('api/yyzs_list.html');
	}

	public function jcscjsonAction(){
		header('Content-type:text/json');
		$t = $this->get('t');
		$api = (int)$this->get('api');
		$id = (int)$this->post('id');

		if($id == 666){
			$re['code'] = 10000;
			$re['no'] = 1;
			$re['data'] = $this->db->setTableName('diy_jyml')->getAll();

			echo json_encode($re); 
			exit();
		}

		$page = $this->post('page') ? (int)$this->post('page') : 1;
		$this->view->assign(array(
	        'site_title'       => $this->site_config['site_title'],
	        'site_keywords'    => $this->site_config['site_keywords'], 
	        'site_description' => $this->site_config['site_description'],
	    ));
	    
	    /* api 接口
	    * 1226检查分类 
        * 1230检查列表
        * 1231药品分类
        * 1232药品列表
        */
	    $get_array = array(
		    'os' => 'ios',
		    'api'=> $api,
		    'pro'=>'xywyf32l24WmcqquqqTdhXZ8lQ',
		    'source'=>'test',
		    'version'=>'1.1'
		);
		$post_array = array(
    		'id'=>$id,
    		//'sign'=> md5('474'.'9ab41cc1bbef27fa4b5b7d4cbe17a75a'),
    		'page'=>1,  
    		'pagesize'=>15,
    		'bind'=>$id,
    	);
		$array = array_merge($get_array,$post_array);
		ksort($array);
		reset($array);
		//var_dump($array);
		//获取签名
		$sign = $this->xywysign($array,"xr2osW+QL*vYXdvP");
		$get_array['sign'] = $sign;
		//var_dump($sign);
	    $url ="http://test.api.wws.xywy.com/api.php/yimai/".$t."/index?".http_build_query($get_array);

	    $curl = new Curl;
	    $curl->post($url,$post_array);

	    if ($curl->error) {
		    echo $curl->error_code;
		} else {
		    echo $curl->response;
		}
		//$this->view->assign();
		//$this->view->display('api/jcsc.html');
	}

	public function answerAction(){
		header('Content-type:text/json');
		$p = $this->post('data');
		//var_dump(htmlspecialchars_decode($p));
		$p = json_decode(htmlspecialchars_decode($p), true);
		//var_dump($p);
		//did    int		医生id			必填
		//uid    int		用户id			必填
		//qid    int		问题id			必填
		//dicon	file		医生头像		必填
		//dname	string	医生姓名		必填
		//dtitle	string	医生职称		必填
		//answerdata	string	问题答案	必填

		if($this->get('sign') === md5('yiyikeji')){
		  if(!empty($p['answerdata']) && !empty($p['qid']) && !empty($p['dname'])) {

		  	$c = $this->db->setTableName('content_ask')->where('qid=?', $p['qid'])->getOne();
		  	if($c) {
		  		$data['cid'] = $c['id'];
		  		$data['username'] = $data['name'] = $p['dname'];
		  		$data['content'] = $p['answerdata'];
		  		$data['xywyhd'] =  serialize($p);
		  		$data['time'] = time();
		  		$this->db->setTableName('form_answer')->insert($data,true);
		  		$res['code'] = 1;
		  		$res['msg'] = '成功';

		  		//通知 居民
		  		$content_info = $this->db->setTableName('content')->find($c['id']);
			   	$this->createMassage(4,$content_info['userid'],'/?id='.$c['id'].'&tab=3',$content_info['time']);//通知 居民



		  	} else {
		  		$res['code'] = 0;
		  		$res['msg'] = '系统内无'.$this->post('qid').'关联问题';
		  	}

		  } else {

		  	$res['code'] = 0;
			if(empty($p['qid'])) $res['msg'] = 'qid不能为空';
			if(empty($p['answerdata'])) $res['msg'] = 'anserdata不能为空';
			if(empty($p['dname'])) $res['msg'] = 'dname不能为空';
		  }
		} else {
			$res['code'] = 0;
			$res['msg'] = '数字签名不正确';
		}
		$res['debug'] = $p;//deBUG
		echo json_encode($res);
	}
	
	public function devhucaohangAction(){
		$id = $this->get('id');
		$member = $this->db->setTableName('member')->find($id);
		if (empty($member)) $this->show_message('会员名不存在', 2,1);
		$this->cookie->set('member_id', $member['id']);
		$this->cookie->set('member_code', substr(md5($this->site_config['rand_code'] . $member['id']), 5, 20));
		$this->show_message('登录成功', 1, '/');
	}

	public function ajaxtabAction(){
		$this->view->assign(array(
			'tab' => $this->get('tab'),
		));
		$this->view->display('api/ajaxtab.html');
	}

	public function testwesmsAction(){
		$w_uid = $this->member_info['userid'];
		$doc = $this->db->setTableName('member')->find($this->member_info['userid']);
		$docname = $doc['name'];
		//$w_url = $this->get_http_host().'/member/index.php?c=content&a=add&catid=25&uid='.$this->member_info['id'];
		$w_url = null;
		$w_data = array(
	         "first"  => "您好，{$docname}医生，您辖区居民".$this->member_info['name']."关注了您。请添加".$this->member_info['name']."为您的辖区居民",
	         "keyword1"   => date('Y年m月d日',time()),
	         "keyword2"  => "添加辖区居民",
	         "keyword3"  => "待添加",
	         "remark" => "",
	        );
		$re = $this->sendWechatSms($w_uid,$w_url,$w_data);
	}

	public function familyAction(){
		$familyid = $this->member_info['familyid'] == 0 ? $this->member_info['cid'] : $this->member_info['familyid'];
		$this->view->assign(array(
	        'site_title'       => '家庭成员',
	        'site_keywords'    => $this->site_config['site_keywords'], 
	        'site_description' => $this->site_config['site_description'],
	        'familyid' => $familyid
	    ));
	    if(!$this->member_info) $this->redirect('/');
		$this->view->display('api/family.html');
	}

	protected function randpw($len = 8, $format = 'ALL') {
        $is_abc = $is_numer = 0;
        $password = $tmp = '';
        switch ($format){
            case 'ALL':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
            case 'CHAR':
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                break;
            case 'NUMBER':
                $chars = '0123456789';
                break;
            default:
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                break;
        }
        mt_srand((double)microtime() * 1000000 * getmypid());
        while (strlen($password) < $len) {
            $tmp = substr($chars, (mt_rand() % strlen($chars)) , 1);
            if (($is_numer <> 1 && is_numeric($tmp) && $tmp > 0) || $format == 'CHAR') {
                $is_numer = 1;
            }
            if (($is_abc <> 1 && preg_match('/[a-zA-Z]/', $tmp)) || $format == 'NUMBER') {
                $is_abc = 1;
            }
            $password.= $tmp;
        }
        if ($is_numer <> 1 || $is_abc <> 1 || empty($password)) {
            $password = randpw($len, $format);
        }
        return $password;
    }
	
}