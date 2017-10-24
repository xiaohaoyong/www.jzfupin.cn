<?php
/**
 * XiaoCms企业建站版
 * 官方网站:http://www.iaeweb.com
 */
define('IAEWEB_MEMBER',   dirname(__FILE__) . DIRECTORY_SEPARATOR);//定义后台路径
define('CONTROLLER_DIR',     IAEWEB_MEMBER . 'controller' . DIRECTORY_SEPARATOR);   //controller目录的路径
define('IAEWEB_PATH',   dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);//定义XiaoCms项目目录
include IAEWEB_PATH . 'core/iaeweb.php'; //加载框架核心
include IAEWEB_PATH . 'vendor/autoload.php';//增加使用 composer 组件
iaeweb::load_file(CONTROLLER_DIR . 'Member.class.php');//加载后台公共控制器
iaeweb::run();