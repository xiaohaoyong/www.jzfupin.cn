<?php
use Ender\YunPianSms\SMS\YunPianSms;
use EasyWeChat\Message\Text;
class index extends Base {

    public function __construct() {
		parent::__construct();
	}
	
	public function indexAction() {
        $app = $this->getWechatServe();
        $server = $app->server;

        $server->setMessageHandler(function ($message) {
            // $message->FromUserName // 用户的 openid
            // $message->MsgType // 消息类型：event, text....
            switch ($message->MsgType) {
                case 'event':
                    return $this->keyauto($message->EventKey,$message->FromUserName);
                    break;
                default:
                    return "您好！欢迎关注".$this->site_config['site_name']."!";
                    break;
            }
        });

        $server->serve()->send();
	}
    public function keyauto($key,$openid){
        $site_name = $this->site_config['site_name'];
        $url = $this->get_http_host().'/?mid=5';
        $docid = (int)$key;
        $key = explode('_', $key);
        if($key[0] == "qrscene") $docid=(int)$key[1];
        if($docid > 0) {

            $old = $this->db->setTableName('diy_qrcode')->getOne('openid=?',$openid);
            if($old){

            } else {
                $this->db->setTableName('diy_qrcode')->insert(array(
                    'docid'=>$docid,
                    'openid'=>$openid
                ),true);
            }
           $doc = $this->db->setTableName('member')->find($docid);
           $docname = $doc['name'];
$msg  = "欢迎关注{$site_name}!
我是您的家庭医生 {$docname} {$docid}
赶快进行 <a href='{$url}'>手机认证</a>
";
        } else {
            $msg = "您好！欢迎关注".$this->site_config['site_name']."!";
        }

        return new Text(['content' => $msg]);
    }
}