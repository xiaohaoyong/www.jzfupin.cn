<?php

class content extends Member {
    
    public function __construct() {
		parent::__construct();
		//if($this->site_config['wechat_login'] && is_wechat() && $this->get('mid')) $this->autoReg();
		if ($this->member_info['status'] !=1 ) $this->show_message('您还没有通过审核。',2,url('index/edit')); //判断审核
	}
	
	/*
	 * 内容管理
	 */
	public function indexAction() {
	    if ($this->post('catid')) $this->redirect(url('content/add', array('catid'=>$this->post('catid'))));
		$page     = (int)$this->get('page') ? (int)$this->get('page') : 1;
		$modelid  = (int)$this->get('modelid');
	    $pagelist = iaeweb::load_class('pager');
	    $pagesize = 10;//分页列表		
		if ($modelid) $this->db->where('modelid=?', $modelid);
		$list = $this->db->setTableName('content')->pageLimit($page, $pagesize)->where('username=?',$this->member_info['username'])->getAll(null, null,null,'status DESC,time DESC');
		if ($modelid) $this->db->where('modelid=?', $modelid);
	    $total    = $this->db->setTableName('content')->where('username=?',$this->member_info['username'])->count();
	    $pagelist = $pagelist->total($total)->url(url('content', array('modelid'=>$modelid, 'page'=>'&page=[page]')))->hide()->num($pagesize)->page($page)->output();
		$tree =  iaeweb::load_class('tree');
		$tree->icon = array(' ','  ','  ');
		$tree->nbsp = '&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			if(!$r['ispost'] || $r['typeid']!=1) continue;
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$tree->init($categorys);
		$category = $tree->get_tree(0, $str);
        foreach ($list as $key => $t) {
            $list[$key]['url'] = $this->view->get_show_url($t);
        }
	    $this->view->assign(array(
	        'list'       => $list,
	        'pagelist'   => $pagelist,
			'site_title' =>  '问诊列表 - 会员中心 - ' . $this->site_config['site_name'],
			'modelid'    => $modelid,
			'model'		 => $this->content_model[$modelid],
			'category'   => $category,
	    ));
	    $this->view->display('member/content_list.html');
	}

	/*
	*	户主列表
	*/

	public function familyAction(){
		$this->view->assign(array(
			'site_title' =>  '家庭列表 - ' . $this->site_config['site_name'],
	    ));
	    $this->view->display('member/family_list.html');
	}


	/*二维码*/
	public function qrcodeAction(){
		
		$this->view->assign(array(
			'qrcode' =>  $this->getqrcode(),
			'site_title' =>  '二维码添加 - ' . $this->site_config['site_name'],
			
	    ));
	    $this->view->display('member/qrcode.html');
	}
	

	protected function getqrcode(){
		$wechat = $this->getWechatServe();
		$qrcode = $wechat->qrcode;
		$result = $qrcode->forever($this->member_info['id']);
		$ticket = $result->ticket;
		return $qrcodeurl = $qrcode->url($ticket);
	}
	/*
	 * 发布
	 */
	public function addAction() {
	    $catid    = $this->get('catid') || !empty($this->get('catid')) ? (int)$this->get('catid') : (int)$this->post('catid');
	    $familyid    = $this->get('familyid') ? $this->get('familyid') : 0;
	    if (empty($this->category_cache[$catid])) $this->show_message('选择发布的栏目不存在');
	    $modelid  = $this->category_cache[$catid]['modelid'];
	    if (empty($this->content_model[$modelid])) $this->show_message('模型不存在');
		if (!empty($this->category_cache[$catid]['child'])) $this->show_message('只能发布到子栏目');
		if (empty($this->category_cache[$catid]['ispost'])) $this->show_message('该栏目不能投稿');
	    $fields   = $this->content_model[$modelid]['fields'];
	    if ($this->post('submit')||$this->post('submit2')) {
	        $data  = $this->post('data');
	        if($catid == 25) $data['familyid'] = $familyid;//家庭ID
	        if(empty($data['title']) && $modelid==13) $data['title'] = $this->member_info['name'].date('Y-m-d',time());//自动生成标题

	        if (empty($data['title'])) {
	        	if($modelid == 19){ 
	        		$this->show_message('请填写姓名',2,1);
	        	} else {
	        		$this->show_message('请填写标题',2,1);
	        	}
	    	}
			$data = $this->post_check_fields($fields, $data);

			if($catid == 25 && !empty($data['phone'])){
				$olduser = $this->db->setTableName('content_users')->where('cardid=?',$data['cardid'])->getOne();
				$Puser = $this->db->setTableName('content')->where('phone=?',$data['phone'])->getOne();
				if($olduser || $Puser) $this->show_message('此居民信息已经存在',2,1);
			}

			if(empty($data['catid'])) $data['catid'] =  $catid;

			if (empty($data['description']) && isset($data['content'])) {
				$data['description'] = strcut(strip_tags(trim(str_replace(array(' ', '　　',' ','  ','&nbsp;','&#160;'),'', html_entity_decode($data['content'])))),200);
			}

			$data['userid']  = $this->member_info['id'];
	        $data['username']  = $this->member_info['username'];
	        $data['name']  = $this->member_info['name'];
	        $data['time'] =  time();
			$data['status']    = $this->category_cache[$catid]['verify'];
	        $data['modelid']   = $modelid;

	        //提问专家到寻医问药
			if($catid == 8 || $catid==5 || $catid==9){
				$xywy = $this->askxywy($data,$catid);
				if($xywy->code == 10000) {
					$data['qid'] = $xywy->data->qid;
					$data['departid'] = $xywy->data->departid;
				} else {
					//var_dump($xywy);//DEBUG
					$this->show_message($xywy->msg, 2,1);
				}
			}


			$data['id'] = $this->db->setTableName('content')->insert($data,true);

			if($this->member_info['modelid']==5 && $catid==6) $this->createMassage(2,$this->member_info['userid'],'/?id='.$data['id']);//通知村医通知消息

			if($this->member_info['modelid']==5 && ($catid==6 || $catid==5)) $this->createMassage(3,$this->member_info['id'],'/?id='.$data['id']);//通知自己通知消息



			/*医生 添加资料 关联 用户*/
			if($modelid == 19) {
				$u['phone'] = $data['phone'];
				$u['userid'] = $data['userid'];
				$u['familyid'] = $data['familyid'];
				$u['cid'] = $data['id'];
				$m = $this->db->setTableName('member')->getOne(array('phone=?','cid=?','modelid=?'),array($u['phone'],0,5));
				if($m) {
					$this->db->setTableName('member')->update($u,'id=?',$m['id']);//更新 用户关联信息
					$this->db->setTableName('content')->update(array('uid'=>$m['id']),'id=?',$data['id']);//内容 更新 用户关联信息
					
					$this->testwesms($this->member_info['id'],$this->member_info['name'],$data['title']);//微信通知医生卡片
					$this->testwesms_j($m['id'],$this->member_info['name'],$data['title']);//微信通知居民卡片
				}
			}

			if (!is_numeric($data['id'])) 	        $this->show_message('发布失败',2,1);
			$id = $this->db->setTableName($this->category_cache[$catid]['tablename'])->insert($data,true);
			if (!is_numeric($id)) 	        $this->show_message('发布失败 添加附表失败',2,1);
			$msg = '<a href="' . url('content/add', array('catid'=>$catid)) . '" style="font-size:14px;">继续发布</a>&nbsp;&nbsp;<a href="' . url('content/', array('modelid'=>$modelid)) . '" style="font-size:14px;">返回列表</a>';
	        if($catid == 25) $this->show_message($msg, 1,'/?catid=25');

	        $this->show_message($msg, 1,url('content/', array('modelid'=>$modelid)));
	    }
	    $fields_data      = $this->get_data_fields_wechat($fields);
		$tree =  iaeweb::load_class('tree');
		$tree->icon = array(' ','  ','  ');
		$tree->nbsp = '&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			if($modelid && $modelid != $r['modelid']) continue;
			if(!$r['ispost'] || $r['typeid']!=1) continue;
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$tree->init($categorys);
		$category = $tree->get_tree(0, $str);
	    $this->view->assign(array(
	        'data'        => array('catid'=>$catid),
	        'fields' => $fields_data,
			'site_title'  => '发布内容 - 会员中心 - ' . $this->site_config['site_name'],
			'model'       => $this->content_model[$modelid],
			'modelid'     => $modelid,
			'category'    => $category,
			'familyid' => $familyid,
	    ));
	    $this->view->display('member/content_add.html');
	}
	
	/**
	 * 修改文章
	 */
    public function editAction() {
	    $id       = (int)$this->get('id');
		$data = $this->db->setTableName('content')->where('username=?', $this->member_info['username'])->where('id=?' , $id)->getOne();
	    $catid    = $data['catid'];
	    if (empty($data))  $this->show_message('内容不存在');
	    if (empty($catid)) $this->show_message('内容栏目不存在');
	    $modelid  = $this->category_cache[$catid]['modelid'];
	    if (empty($this->content_model[$modelid])) $this->show_message('模型不存在');
		if (!empty($this->category_cache[$catid]['child'])) $this->show_message('文章在父栏目 无法修改请联系管理员');
		if (empty($this->category_cache[$catid]['ispost'])) $this->show_message('该栏目不能投稿');
	    $fields   = $this->content_model[$modelid]['fields'];
	    $tablename       = $this->content_model[$modelid]['tablename'];
	    if ($this->post('submit')) {
	        $data = $this->post('data');
	        if (empty($data['title'])) $this->show_message('请填写标题',2,1);
	        if ($data['catid'] != $catid) $this->show_message('栏目模型不一致，无法修改栏目',2,1);
			$data = $this->post_check_fields($fields, $data);
	        $data['username']  = $this->member_info['username'];
	        $data['name']  = $this->member_info['name'];
	        $data['time'] =  time();
			$data['status']    = $this->category_cache[$catid]['verify'];
	        $data['modelid']   = $modelid;
			unset($data['modelid']);
			$this->db->setTableName('content')->update($data,  'id=?' , $id);
	        $this->db->setTableName($tablename)->update($data,  'id=?' , $id);
	        $this->show_message('修改成功', 1, url('content/', array('modelid'=>$modelid)));
	    }
	    $data  = $this->db->setTableName('content')->find($id);
	    $data2  = $this->db->setTableName($tablename)->find($id);
	    if ($data2) $data = array_merge($data, $data2);
	    $fields_data = $this->get_data_fields($fields, $data);
		$tree =  iaeweb::load_class('tree');
		$tree->icon = array(' ','  ','  ');
		$tree->nbsp = '&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			if($modelid && $modelid != $r['modelid']) continue;
			if(!$r['ispost'] || $r['typeid']!=1) continue;
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$tree->init($categorys);
		$category = $tree->get_tree(0, $str);
	    $this->view->assign(array(
	        'data'		  => $data,
	        'fields' => $fields_data,
			'site_title'  => '修改内容 - 会员中心 -' . $this->site_config['site_name'],
			'model'       => $this->content_model[$modelid],
			'modelid'     => $modelid,
			'category'    => $category,
	    ));
	    $this->view->display('member/content_add.html');
	}

	/**
	 * 删除文章 注销掉此功能 会员只能发布不能删除 此段代码逻辑也有问题 会员可以任意删除自己发布的文章
	 */
	// public function delAction(){
	//     $id    = (int)$this->get('id');
	// 	$data  = $this->db->setTableName('content')->find($id);
	// 	if ($data['username'] == $this->member_info['username'] && $data['status'] ==0 ) {
	// 		$this->db->setTableName('content')->delete('id=?' , $id);
	// 		$this->show_message('删除成功',1 );
	// 	} else {
	// 	    $this->show_message('无权操作');
	// 	}
	// }
	
	
	/*
	 * 表单管理
	 */
	public function formAction() {
	    $form_model = get_cache('form_model');
		$cid      = (int)$this->get('cid');
		$page     = (int)$this->get('page') ? (int)$this->get('page') : 1;
		$modelid  = (int)$this->get('modelid');
		if (empty($this->form_model[$modelid])) $this->show_message('表单不存在');
	    $table    = $this->form_model[$modelid]['tablename'];
	    $pagelist = iaeweb::load_class('pager');
	    $pagesize = 15;
        if (!empty($cid)) $this->db->where('cid=?', $cid);
		$total = $this->db->setTableName($table)->where(array('status=1', 'userid=?'), $this->member_info['id'])->count();
		$list = $this->db->setTableName($table)->where(array('status=1', 'userid=?'), $this->member_info['id'])->getAll(null,null,null, 'id DESC');
        if (!empty($cid)) $this->db->where('cid=?', $cid);
	    $pagelist = $pagelist->total($total)->url(url('content/form', array('modelid'=>$modelid, 'cid'=>$cid, 'page'=>'&page=[page]')))->hide()->num($pagesize)->page($page)->output();
	    $this->view->assign(array(
	        'list'   => $list,
	        'pagelist'   => $pagelist,
			'site_title' => $this->form_model[$modelid]['modelname'] . ' - 会员中心 - ' . $this->site_config['site_name'],
			'fields' => isset($this->form_model[$modelid]['setting']['form']['membershow']) ? $this->form_model[$modelid]['setting']['form']['membershow'] : array(),
			'form'       => $this->form_model[$modelid],
			'modelid'    => $modelid,
			'join'       => $this->form_model[$modelid]['joinid'] ? $this->form[$modelid]['joinname'] : null,
	    ));
	    $this->view->display('member/form_list.html');
	}
	
	/*
	 * 查看表单内容
	 */
	public function formshowAction() {
	    $id      = (int)$this->get('id');
		if (empty($id)) $this->show_message('id不能为空');
		$modelid = (int)$this->get('modelid');
		if (empty($this->form_model[$modelid])) $this->show_message('表单模型不存在');
		$data = $this->db->setTableName($this->form_model[$modelid]['tablename'])->where('userid=?', $this->member_info['id'])->where('id=?' , $id)->getOne();
		if (!$data) $this->show_message('内容不存在');
		$this->view->assign(array(
			'data'        => $data,
			'form'        => $this->form_model[$modelid],
			'listurl'        => HTTP_REFERER,
			'modelid'     => $modelid,
			'site_title'  => $this->form_model[$modelid]['modelname'] . ' - 会员中心 - ' . $this->site_config['site_name'],
			'fields' => $this->get_data_fields($this->form_model[$modelid]['fields'], $data),
		));
		$this->view->display('member/form_show.html');
	}
	
	protected function testwesms($w_uid,$docname,$jmname){
		//$w_url = $this->get_http_host().'/member/index.php?c=content&a=add&catid=25&uid='.$this->member_info['id'];
		$w_url = null;
		$w_data = array(
	         "first"  => "您好，{$docname}医生，您已成功添加{$jmname}为您的辖区居民",
	         "keyword1"   => date('Y年m月d日',time()),
	         "keyword2"  => "添加辖区居民",
	         "keyword3"  => "已添加",
	         "remark" => "",
	        );
		$re = $this->sendWechatSms($w_uid,$w_url,$w_data);
	}
	
	protected function testwesms_j($w_uid,$docname,$jmname){
		//$w_url = $this->get_http_host().'/member/index.php?c=content&a=add&catid=25&uid='.$this->member_info['id'];
		$w_url = null;
		$w_data = array(
	         "first"  => "您好，{$jmname}，您的家庭医生{$docname}已成功添加您为他的辖区居民。",
	         "keyword1"   => date('Y年m月d日',time()),
	         "keyword2"  => "添加家庭医生",
	         "keyword3"  => "已添加",
	         "remark" => "",
	        );
		$re = $this->sendWechatSms($w_uid,$w_url,$w_data);
	}
	 
}