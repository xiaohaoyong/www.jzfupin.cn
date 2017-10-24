<?php

class tool extends Admin {
	
    public function __construct() {
		parent::__construct();
	}
	
	public function indexAction() {
		$model = $this->content_model;
		
		$regex_array = array();//待替换过
		$replace_array  = array();//替换词
		
		if ($this->post('submit')) {
			$data = $this->post('data');
			$rule = $data['rule'];
			$modelid = $data['modelid'];
			if (empty($rule)) $this->show_message('请填写替换词',2,1);
			$rule  = explode(chr(13), $rule);
			foreach ($rule as $val) {
				list($regex, $replace) = explode('|', $val);
				$regex_array[]="/".trim($regex)."/";
				$replace_array[]=trim($replace);
			}
			if ($modelid==0) {
				$data = $this->db->setTableName('category')->getAll();
				$num = 0;
				foreach ($data as $v) {
					$this->replace_page($v["catid"] , $regex_array,$replace_array);
					$num ++;
					if ($num == count($data)) $this->show_message('替换完成',2,1);
				}
			} else {
				$this->db->where('modelid=?',$modelid);
				$data = $this->db->setTableName("content")->getAll();
				foreach ($data as $v) {
					$this->replace_content($v["id"] , $regex_array,$replace_array);
					$num ++;
					if ($num == count($data)) $this->show_message('替换完成',2,1);
				}
			}
			
		}
		include $this->admin_tpl('tool_replace');
	}
	//替换单页
	protected function replace_page($catid , $regex_array,$replace_array){
		$date = $this->db->setTableName('category')->find($catid);
		$rdate['catname'] = preg_replace($regex_array, $replace_array, $date['catname']);//栏目名称
		$rdate['content'] = preg_replace($regex_array, $replace_array, $date['content']);//替换内容
		$rdate['seo_description'] = preg_replace($regex_array, $replace_array, $date['seo_description']);//替换描述
		$rdate['seo_keywords'] = preg_replace($regex_array, $replace_array, $date['seo_keywords']);//替换关键词
		$rdate['seo_title'] = preg_replace($regex_array, $replace_array, $date['seo_title']);//替换标题
		//更新 
		$this->db->setTableName('category')->update($rdate, 'catid=' . $catid);
	}
	
	//替换文章
	protected function replace_content($id , $regex_array,$replace_array){
		$model = $this->content_model;
		$date = $this->db->setTableName('content')->find($id);
		$tablename = $model[$date['modelid']]["tablename"];
		
		$rdate['title'] = preg_replace($regex_array, $replace_array, $date['title']);//替换标题
		$rdate['description'] = preg_replace($regex_array, $replace_array, $date['description']);//替换描述
		$rdate['keywords'] = preg_replace($regex_array, $replace_array, $date['keywords']);//替换关键词
		
		$content = $this->db->setTableName($tablename)->find($id);
		$cdate["content"] = preg_replace($regex_array, $replace_array, $content['content']);//替换标题
		
		//更新 
		$this->db->setTableName('content')->update($rdate, 'id=' . $id);
		$this->db->setTableName($tablename)->update($cdate, 'id=' . $id);
	}
	
	public function filtersAction() {
		$page     = (int)$this->get('page') ? (int)$this->get('page') : 1;
		$pagesize = empty($this->admin['list_size']) ? 10 : $this->admin['list_size'];
		$date = $this->db->setTableName('filters')->pageLimit($page, $pagesize)->getAll(null,null,null,array('id DESC'));
		$total = $this->db->setTableName('filters')->count();
		$pagelist = iaeweb::load_class('pager');
		$pagelist = $pagelist->total($total)->url(url('tool/filters') . '&page=[page]')->ext(true)->num($pagesize)->page($page)->output();
		include $this->admin_tpl('filters_list');
	}
	
	public function addfiltersAction() {
		if ($this->post('submit')) {
			$data = $this->post('data');
			if (empty($data['title'])) $this->show_message('标题没有填写',2,1);
			
			$id = $this->db->setTableName('filters')->insert($data,true);
			if (!is_numeric($id )) $this->show_message('添加失败');
			
			$msg = '添加成功&nbsp;&nbsp;<a href="' . url('tool/filters') . '" >点这返回列表</a>';
			$this->cacheAction();
	        $this->show_message($msg, 1);
		}
		include $this->admin_tpl('filters_add');
	}
	
	public function editfiltersAction() {
		$id = (int)$this->get('id');
		$data = $this->db->setTableName('filters')->find($id);
		if ($this->post('submit')) {
			$data = $this->post('data');
			if (empty($data['title'])) $this->show_message('标题没有填写',2,1);
			$this->db->setTableName('filters')->update($data,  'id=?' , $id);
			$msg = '修改成功&nbsp;&nbsp;<a href="' . url('tool/filters') . '" >点这返回列表</a>';
			$this->cacheAction();
	        $this->show_message($msg, 1);
		}
		include $this->admin_tpl('filters_add');
	}
	
	public function delfiltersAction() {
		$id    = $id ? $id : (int)$this->get('id');
		if (empty($id)) $this->show_message('ID不存在');
		$this->db->setTableName('filters')->delete('id=?' , $id);
		$this->cacheAction();
		$this->show_message('删除成功',1);
	}
	
	public function cacheAction() {
		$data = array();
	    foreach ($this->db->setTableName('filters')->findAll() as $t) {
	        $data[$t['id']] = $t;
	    }
	    set_cache('filters', $data);
	}
}