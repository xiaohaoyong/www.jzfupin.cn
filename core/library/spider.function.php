<?php 
if (!defined('IN_IAEWEB')) exit();
function whospider() {
	if(function_exists('curl_init') && function_exists('curl_exec')) {
		return 'curl';
	} elseif(function_exists('fsockopen')) {
		return 'fsock';
	} elseif(ini_get('allow_url_fopen') == '1') {
		return 'fopen';
	} elseif(!empty($GLOBALS['wget']) && function_exists('system')) {
		return 'wget';
	}
	return false;
}

function readfromurl($url, $convertcharset = 0, $type = '', $ext = array()) {
	if($type == '') $type = whospider();
	$agent = 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.2; SV1; Yahoo! Spider)';
	if($type == 'wget') {
		$_tmp = DATA_DIR.'spidercache/'.md5($url);
		system("wget --timeout=10 --tries=3 --no-check-certificate --user-agent=\"$agent\" -q -O {$_tmp} \"".$url."\"");
		$content = readfromfile($_tmp);
		@akunlink($_tmp);
	} elseif($type == 'curl') {
		$ch = curl_init();
		@curl_setopt($ch, CURLOPT_ENCODING, '');
		curl_setopt($ch, CURLOPT_URL, $url);
		if(!empty($ext['cookie'])) {
			$cookies = array();
			foreach($ext['cookie'] as $key => $value) {
				$cookies[] = "$key=$value";
			}
			$cookie = implode('; ', $cookies);
			curl_setopt($ch, CURLOPT_COOKIE, $cookie);
		}
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		@curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		$content = curl_exec($ch);
		curl_close($ch);
	} elseif($type == 'fsock') {
		$offset = strpos($url, '://');
		if($offset === false) return false;
		if(strpos($url, '/', $offset + 3) === false) $url .= '/';
		$parts = parse_url($url);
		$host = $parts['host'];
		$port = 80;
		if($parts['scheme'] == 'https') $port = 443;
		$path = $parts['path'];
		if(!empty($parts['query'])) $path .= "?".$parts['query'];
		$request =  "GET ".$path." HTTP/1.0\r\n";
		$request .= "Host: ".$host."\r\n";
		$request .= "Accept: */*\r\n";
		$request .= "Connection: keep-alive\r\n";
		$request .= "User-Agent: {$agent}\r\n\r\n";
		if($parts['scheme'] == 'https') {
			$sHnd = fsockopen("ssl://".$host, $port, $errno, $errstr, 30);
		} else {
			$sHnd = fsockopen($host, $port, $errno, $errstr, 30);
		}
		if($sHnd === false) {
			debug($errstr);
			return false;
		}
		fputs($sHnd, $request);
		$content = '';
		while(!feof($sHnd)) {
			if(!isset($step)) $step = 4096;
			$line = fgets($sHnd, $step + 1);
			if(strpos($line, 'Location:') === 0) {
				$url = substr(trim($line), 10);
				return readfromurl($url, $convertcharset, $type);
			}
			if(isset($size) && isset($length)) {
				$content .= $line;
				if($length != -1) {
					$size += strlen($line);
					$step = min(4096, $length - $size);
					if($step <= 0) break;
				}
			}
			if(substr($line, 0, 15) == 'Content-Length:') $length = intval(substr($line, 15));
			if($line == "\r\n" && !isset($size)) {
				$size = 0;
				if(!isset($length)) $length = -1;
			}
		}
		fclose($sHnd);
	} elseif($type == 'fopen') {
		@ini_set('user_agent', $agent);
		$content = readfromfile($url);
	} else {
		return 'ERROR:spider disabled!';
	}
	if(!empty($convertcharset)) {
		$content = gbktoutf8($content);
	}
	return $content;
}


/*
* fopen 方法
*/
function readfromfile($filename) {
	if(substr($filename, 0, 7) != 'http://' && !is_readable($filename)) return '';
	if(PHP_VERSION < '4.3.0') {
		if(!$fp = fopen($filename, 'r')) {
			return false;
		} else {
			flock($fp, LOCK_EX);
			$return = '';
			while (!feof($fp)) {
				$return .= fgets($fp, 4096);
			}
			fclose($fp);
			return $return;
		}
	} else {
		return file_get_contents($filename);
	}
}
/*
* GBK转UTF-8 方法
*/
function toutf8($text , $charset = "") {
	if($charset == 'gbk'||$charset == 'gb2312') $text = gbktoutf8($text);
	return $text;
}

function gbktoutf8($var) {
	if(!function_exists('iconv')) return $var;
	if(is_array($var)) {
		foreach($var as $id => $value) {
			$var[$id] = gbktoutf8($value);
		}
		return $var;
	} else {
		return iconv('GBK', 'UTF-8//IGNORE', $var);
	}
}

/*
* DEBUG 方法
*/
function debug($variable, $exit = 0, $type = 0) {
	global $__callmode, $header_charset, $pid;
	if('command' == $__callmode) $type = 3;
	if(is_object($variable)) {
		$objflag = 1;
		$variable = get_object_vars($variable);
	}
	if(is_array($variable) || is_object($variable)) {
		$info = print_r($variable, 1);
	} elseif($variable === false) {
		$info = '(bool)false';
	} else {
		$info = $variable;
	}
	if($type != 3) $info = htmlspecialchars($info);
	if(isset($objflag)) $info = "Object\n".substr($info, 6);
	if($type == 0) {
		$info = str_replace("\n", '<br>', $info);
		$info = str_replace(" ", '&nbsp;', $info);
		echo "<div style=\"border:1px dashed #222222;margin:2px;font: 12px Verdana;line-height: 20px;background-color: #FFFFE0;padding: 10px;text-align:left;\">".$info."</div>";
	} elseif($type == 1) {
		$info = str_replace("\n", '\n', $info);
		echo "<html><head><meta http-equiv='Content-Type' content='text/html; charset={$header_charset}' />";
		echo "<script>alert('".$info."');</script></head><body>";
	} elseif($type == 2) {
		$info = str_replace("\n", '\n', $info);
		echo "alert(\"".$info."\");";
	} elseif($type == 3) {
		echo("#$pid\t".utf8togbk($info)."\n");
	}
	if($exit == 1) {
		if(function_exists('aexit')) aexit('');
		exit();
	}
}

/*
* 滤镜方法 方法
*/
function filter($id, $input, $filters = array()) {
	if(empty($id)) return $input;
	if(empty($filters)) $filters = get_cache('filters');
	if(is_array($input)) {
		foreach($input as $k => $v) {
			$input[$k] = filter($id, $v, $filters);
		}
		return $input;
	}
	if(!isset($filters[$id])) return $input;
	$filterrule = $filters[$id]['data'];
	$filterrules = explode("\n", $filterrule);
	foreach($filterrules as $rule) {
		if(substr($rule, 0, 1) == '#') continue;
		$rule = trim($rule, "\r\n");
		if(substr($rule, 0, 4) == 'php:' && substr($rule, -1) == ';') {
			$rule = substr($rule, 4);
			if(is_string($input)) {
				$rule = str_replace('$input', "'".str_replace("'", "\'", $input)."'", $rule);
			}
			$input = eval("return $rule");
		} elseif(substr($rule, 0, 8) == 'include:') {
			$newid = substr($rule, 8);
			$input = filter($newid, $input, $filters);
		} elseif(substr($rule, 0, 8) == 'replace:') {
			$rule = substr($rule, 8);
			$rule = str_replace('[|]', '[#]', $rule);
			if(substr_count($rule, '|') != 1) continue;
			list($replace, $to) = explode('|', $rule);
			$replace = str_replace('[#]', '|', $replace);
			$to = str_replace('[#]', '|', $to);
			$replace = str_replace('[n]', "\n", $replace);
			$to = str_replace('[n]', "\n", $to);
			$input = str_replace($replace, $to, $input);
		} elseif(substr($rule, 0, 13) == 'preg_replace:') {
			$rule = substr($rule, 13);
			$rule = str_replace('[|]', '[#]', $rule);
			if(substr_count($rule, '|') != 1) continue;
			list($replace, $to) = explode('|', $rule);
			$replace = str_replace('[|]', '[#]', $replace);
			$to = str_replace('[|]', '[#]', $to);
			$input = preg_replace("/$replace/Uis", $to, $input);
		} elseif(substr($rule, 0, 5) == 'keep:') {
			$rule = substr($rule, 5);
			if(strpos($input, $rule) === false) $input = false;
		} elseif(substr($rule, 0, 6) == 'clear:') {
			$rule = substr($rule, 6);
			if(strpos($input, $rule) !== false) $input = false;
		}
	}
	return $input;
}

/*
* 获取字段 方法
*/
function getfield($start = '<body>', $end = '</body>', $content, $repeatsplit = '') {
	if(empty($content)) return false;
	$return = '';
	while(1) {
		$start_position = 0;
		$end_position = strlen($content);
		if($start != '') $start_position = strpos($content, $start);
		if($start_position === false) break;
		$start_position += strlen($start);
		if($end != '') $end_position = strpos($content, $end, $start_position);
		if($end_position === false) break;
		$return .= substr($content, $start_position, $end_position - $start_position);
		if(empty($repeatsplit)) return $return;
		$return .= $repeatsplit;
		$content = substr($content, $end_position + strlen($end));
	}
	if(strlen($return) > strlen($repeatsplit)) $return = substr($return, 0, strlen($return) - strlen($repeatsplit));
	return $return;
}

/*
* 获取链接地址 方法
*/
function parselinks($html) {
	$html = strip_tags($html, '<a>');
	preg_match_all("'<\s*a.*?href\s*=(.+?)(\s+.*?)?>(.*?)<\s*/a\s*>'isx", $html, $matchs);
	$links = array();
	foreach($matchs[1] as $key => $link) {
		$link = str_replace('\'', '', $link);
		$link = str_replace('"', '', $link);
		$title = $matchs[3][$key];
		$links[$link] = $title;
	}
	return $links;
}
function calrealurl($target, $baseurl = '') {
	if(strpos($target, '://') !== false) return $target;
	if(substr($target, 0, 1) == '/') {
		$domain = getdomain($baseurl);
		return 'http://'.$domain.'/'.substr($target, 1);
	} else {
		$urlpath = geturlpath($baseurl);
		return $urlpath.$target;
	}
}

function geturlpath($url) {
	if(substr($url, -1) == '/') return $url;
	$pos = strrpos($url, '/');
	return substr($url, 0, $pos + 1);
}

function getdomain($url) {
	$string = getfield('://', '', $url);
	if(strpos($string, '/') === false) return $string;
	return getfield('', '/', $string);
}

/*
*采集内容 方法
*/

/*
*截取字段 方法
*/
function calspiderfield($html, $config, $url = '', $finish = 0) {
	if(strpos($html, '<!--akcmsspidersplit-->') !== false && !empty($config['repeat'])) {
		$htmls = explode('<!--akcmsspidersplit-->', $html);
		$return = array();
		foreach($htmls as $html) {
			$return[] = calspiderfield($html, $config, $url, $finish);
		}
		return implode($config['repeat'], $return);
	}
	$html = str_replace("\t", '', $html);
	$html = str_replace("\r", '', $html);
	$html = str_replace("\n", '', $html);
	$html = filter($config['filter'], $html);
	if(!empty($config['spiderpic'])) {
		$html = copypicturetolocal($html, $config);
	}
	return $html;
}


function ak_replace($find, $replace, $str, $caseless = 1, $count = -1) {//$caseless是否区分大小写，0为不区分
	if(!is_array($find)) {
		$find = array($find);
	}
	if(!is_array($replace)) {
		$replace = array($replace);
	}
	if(count($find) != count($replace)) return false;
	if($caseless == 1) {
		foreach($find as $id => $f) {
			if($f == '') continue;
			if(strpos($str, $f) === false) continue;
			$str = str_replace_count($f, $replace[$id], $str, $count);
		}
	} else {
		foreach($find as $id => $f) {
			$f = str_replace('/', '\/', $f);
			if(!preg_match("/{$f}/i", $str)) continue;
			$str = preg_replace("/{$f}/i", $replace[$id], $str, $count);
		}
	}
	return $str;
}

function str_replace_count($search, $replace, $string, $count) {
	if($count < 0) {
		return str_replace($search, $replace, $string);
	} elseif($count == 0) {
		return $string;
	} else {
		return str_replace_count($search, $replace, str_replace_once($search, $replace, $string), $count - 1);
	}
}

/*
*获取图片 方法
*/
function pickpicture($html, $baseurl = '') {
	preg_match_all("/<img(.*?)src=(.+?)['\" >]+/is", $html, $match);
	$pics = array();
	foreach($match[2] as $pic) {
		$pic = str_replace('"', '', $pic);
		$pic = str_replace('\'', '', $pic);
		if(!empty($pic)) break;
	}
	if(empty($pic)) return '';
	//return calrealurl($pic, $baseurl);
	return $pic;
}

//关键词
function AutoKeywords($subject) {
	if (empty($subject)) return "";
	$data = @implode('', file('http://keyword.discuz.com/related_kw.html?ics=utf-8&ocs=utf-8&title=' . rawurlencode($subject) . '&content=' . rawurlencode($subject))); 
	if($data) {
		$parser = xml_parser_create();
		xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
		xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
		xml_parse_into_struct($parser, $data, $values, $index);
		xml_parser_free($parser);
		$kws = array();
		foreach($values as $valuearray) {
			if($valuearray['tag'] == 'kw' || $valuearray['tag'] == 'ekw') {
				$kws[] = trim($valuearray['value']);
			}
		}
	 return implode(',', $kws);
	}
}

//远程图片+域名   未来增加本地化//
function copypicturetolocal($html, $config, $task = 0) {
	
	if($html == '') return '';
	$category = $config['category'];
	preg_match_all("/<img(.*?)src=(.+?)['\" >]+/is", $html, $match);
	$pics = array();
	foreach($match[2] as $pic) {
		$pic = str_replace('"', '', $pic);
		$pic = str_replace('\'', '', $pic);
		$pics[] = $pic;
	}
	$pics = array_unique($pics);
	if(strpos($html, '<') === false) $html = calrealurl($html, $config['itemurl']);
	if(substr($html, 0, 7) == 'http://') $pics[] = $html;
	
	//存储路径
	$path   =  'data/upload/image/' . date('Ym') . '/';
	if (!is_dir(IAEWEB_PATH .$path)) mkdirs(IAEWEB_PATH .$path);
	$image = iaeweb::load_class('image');
	
	foreach($pics as $pic) {
		//$picname = get_upload_filename($pic, 0, $category, 'image');
		$pictureurl = calrealurl($pic, $config['itemurl']);
		
		if (strpos($pictureurl, SITE_URL) !== false || substr($pictureurl, 0, 7) != 'http://') continue;
		
		$fileext =  fileext($pictureurl);
		$name	 = $path . substr(md5($pictureurl. time()),8,16) . '.' . $fileext;
		$content = @file_get_contents($pictureurl);
		
		if (empty($content)) continue;
		if (file_put_contents(IAEWEB_PATH .$name, $content)) $pictureurl = Base::get_a_url() . $name;

		//if(strpos($pictureurl, $homepage) !== false) continue;
		/*if(!empty($task)) {
		} else {
			$picturedata = readfromurl($pictureurl);
			writetofile($picturedata, FORE_ROOT.$picname);
			require_once(CORE_ROOT.'include/image.func.php');
			operateuploadpicture(FORE_ROOT.$picname, $category);
		}*/
		$html = str_replace($pic, $pictureurl, $html);
	}
	return $html;
}

/*
*随机字符
*/
function random($length, $chars = '') {
	if(PHP_VERSION < '4.2') mt_srand();
	$hash = '';
	if($chars == '') $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
	$max = strlen($chars) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $chars[mt_rand(0, $max)];
	}
	return $hash;
}


/*
*清理之前留下未完成的采集任务
*/
function clearspidertask() {
	deletetask('spideritempage');
	deletetask('spideritem');
	deletetask('spiderlist');
	deletetask('spiderpicture');
}

function iae_touch($file) {
	$dir = dirname($file);
	mkdirs($dir);
	return touch($file, thetime());
}
function iae_unlink($filename) {
	if(file_exists($filename) && is_writable($filename)) return unlink($filename);
	return false;
}
function thetime() {
	global $timedifference;
	return time() + $timedifference * 3600;
}

function refreshself($timeout) {
	$script = "<script language='javascript'>setTimeout(\"document.location.reload()\", [timeout]);</script>";
	$script = str_replace('[timeout]', $timeout, $script);
	//aexit($script);
	exit(''.$script);
}

function utf8togbk($var) {
	if(!function_exists('iconv')) return $var;
	if(is_array($var)) {
		foreach($var as $id => $value) {
			$var[$id] = utf8togbk($value);
		}
		return $var;
	} else {
		$result = iconv('UTF-8', 'GBK//IGNORE', $var);
		if($result === false) return $var;
		return $result;
	}
}