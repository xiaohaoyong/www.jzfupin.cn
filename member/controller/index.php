<?php

class index extends Member {

    public function __construct() {
		parent::__construct();
		//if($this->site_config['wechat_login'] && is_wechat() && $this->get('mid')) $this->autoReg();
	}
	
	public function indexAction() {
	    $content = $this->db->setTableName('content')->getOne(array('uid=?'),$this->member_info['id']);
	    if($content['id'] > 0 && $this->member_info['modelid'] == 5) $this->redirect('/?id='.$content['id']);//有医生的 居民 直接跳转 至 文章
	    $this->view->assign(array(
			'member_index'     => 1,
		    'site_title' => '会员中心 - ' . $this->site_config['site_name'],
		));
	    $this->view->display('member/index.html');
	}

	public function userAction(){
		$this->view->assign(array(
		    'site_title' => '个人中心 - ' . $this->site_config['site_name'],
		));
		$this->view->display('member/user.html');
	}
	/**
	 * 资料修改
	 */
	public function editAction() {
	    $modelid = $this->member_info['modelid'];
		$tablename = $this->member_model[$modelid]['tablename'];
	    $fields  = $this->member_model[$modelid]['fields'];
	    if ($this->post('submit')) {
	        $data = $this->post('data');
			$data = $this->post_check_fields($fields , $data);

			//更新 会员主表
			if ($data['name'] || $data['avatar'] || $data['sex'] || $data['phone']){
				$mdata = [];
				if (!empty($data['name'])) $mdata['name'] = $data['name'];
				if (!empty($data['avatar'])) $mdata['avatar'] = $data['avatar'];
				if (!empty($data['sex'])) $mdata['sex'] = (int)$data['sex'];
				//if (!empty($data['phone'])) $mdata['phone'] = $data['phone'];

				//提交审核资料 更改为 提交审核 或 审核通过
				//if (!empty($data['cardid'])) $mdata['status'] = 2;//身份证 不为空 状态更改为 2

				$this->db->setTableName('member')->update($mdata, 'id=?', $this->member_info['id']);
			}


			$memberdata = $this->db->setTableName($tablename)->find($this->member_info['id']);
			if ($memberdata) {
			    //修改附表内容
				$this->db->setTableName($tablename)->update($data, 'id=?' , $this->member_info['id']);
			} else {
				$data['id'] = $this->member_info['id'];
				$this->db->setTableName($tablename)->insert($data);
			}
			$this->show_message('修改成功', 1, url('index/edit'));
	    }
	    $this->view->assign(array(
	        'fields' => $this->get_data_fields($fields, $this->member_info),
			'site_title'  => '修改资料 - 会员中心 - ' . $this->site_config['site_name'],
	    ));
	    $this->view->display('member/info_edit.html');
	}

	public function avatarAction() {
		$modelid = $this->member_info['modelid'];
		$tablename = $this->member_model[$modelid]['tablename'];
		if ($this->post('avatar')) {
			$avatar = $this->post('avatar');
			if (!empty($avatar)) { 
				$mdata['avatar'] = $avatar;
				$this->db->setTableName('member')->update($mdata, 'id=?', $this->member_info['id']);
			}
			echo 1;
		}
	}

	public function phoneAction(){
	    $this->view->assign(array(
            'site_title'  => '手机认证 - ' . $this->site_config['site_name'],
        ));
		$this->view->display('member/info_phone.html');
	}
	
	
	/**
	 * 密码修改
	 */
	public function passwordAction() {
	    if ($this->post('submit')) {
	        $data   = $this->post('data');
			if ($this->member_info['password'] != md5(md5($data['password1'])) ) $this->show_message('原密码错误');
			if (empty($data['password2'])) $this->show_message('新密码不能为空。');
			if ($data['password2'] != $data['password3']) $this->show_message('两次密码不一致。');
            $this->db->setTableName('member')->update(array('password'=>md5(md5($data['password2']))), 'id=?', $this->member_info['id']);
			$this->show_message('修改成功', 1, url('index/password'));
	    }
		$this->view->assign(array(
			'site_title' => '修改密码 - 会员中心 - ' . $this->site_config['site_name'],
	    ));
	    $this->view->display('member/password.html');
	}
	
}