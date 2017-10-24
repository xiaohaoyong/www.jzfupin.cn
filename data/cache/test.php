<?php


$value=str_replace("<?php if (!defined('IN_IAEWEB')) exit(); ?>","",file_get_contents("member_model.cache.php"));
$value=preg_replace_callback('#s:(\d+):"(.*?)";#s',function($match){return 's:'.strlen($match[2]).':"'.$match[2].'";';},$value);
print_r(unserialize($value));exit;

