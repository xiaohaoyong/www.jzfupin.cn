<?php

class spidermod extends Base {
	
	protected $category_cache;
	protected $content_model;
	public function __construct(){
		
		$this->category_cache = get_cache('category');
		$this->content_model = get_cache('content_model');
		
	}

	public function ifcatched($task) {
		$urlkey = substr(md5($task['url']),8,16);
		$row = $this->db->setTableName('spider_catched')->where("urlkey=?",$urlkey )->getALL();
		
		if($row[0]['itemid']) {
			return $row[0]['itemid']; 
		} else {
			return 0; 
		}
	}
	
	public function spiderlist($rule, $write = 1, $listurl = '') {
		$item_urls = $us = array();
		$u = $listurl;
		if($u == '') $u = $rule['listurl'];
		$us[] = $u;
		if(strpos($u, '(*)') !== false && isset($rule['startid']) && isset($rule['endid'])) {
			$us = array();
			$step = 1;
			if(!empty($rule['step'])) $step = $rule['step'];
			if(is_numeric($rule['startid'])) {
				for($i = $rule['startid']; $i <= $rule['endid']; $i += $step) {
					$i = str_pad($i, strlen($rule['startid']), '0', STR_PAD_LEFT);
					$us[] = str_replace('(*)', $i, $u);
				}
			} else {
				for($i = ord($rule['startid']); $i <= ord($rule['endid']); $i += $step) {
					$us[] = str_replace('(*)', chr($i), $u);
				}
			}
		}
		$url = array_shift($us);
		$text = readfromurl($url, 0);
		$charset = preg_match("/<meta.+?charset=[^\w]?([-\w]+)/i",$text,$temp) ? strtolower($temp[1]):"";  
		$text = toutf8($text,$charset);
		
		$tiptext = '已下载完成，文件长度';
		debug("【".$url."】".$tiptext.strlen($text));
		$text = str_replace("\r", '', $text);
		$text = filter($rule['filter'], $text);//滤镜
		$text = getfield($rule['start'], $rule['end'], $text, '###');
		$texts = explode('###', $text);
		foreach($texts as $text) {
			$links = parselinks($text);
			$urls = array();
			foreach($links as $link => $title) {
				$link = calrealurl($link, $url);
				$link = filter($rule['urlfilter'], $link);
				$title = filter($rule['titlefilter'], $title);
				if(empty($link)) continue;
				if($title === false) continue;
				if(!in_array($link, $urls)) {
					$urls[] = $link;
					$html = '';
					if($rule['appendloophtml']) $html = $text;
					$item_urls[] = array(
						'url' => $link,
						'title' => $title,
						'html' => $html
					);
				}
			}
		}

		foreach($item_urls as $key => $_item) {
			
			$_t = array('url' => $_item['url'], 'listrule' => $rule['id']);
			$catched = Spidermod::ifcatched($_t);
			if($catched) {
				if($rule['update'] == 0) {
					unset($item_urls[$key]);
				} else {
					$itemid[$_item['url']] = $catched;
				}
			}
		}

		$item_urls = array_reverse($item_urls);
		
		//加入任务
		$hookfunction = "hook_spidelist_{$rule['id']}";
		if(function_exists($hookfunction)) $item_urls = $hookfunction($item_urls);
		if(!empty($write)) {
			foreach($item_urls as $item) {
				$task = $item;
				$task['listrule'] = $rule['id'];
				$task['contentrule'] = $rule['rule'];
				if(!empty($itemid[$item['url']])) $task['itemid'] = $itemid[$item['url']];
				addtask('spideritem', $task);
			}
			if(!empty($us)) {
				foreach($us as $u) {
					$task = array(
						'rule' => $rule,
						'write' => $write,
						'url' => $u
					);
					addtask('spiderlist', $task);
				}
			}
		}
		
		return $item_urls;
	}
	
	public function spider() {
		global $__callmode;
		if($task = gettask('spideritem')) {
			$contentrule = get_cache('spider_contentrules'.$task['contentrule']);
			$listrule = get_cache('spider_listrules'.$task['listrule']);
			$result = spidermod::spiderurl($contentrule, $task, $listrule);
			
			if(!empty($result)) {
				if($result == 'banned') return 'banned';
				$id = Spidermod::insertspidereddata($result, $listrule, $task);
				if(!empty($result['pageurls'])) {
					foreach($result['pageurls'] as $k => $r) {
						$task = array(
							'url' => $r['url'],
							'rule' => $contentrule['pagerule'],
							'itemid' => $id,
							'title' => $r['title']
						);
						if($k + 1 == count($result['pageurls'])) $task['createhtml'] = 1;
						addtask('spideritempage', $task);
					}
				} else {
					
				}
				debug($id.','.$result['title']);
				$return = true;
			} else {
				$return = false;
			}
			
		} elseif ($task = gettask('spiderlist')) {
			$rule = $task['rule'];
			$write = $task['write'];
			$url = $task['url'];
			Spidermod::spiderlist($rule, $write, $url);
			$return = $url;
		}
		if(isset($return)) return $return;
		return false;
	}
	
	public function insertspidereddata($spiderresult, $listrule, $task) {
		$thetime = time();
		$itemid = empty($task['itemid']) ? 0 : $task['itemid'];
		$value = $spiderresult;
		
		unset($value['content']);
		
		if(empty($value['catid'])) $value['catid'] = $listrule['category'];
		if(empty($value['time'])) $value['time'] = $thetime;
		
		if(!empty($spiderresult['content'])) $spiderresult['content'] = htmlspecialchars(nl2br($spiderresult['content']));
		
		$catid = $value['catid'];
		$categorys = $this->category_cache[$catid];
		
		if (empty($value['modelid'])) $value['modelid'] = $categorys['modelid'];
		$tablename = $this->content_model[$value['modelid']]['tablename'];
		
		if(!empty($itemid)) {
			debug("update");
			
			$this->db->setTableName('content')->update($value,  'id=?' , $itemid);
			$this->db->setTableName($tablename)->update(array('catid' => $value['catid'], 'content' => $spiderresult['content']),  'id=?' , $itemid);
		} else { 
			$itemid = $this->db->setTableName("content")->insert($value , true);
			
			if(!empty($spiderresult['content'])) {
				$this->db->setTableName($tablename)->insert(array('id' => $itemid, 'catid' => $value['catid'], 'content' => $spiderresult['content']));
			}
			
			if(empty($task['norecord'])) {
				$catched = Spidermod::ifcatched($_t);
				if(!$catched) {
					$catched = array(
						'urlkey' => substr(md5($task['url']),8,16),
						'url' => $task['url'], 
						'dateline' => $thetime,
						'rule' => $task['listrule'],
						'itemid' => $itemid
					);
					$this->db->setTableName('spider_catched')->insert($catched, true);
				}
			}
		}
		return $itemid;
	}


	public function spiderurl($rule, $task = array(), $listrule = array()) {
		if(isset($rule['url'])) $url = $rule['url'];
		if(isset($task['url'])) $url = $task['url'];
		
		if(!isset($url)) return false;
		$return = array();
		$html = $linktext = $append_html = '';
		
		if(!empty($url) && substr($url, 0, 1) != '#') {
			$html = readfromurl($url, 0);
			$charset = preg_match("/<meta.+?charset=[^\w]?([-\w]+)/i",$html,$temp) ? strtolower($temp[1]):"";  
			$html = toutf8($html,$charset);
			if($html == '') return false;
			debug($url.' downloaded!');
		}
		
		if(strpos($html, 'http://verify.baidu.com/') !== false) return 'banned';
		
		$content = "<url:{$url}>\n<title:{$linktext}>\n".$html.$append_html;
		//$content = gbktoutf8($content);
		//if($rule['section']) $content = gbktoutf8($content); 
			
		$content = str_replace("\r", '', $content);
		
		if(!empty($rule['htmlfilter'])) $content = filter($rule['htmlfilter'], $content);
		
		$array_replace = array('[linktext]');
		$array_to = array($linktext);
		$array_replace[] = '[itemid]';
		
		$array_to[] = isset($task['itemid']) ? $task['itemid'] : 0;
		
		for($i = 1; $i <= 20; $i ++) {
			$field_start = $rule["start{$i}"];
			$field_end = $rule["end{$i}"];
			$field_start = str_replace('[n]', "\n", $field_start);
			$field_end = str_replace('[n]', "\n", $field_end);
			$repeat = $rule["repeat{$i}"];
			if(!empty($field_start) && !empty($field_end)) {
				$field[$i] = getfield($field_start, $field_end, $content, empty($rule['repeat'.$i]) ? '' : '[iAEweb-page]');
				$array_replace[] = "[field{$i}]";
				if($field[$i] === false) {
					$array_to[] = '';
				} else {
					empty($listrule) ? $category = 0 : $category = $listrule['category'];
					$config = array(
						'itemurl' => $url,
						'spiderpic' => !empty($rule['spiderpic'.$i]),
						'repeat' => $rule['repeat'.$i],
						'filter' => $rule['filter'.$i],
						'category' => $category
					);
					$spiderfield = calspiderfield($field[$i], $config, $url, !empty($rule['finish']));
					$array_to[] = $spiderfield;
				}
			}
		}
		
		if(!empty($rule['skipwhere'])) {
			if($db->get_by('id', 'items', $skipwhere)) return array();
		}
		
		if(!empty($rule['dateline'])) {
			for($i = 1; $i <= 20; $i ++) {
				if(strpos($rule['dateline'], "[field{$i}]") !== false) {
					$array_to[$i] = strtotime($array_to[$i]);
				}
			}
		}
		
		foreach(array('title', 'thumb', 'keywords', 'description', 'content', 'listorder', 'status', 'hits', 'username', 'time', 'modelid') as $field) {
			$return[$field] = ak_replace($array_replace, $array_to, $rule[$field]);
			if($field == 'dateline') $return[$field] = eval('return '.$return[$field].';');
		}
		$return['title'] = strip_tags($return['title']);
		if(trim($return['title']) == '') return false;
		
		if(empty($return['description']) && !empty($return['content'])) $return['description'] = strcut(trim(strip_tags(str_replace(array(' ', '　　',' ','  ','&nbsp;','&#160;'),'',$return['content']))),200);

		if(empty($return['keywords'])) $return['keywords'] = AutoKeywords($return['title']);
		
		if($return['thumb'] != '') {
			if(strpos($return['thumb'], '<') !== false) {
				$return['thumb'] = pickpicture($return['thumb']);
			} else {
				$picture = calrealurl($return['thumb'], $url);
				if(substr($picture, 0, 7) != 'http://') {
					$return['thumb'] = '';
				} else {
					$return['thumb'] = $picture;
				}
			}
		}

		for($i = 1; $i <= 20; $i ++) {
			if(empty($rule['extname'.$i]) || empty($rule['extvalue'.$i])) continue;
			$v = ak_replace($array_replace, $array_to, $rule['extvalue'.$i]);
			$filter = $rule['extfilter'.$i];
			$v = filter($filter, $v);
			$return['_'.$rule['extname'.$i]] = $v;
		}
		foreach($return as $k => $v) {
			if(substr($k, 0, 1) == '_') continue;
			if(!isset($rule[$k.'_filter'])) continue;
			$filter = $rule[$k.'_filter'];
			$return[$k] = filter($filter, $v);
		}
		
		$hookfunction = "hook_spiderurl_{$rule['id']}";
		if(function_exists($hookfunction)) $return = $hookfunction($return);
		
		return $return;
	}

}