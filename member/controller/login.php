<?php

class login extends Member {
    
    public function __construct() {
		parent::__construct();
	}
	
	/**
	 * 登录
	 */
	public function indexAction() {
	    if ($this->member_info)  $this->show_message('您已经登录了。',1, url('index/'));
	    if ($this->post('submit')) {
		    $data   = $this->post('data');


			//if ($this->site_config['member_logincode'] && !$this->checksmsCode($this->post('code'))) $this->show_message('验证码不正确', 2,1);
			if (!$this->checksmsCode($this->post('code'))) $this->show_message('验证码不正确', 2,1);


			// if (empty($data['phone'])) $this->show_message('手机号不能为空', 2,1);

			// if ($data['phone'] != $this->session->get('phone')) $this->show_message('手机号不正确', 2,1);

			$member = $this->db->setTableName('member')->getOne(array('phone=?','modelid=?') ,array($this->session->get('phone'),$data['modelid']));

			$gobackurl= $data['gobackurl'] ? urldecode($data['gobackurl']) : url('index');
			if (empty($member)) {
				if(!empty($this->session->get('phone')))  {
					$uinfo['phone'] = $this->session->get('phone');
					$uinfo['sex'] = 1;
					$uinfo['modelid'] = $data['modelid'];
					$uinfo['status'] = 0;

					if($uinfo['modelid'] == 5) {

						$content  = $this->db->setTableName('content')->getOne(['phone=?','uid=0'],$uinfo['phone']);
						$content_user = $this->db->setTableName('content_users')->find($content['id']);
						//$content = array_merge($content,$content_user);
						if($content_user){
							$uinfo['name'] = $content['title'];
							$uinfo['age'] = $content_user['age'];
							$uinfo['cid'] = $content['id'];//增加ID
							$uinfo['sex'] = $content['sex'];//增加sex
							if($content['userid'] > 0) $uinfo['userid'] = $uinfo['userid'];//活动 医生id
						}

						$uinfo['status'] = 1;

					}

					$newid = $member['id'] = $this->pcAutoReg($uinfo);

					if($content_user && $uinfo['modelid'] == 5){
						$this->db->setTableName('content')->update(['uid'=> $newid], 'id=?', $content['id']);//写入关联
					}

				} else {
					$this->show_message('手机号不正确', 2,1);
				}
			}
			//if ($member['password'] != md5(md5($data['password']))) $this->show_message('密码错误', 2,1);
			$this->cookie->set('member_id', $member['id']);
			$this->cookie->set('member_code', substr(md5($this->site_config['rand_code'] . $member['id']), 5, 20));
			$this->session->delete('phone');//登录成功后 移除 手机
			$this->show_message('登录成功', 1, $gobackurl);
		}
		$gobackurl = $this->get('gobackurl') ? $this->get('gobackurl') : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : url('index'));
	    $this->view->assign(array(
		    'config' => $this->site_config,
			'site_title' => '会员登录 - ' . $this->site_config['site_name'],
			'site_keywords'    => $this->site_config['site_keywords'], 
			'site_description' => $this->site_config['site_description'],
			'gobackurl'    => urlencode($gobackurl),
		));
		$this->view->display('member/login.html');
	}

	/**
	 * 退出登录
	 */
	public function outAction() {
		if ($this->session->get('wechat_user')) $this->session->delete('wechat_user');
		if ($this->session->get('target_url')) $this->session->delete('target_url');
		if ($this->session->get('member_id')) $this->session->delete('member_id');
		if ($this->cookie->get('member_id')) $this->cookie->delete('member_id');
		if ($this->cookie->get('member_code')) $this->cookie->delete('member_code');
		if($this->site_config['wechat_login'] && is_wechat()) $this->redirect(url('index'));//微信端 跳转至 登录页
		$this->show_message('退出成功', 1, '/');
	}

	protected function pcAutoReg($uinfo){
		$member_model = get_cache('member_model');
		$data2 = array();
        //$data['avatar'] = $uinfo['avatar'];
        $data2['username'] = time();
        $data2['name'] = !empty($uinfo['name']) ? $uinfo['name'] : $uinfo['phone'];
        $data2['phone'] = $uinfo['phone'];
        $data2['password'] = rand(111111, 999979799);
        $data2['email'] = !empty($uinfo['email']) ? $uinfo['email'] : time().'@yiyi.hnzhixi.com';
        $data2['sex'] = $uinfo['sex'] != 0 ? $uinfo['sex'] : 1;
        $data2['userid'] = $uinfo['userid'] != 0 ? $uinfo['userid'] : 0;
        $data2['cid'] = !empty($uinfo['cid']) ? $uinfo['cid'] : 0;
        $data2['regdate']  = time(); 
        $data2['regip']    = $this->get_user_ip();
        $data2['status']   = $uinfo['status'];
        //$data['modelid']  = (!isset($data['modelid']) || empty($data['modelid'])) ? $this->site_config['member_modelid'] : $data['modelid'];
        $data2['modelid'] = empty($uinfo['modelid']) ? $this->site_config['member_modelid'] : $uinfo['modelid'];

        if (!isset($member_model[$data2['modelid']])) $this->show_message('会员模型不存在',2,1);
        $data2['id'] = $this->db->setTableName('member')->insert($data2,true);
        if ($data2['id']) {
            $this->db->setTableName($member_model[$data2['modelid']]['tablename'])->insert($data2);
        }else {
            $this->show_message('注册失败',2,10);
        }
        return $data2['id'];
	}
	
}