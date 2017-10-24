<?php
class spider extends Admin {
	private $dir;
   	private $file_info;
	private $status_arr;
	private $site_status;
	public function __construct() {
		parent::__construct();
		$this->dir = TEMPLATE_DIR . SYS_THEME_DIR;
		if (file_exists($this->dir.'config.php')) {
			$this->file_info = include $this->dir.'config.php';
		}
		$this ->site_status  = explode(chr(13), $this->site_config['site_status']);
		foreach ($this ->site_status as $val) {
	    	if ($val =='') continue;
		    list($statusid, $name) = explode('|', $val);	
			$this ->status_arr[trim($statusid)] = trim($name);
		}
		require(CORE_PATH. 'library' .'/task.function.php');
		require(CORE_PATH. 'library' .'/spidermod.class.php');
	}

	
	public function indexAction() {
		$list = $this->db->setTableName('spider_listrules')->findAll('id,value');
		$content = $this->db->setTableName('spider_contentrules')->findAll('id,value');
		include $this->admin_tpl('spider');
	}
	
	public function importAction() {
		if ($this->post('submit')) {
			$data = $this->post('data');
			$data['value'] = base64_decode($data['value']);
			$data['id'] = $this->db->setTableName('spider_listrules')->insert($data,true);
			if (!is_numeric($data['id'])) $this->show_message('导入失败');
			$this->cacheAction();
			$this->show_message('导入成功',1, url('spider/index'),3000);
		}
		include $this->admin_tpl('spider_import');
	}
	
	public function importcAction(){
		if ($this->post('submit')) {
			$data = $this->post('data');
			$data['value'] = base64_decode($data['value']);
			$data['id'] = $this->db->setTableName('spider_contentrules')->insert($data,true);
			if (!is_numeric($data['id'])) $this->show_message('导入失败');
			$this->cacheAction();
			$this->show_message('导入成功',1, url('spider/index'),3000);
		}
		$this->show_message('无数据');
	}
	
	public function addlistAction() {
		
		if ($this->post('submit')) {

			$data['value'] = $this->post('value');
			$data['value'] = serialize($data['value']);
			
			$data['id'] = $this->db->setTableName('spider_listrules')->insert($data,true);
			if (!is_numeric($data['id'])) $this->show_message('添加失败');
			$this->cacheAction();
			$this->show_message('添加成功',1, url('spider/index'),3000);
		}

		$select = '';
		$value = array();
		$rule = $this->db->setTableName('spider_contentrules')->findALL('id,value');
		if (is_array($rule)) foreach ($rule as $t){
			$value = unserialize($t['value']);
			$select .= "<option value='{$t['id']}'>{$value['name']}</option>";
		}
		$variables['select'] = $select;
		
		$this->tree->icon = array(' ','  ','  ');
		$this->tree->nbsp = '&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			if(!$r['child'] && $r['typeid'] != 1) continue;
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$this->tree->init($categorys);
		$category = $this->tree->get_tree(0, $str);
		
		include $this->admin_tpl('spider_editlist');
	}
	
	public function editlistAction() {
		$id = (int)$this->get('id');

		if ($this->post('submit')) {
		
			$data['value'] = $this->post('value');
			$data['value']['id'] = $id;
			$data['value'] = serialize($data['value']);
			
			$this->db->setTableName('spider_listrules')->update($data,  'id=?' , $id);
			$this->cacheAction();
			$this->show_message('修改成功',1, url('spider/index'),3000);
		}
		
		$list = $this->db->setTableName('spider_listrules')->where('id='.$id)->getAll(null, null, 'value', null, null, null);
		$value = unserialize($list[0]['value']);
		$variables = array();
		foreach($value as $k => $v) {
			$variables[$k] = $v;
		}
		$variables['id'] = $id;
		
		$catid = $variables['category'];
		
		$select = '';
		$value = array();
		$rule = $this->db->setTableName('spider_contentrules')->findALL('id,value');
		if (is_array($rule)) foreach ($rule as $t){
			$value = unserialize($t['value']);
			$select .= "<option value='{$t['id']}'>{$value['name']}</option>";
		}
		$variables['select'] = $select;
		
		
		$this->tree->icon = array(' ','  ','  ');
		$this->tree->nbsp = '&nbsp;';
		$categorys = array();
		foreach($this->category_cache as $cid=>$r) {
			if(!$r['child'] && $r['typeid'] != 1) continue;
			$r['disabled'] = $r['child'] ? 'disabled' : '';
			$r['selected'] = $cid == $catid ? 'selected' : '';
			$categorys[$cid] = $r;
		}
		$str  = "<option value='\$catid' \$selected \$disabled>\$spacer \$catname</option>";
		$this->tree->init($categorys);
		$category = $this->tree->get_tree(0, $str);
		
		include $this->admin_tpl('spider_editlist');
	}

	public function addcontentAction() {
		if ($this->post('submit')) {
			$data['value'] = serialize($this->post('value'));
			$data['id'] = $this->db->setTableName('spider_contentrules')->insert($data,true);
			if (!is_numeric($data['id'])) $this->show_message('添加失败');
			$this->cacheAction();
			$this->show_message('添加成功',1, url('spider/index'),3000);
		}

		$variables = array();
		
		$variables['ids'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17);
		//初始化
		$variables['remark'] = array("","标题","缩略图","关键词","描述","内容","排序","状态","点击次数","作者","时间","模型");
		$variables['start'] = array("","<title>");
		$variables['end'] = array("","</title>");
		
		
		$tmphtml = '';
		foreach($variables['ids'] as $k => $id) {
			@$tmphtml .= "
			<tr>
				<td>$id</td>
				<td><input name='value[remark$id]' value='{$variables['remark'][$id]}' type='text' size='5'></td>
				<td><input name='value[start$id]' value='{$variables['start'][$id]}' type='text' size='30'></td>
				<td><input name='value[end$id]' value='{$variables['end'][$id]}' type='text' size='30'></td>
				<td><input name='value[filter$id]' value='{$variables['filter'][$id]}' type='text' size='2'></td>
				<td><input id='spiderpic$id' name='value[spiderpic".$id."]' value='1' type='checkbox'></td>
				<td><input name='value[repeat$id]' value='{$variables['repeat'][$id]}' type='text' size='2'></td>
			</tr>".'<script>if("'.$variables['spiderpic'][$id].'" == "1") $("#spiderpic'.$id.'").attr("checked", true);</script>';
		}
		
		$saveto1 = $saveto2 = '';
		//默认字段
		$fields = array(
			'title'=>'* 标题', 
			'thumb'=>'缩略图', 
			'keywords'=>'关键词', 
			'description'=>'描述', 
			'content'=>'* 内容', 
			'listorder'=>'排序', 
			'status'=>'状态', 
			'hits'=>'点击次数', 
			'username'=>'作者', 
			'time'=>'时间', 
			'modelid'=>'模型',
		);
		foreach($fields as $f => $n) {
			if(!isset($$f)) $$f = '';
			$v = $$f;
			$filter = $f.'_filter';
			if(!isset($$filter)) $$filter = '';
			$filter = $$filter;
			
			if ($f == 'status') {
				$select_status = "<select id='{$f}' name='value[{$f}]'>";
				if (is_array($this->status_arr)) foreach ($this->status_arr  as $key=>$t) {
					$select_status .= "<option value='{$key}'>{$t}</option>";
				}
				$select_status .= "<script>$('#{$f}').val('{$v}');</script>";
				$select_status .= "</select>";
				$saveto1 .= "<tr><td>{$n}</td><td>{$select_status}</td><td></td></tr>";
			} elseif ($f == 'title') {
				$saveto1 .= "<tr><td>{$n}</td><td><input type='text' name='value[$f]' value='[field1]'></td><td><input type='text' name='value[".$f."_filter]' value='$filter' size='5'></td></tr>";
			} else {
				$saveto1 .= "<tr><td>{$n}</td><td><input type='text' name='value[$f]' value='{$v}'></td><td><input type='text' name='value[".$f."_filter]' value='$filter' size='5'></td></tr>";
			}
			
		}
		
		//扩展字段
		for($i = 1; $i <= 10; $i ++) {
			$n = "extname".$i;
			$v = "extvalue".$i;
			$f = "extfilter".$i;
			if(!isset($$n)) $$n = '';
			if(!isset($$v)) $$v = '';
			if(!isset($$f)) $$f = '';
			$saveto2 .= "<tr><td>{$i}.<input type='text' name='extname{$i}' size='10' value='{$$n}'></td><td><input type='text' name='extvalue$i' value='{$$v}'></td><td><input type='text' name='extfilter$i' value='{$$f}' size='5'></td></tr>";
		}
		$variables['saveto1'] = $saveto1;
		$variables['saveto2'] = $saveto2;
		
		include $this->admin_tpl('spider_editcontent');
	}
	
	public function editcontentAction() {
		$get_id = (int)$this->get('id');
		
		
		if ($this->post('submit')) { 
			$data['value'] = serialize($this->post('value'));
			$this->db->setTableName('spider_contentrules')->update($data,  'id=?' , $get_id);
			$this->cacheAction();
			$this->show_message('修改成功',1, url('spider/index'),3000);
		}

		$list = $this->db->setTableName('spider_contentrules')->where('id='.$get_id)->getAll(null, null, 'value', null, null, null);
		$value = unserialize($list[0]['value']);
		$variables = array();
		
		
		foreach($value as $k => $v) {
			if(substr($k, 0, 7) == 'extname') $extnames[substr($k, 7)] = $v;
			if(substr($k, 0, 8) == 'extvalue') $extvalues[substr($k, 8)] = $v;
			$variables[$k] = $v;
			$$k = $v;
		}
		
		$variables['extnames'] = $extnames;
		$variables['extvalues'] = $extvalues;
		
		
		foreach(array('remark', 'start', 'end', 'spiderpic', 'filter', 'repeat') as $tag) {
			$v = array();
			for($i = 1; $i <= 20; $i ++) {
				if(isset($value[$tag.$i])) $v[$i] = $value[$tag.$i];
			}
			$variables[$tag] = $v;
		}
		
		$pageruleselect = "<option value='0'>请选择</option>";
		$variables['pageruleselect'] = $pageruleselect;
		$variables['id'] = $get_id;
		
		$variables['ids'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17);
		
		$tmphtml = '';
		foreach($variables['ids'] as $k => $id) {
			@$tmphtml .= "
			<tr>
				<td>$id</td>
				<td><input name='value[remark$id]' value='{$variables['remark'][$id]}' type='text' size='5'></td>
				<td><input name='value[start$id]' value='{$variables['start'][$id]}' type='text' size='30'></td>
				<td><input name='value[end$id]' value='{$variables['end'][$id]}' type='text' size='30'></td>
				<td><input name='value[filter$id]' value='{$variables['filter'][$id]}' type='text' size='2'></td>
				<td><input id='spiderpic$id' name='value[spiderpic".$id."]' value='1' type='checkbox'></td>
				<td><input name='value[repeat$id]' value='{$variables['repeat'][$id]}' type='text' size='2'></td>
			</tr>".'<script>if("'.$variables['spiderpic'][$id].'" == "1") $("#spiderpic'.$id.'").attr("checked", true);</script>';
		}
		
		$saveto1 = $saveto2 = '';
		//默认字段
		//默认字段
		$fields = array(
			'title'=>'* 标题', 
			'thumb'=>'缩略图', 
			'keywords'=>'关键词', 
			'description'=>'描述', 
			'content'=>'* 内容', 
			'listorder'=>'排序', 
			'status'=>'状态', 
			'hits'=>'点击次数', 
			'username'=>'作者', 
			'time'=>'时间', 
			'modelid'=>'模型',
		);
		foreach($fields as $f => $n) {
			if(!isset($$f)) $$f = '';
			$v = $$f;
			$filter = $f.'_filter';
			if(!isset($$filter)) $$filter = '';
			$filter = $$filter;
			
			if ($f == 'status') {
				$select_status = "<select id='{$f}' name='value[{$f}]'>";
				if (is_array($this->status_arr)) foreach ($this->status_arr  as $key=>$t) {
					$select_status .= "<option value='{$key}'>{$t}</option>";
				}
				$select_status .= "<script>$('#{$f}').val('{$v}');</script>";
				$select_status .= "</select>";
				$saveto1 .= "<tr><td>{$n}</td><td>{$select_status}</td><td></td></tr>";
			} else {
				$saveto1 .= "<tr><td>{$n}</td><td><input type='text' name='value[$f]' value='{$v}'></td><td><input type='text' name='value[{$f}_filter]' value='$filter' size='5'></td></tr>";
			}
			
		}
		
		//扩展字段
		for($i = 1; $i <= 10; $i ++) {
			$n = "extname".$i;
			$v = "extvalue".$i;
			$f = "extfilter".$i;
			if(!isset($$n)) $$n = '';
			if(!isset($$v)) $$v = '';
			if(!isset($$f)) $$f = '';
			$saveto2 .= "<tr><td>{$i}.<input type='text' name='value[extname{$i}]' size='10' value='{$$n}'></td><td><input type='text' name='value[extvalue$i]' value='{$$v}'></td><td><input type='text' name='value[extfilter$i]' value='{$$f}' size='5'></td></tr>";
		}
		$variables['saveto1'] = $saveto1;
		$variables['saveto2'] = $saveto2;
		
		include $this->admin_tpl('spider_editcontent');
	
	}

	public function delelistAction() {
		$id = (int)$this->get('id');
		$this->db->setTableName('spider_listrules')->delete('id=?' , $id);
		delete_cache('spider_listrules'.$id);
		$this->cacheAction();
		$this->show_message('删除成功', 1, url('spider/index'),3000);
	}
	
	public function delcontentAction() {
		$id = (int)$this->get('id');
		$this->db->setTableName('spider_contentrules')->delete('id=?' , $id);
		delete_cache('spider_contentrules'.$id);
		$this->cacheAction();
		$this->show_message('删除成功', 1, url('spider/index'),3000);
	}
	
	public function exportlistAction(){
		$id = (int)$this->get('id');
		$rule = $this->db->setTableName('spider_listrules')->where('id=?' , $id)->getAll(null, null, 'value', null, null, null);
		$rule = base64_encode($rule[0]['value']);
		include $this->admin_tpl('spider_export');
	}
	
	public function exportcontentAction(){
		$id = (int)$this->get('id');
		$rule = $this->db->setTableName('spider_contentrules')->where('id=?' , $id)->getAll(null, null, 'value', null, null, null);
		$rule = base64_encode($rule[0]['value']);
		include $this->admin_tpl('spider_export');
	}
	
	//列表预览
	public function previewlistAction(){
		
		echo '<meta http-equiv=Content-Type content="text/html;charset=utf-8">';
		$id = (int)$this->get('id');
		$value = get_cache('spider_listrules'.$id);
		$rule = $value;		
		$rule['id'] = $id;
		$result = spidermod::spiderlist($rule, 0);
		debug($result);
	}
	
	//内容预览
	public function previewcontentAction(){
		echo '<meta http-equiv=Content-Type content="text/html;charset=utf-8">';
		$id = (int)$this->get('id');
		$rule = get_cache('spider_contentrules'.$id);
		$result = spidermod::spiderurl($rule);
		debug($result);
	}
	
	//采集//
	public function spiderlistAction(){
		$id = (int)$this->get('id');
		$rule = get_cache('spider_listrules'.$id);
		$rule['id'] = $id;
		clearspidertask();
		$result = spidermod::spiderlist($rule, 1);
		$url= url('spider/spider',array('r'=>random(6)));
		header('location:'.$url);
	}
	
	public function spiderAction() {
		$result = spidermod::spider();
		if($result === false) debug('采集完成', 1);
		debug('已经入库');
		if($result !== false) refreshself(1000);
	}
	//采集//

	
	public function cacheAction() {
	    $data = array();
		$rule = $this->db->setTableName('spider_listrules')->findALL('id,value');
		if (is_array($rule)) foreach ($rule as $t){
			$value = unserialize($t['value']);
			foreach($value as $k => $v) {
				$value[$k] = htmlspecialchars_decode($v);
			}
			$value['id'] = $t['id'];
			set_cache('spider_listrules'.$t['id'], $value);
		}
		
		$data = array();
		$rule = $this->db->setTableName('spider_contentrules')->findALL('id,value');
		if (is_array($rule)) foreach ($rule as $t){
			$value = unserialize($t['value']);
			foreach($value as $k => $v) {
				$value[$k] = htmlspecialchars_decode($v);
			}
			$value['id'] = $t['id'];
			set_cache('spider_contentrules'.$t['id'], $value);
		}
	}
	
}