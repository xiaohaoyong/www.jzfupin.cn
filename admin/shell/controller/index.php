<?php 
class index extends Base {
	public function __construct() {
		parent::__construct();
	}
	public function indexAction() {
		$__callmode = 'command';
		debug('start spider');
		if(!empty($_SERVER['argv'][1])) {
			clearspidertask();
			$id = $_SERVER['argv'][1];
			$rule = get_cache('spider_listrules'.$id);
			if(!empty($_SERVER['argv'][2])) {
				$url = $_SERVER['argv'][2];
				$_t = array('url' => $url, 'listrule' => $id);
				if($catched = Spidermod::ifcatched($_t)) {
					if($rule['update'] == 0) {
						debug('no update');
					} else {
						debug('update');
					}
				}
				$task = array();
				$task['listrule'] = $id;
				$task['contentrule'] = $rule['rule'];
				$task['url'] = $url;
				$task['title'] = $task['html'] = '';
				$task['itemid'] = $catched;
				addtask('spideritem', $task);
			} else {
				$result = Spidermod::spiderlist($rule);
				debug('add all tasks');
			}
			if(in_array('pause', $_SERVER['argv'])) exit();
			while($result = Spidermod::spider()) {
				debug($result);
			}
			debug('end spider');
		}
	}

} 