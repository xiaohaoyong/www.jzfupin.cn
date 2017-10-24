<?php 
if (!empty($_GET['token']) && $_GET['token'] === 'tgpu9w4vjon8uwqh5inqizk5lvop519n'){
	error_reporting ( E_ALL );
	$dir = dirname(__FILE__);
	$handle = popen('cd '.$dir.' && git pull 2>&1','r');
	$read = stream_get_contents($handle);
	printf($read);
	pclose($handle);	
} else {
	echo "Access Barred!";
}