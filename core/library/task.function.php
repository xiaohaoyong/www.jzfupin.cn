<?php
define('TASKFILE', DATA_DIR.'cache/tasks/[key]');
define('TASKFILEOFFSET', DATA_DIR.'cache/tasks/[key].offset');
mkdirs(DATA_DIR."cache/tasks");
function gettask($key, $num = 0, $test = 0) {
	global $__callmode;
	$pid = 0;
	if ($__callmode=='command') $pid = getmypid();
	$cc_pid_path = DATA_DIR.'cache/pids';
	if($num == 0) {
		$onereturn = 1;
		$num = 1;
	}
	if(substr($key, 0, 1) === '*') {
		$key = substr($key, 1);
		$cc = 1;
		createpathifnotexists($cc_pid_path);
		createpathifnotexists("$cc_pid_path/$key");
	}
	$file = str_replace('[key]', $key, TASKFILE);
	if(!file_exists($file)) {
		iae_unlink("$cc_pid_path/$key/$pid");
		return false;
	}
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	if(!file_exists($offsetfile)) touch($offsetfile);
	$task = '';
	($fo = @fopen($offsetfile, 'r+')) || ($fo = @fopen($offsetfile, 'w'));
	flock($fo, LOCK_EX);
	fseek($fo, 0);
	$offset = fgets($fo);
	$offset = (int)$offset;
	if(!$fp = fopen($file, 'r')) {
		flock($fo, LOCK_UN);
		fclose($fo);
		unlink($file);
		unlink($offsetfile);
		unlink("$cc_pid_path/$key/$pid");
		return '';
	}
	fseek($fp, $offset);
	$i = 0;
	$tasks = array();
	while(!feof($fp)) {
		$task = fgets($fp);
		$offset += strlen($task);
		$task = substr($task, 0, -1);
		if($task != '') {
			$i ++;
			$tasks[] = $task;
			if($i >= $num) break;
		}
	}
	fclose($fp);
	if(empty($test)) {
		rewind($fo);
		fwrite($fo, $offset);
		flock($fo, LOCK_UN);
	}
	fclose($fo);
	if(empty($tasks)) {
		@unlink($file);
		@unlink($offsetfile);
		iae_unlink("$cc_pid_path/$key/$pid");
		return false;
	} else {
		iae_touch("$cc_pid_path/$key/$pid");
		foreach($tasks as $k => $v) {
			$v = str_replace('#\n#', "\n", $v);
			if(substr($v, 0, 2) == 'a:') $v = unserialize($v);
			$tasks[$k] = $v;
		}
		if(!isset($onereturn)) {
			return $tasks;
		} else {
			return current($tasks);
		}
	}
}

function addtask($key, $task) {
	if(substr($key, 0, 1) === '*') $key = substr($key, 1);
	$file = str_replace('[key]', $key, TASKFILE);
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	if(!file_exists($offsetfile)) touch($offsetfile);
	$fp = fopen($file, 'a');
	flock($fp, LOCK_EX);
	if(is_array($task)) $task = serialize($task);
	$task = str_replace("\n", '#\n#', $task);
	fwrite($fp, $task."\n");
	flock($fp, LOCK_UN);
	fclose($fp);
}

function gettaskps($key) {
	global $cc_pid_path;
	if(substr($key, 0, 1) === '*') $key = substr($key, 1);
	$array = readpathtoarray("$cc_pid_path/$key");
	if(empty($array)) {
		unlink("$cc_pid_path");
		return 0;
	}
	return count($array);
}

function addtasks($key, $tasks) {
	if(empty($tasks)) return false;
	$file = str_replace('[key]', $key, TASKFILE);
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	if(!file_exists($offsetfile)) touch($offsetfile);
	$fp = fopen($file, 'a');
	flock($fp, LOCK_EX);
	foreach($tasks as $task) {
		if(is_array($task)) $task = serialize($task);
		$task = str_replace("\n", '#\n#', $task);
		fwrite($fp, $task."\n");
	}
	flock($fp, LOCK_UN);
	fclose($fp);
}

function gettaskpercent($key) {
	$file = str_replace('[key]', $key, TASKFILE);
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	
	if(!file_exists($file)) return 100;
	
	$total = filesize($file);
	if(!file_exists($offsetfile)) return 0;
	$current = readfromfile($offsetfile);
	if($current >= $total) {
		@unlink($file);
		@unlink($offsetfile);
		return 99.99;
	}
	return nb($current * 100 / $total);
}

function deletetask($key) {
	$file = str_replace('[key]', $key, TASKFILE);
	$offsetfile = str_replace('[key]', $key, TASKFILEOFFSET);
	@unlink($offsetfile);
	@unlink($file);
}