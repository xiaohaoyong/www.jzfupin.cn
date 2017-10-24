<?php
/**
 * iAEweb企业建站版
 * 官方网站:http://www.iaeweb.com
 */
global $__callmode;
global $header_charset;
global $pid;
$__callmode = 'command';
$header_charset = 'utf-8'; 
$pid = getmypid();
define('IAEWEB_SHELL',   dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('CONTROLLER_DIR',     IAEWEB_SHELL . 'controller' . DIRECTORY_SEPARATOR);
define('CLASS_DIR',   dirname(dirname(__FILE__)). DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);
define('IAEWEB_PATH',  dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR);
include IAEWEB_PATH . 'core/iaeweb.php';
iaeweb::load_file(CORE_PATH. 'library' .'spidermod.class.php');
require(CORE_PATH. 'library' .'/task.function.php');
iaeweb::run();
