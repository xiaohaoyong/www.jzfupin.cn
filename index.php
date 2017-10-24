<?php
/**
 * iAEweb企业建站版
 * 官方网站:http://www.iaeweb.com
 */
define('IAEWEB_PATH',   dirname(__FILE__) . DIRECTORY_SEPARATOR);
include IAEWEB_PATH . 'core/iaeweb.php';
include IAEWEB_PATH . 'vendor/autoload.php';//增加使用 composer 组件
iaeweb::run();