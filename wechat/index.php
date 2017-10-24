<?php
error_reporting(0);//禁用错误报告 屏蔽 esaywechat 3.0 微信接口 BUG
define('IAEWEB_WECHAT',   dirname(__FILE__) . DIRECTORY_SEPARATOR);//定义后台路径
define('CONTROLLER_DIR',     IAEWEB_WECHAT . 'controller' . DIRECTORY_SEPARATOR);   //controller目录的路径
define('IAEWEB_PATH',   dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);//定义XiaoCms项目目录
include IAEWEB_PATH . 'core/iaeweb.php'; //加载框架核心
include IAEWEB_PATH . 'vendor/autoload.php';//增加使用 composer 组件
iaeweb::run();