<?php
/**
 * Created by PhpStorm.
 * User: wangzhen
 * Date: 17/10/24
 * Time: 下午1:57
 */

$value=str_replace("<?php if (!defined('IN_IAEWEB')) exit(); ?>","",file_get_contents("category.cache.php"));
$value = preg_replace('!s:(\d+):"(.*?)";!se', "'s:'.strlen('$2').':\"$2\";'", $value);
print_r(unserialize($value)[7]);exit;

