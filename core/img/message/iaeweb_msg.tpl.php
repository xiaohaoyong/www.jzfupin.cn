<!DOCTYPE html>
<html>
<head>
	<title>提示信息</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" href="/assets/lib/weui.min.css">
	<link rel="stylesheet" href="/assets/css/jquery-weui.css">
	<link rel="stylesheet" href="/assets/css/ionicons.min.css">
	<link rel="stylesheet" href="/assets/css/mobile.css">
	<script src="/assets/lib/jquery-2.1.4.js"></script>
	<script src="/assets/js/jquery-weui.js"></script>
	<script src="/assets/js/swiper.js"></script>
	<script src="/assets/js/init.js"></script>
</head>
<body ontouchstart>
	<div id="container">
<div class="weui_msg">
    <div class="weui_icon_area"><i class="weui_icon_msg weui_icon_<?php if ($status==1){ ?>success<?php }else{?>info<?php }?>"></i></div>
    <div class="weui_text_area">
        <h2 class="weui_msg_title"><?php if ($status==1){ ?>成功<?php }else{?>失败<?php }?></h2>
        <p class="weui_msg_desc"><?php echo $msg; ?></p>
    </div>
    <div class="weui_opr_area">
        <p class="weui_btn_area">
            <?php if($url==1){ ?>
				<a href="javascript:history.back();" class="weui_btn weui_btn_default">返回</a>
				<script language="javascript">setTimeout(function(){history.back();}, <?php echo $time; ?>);</script>
			<?php } else if ($url == 20){?>
				<a href="javascript:window.opener=null;window.open('','_self');window.close();" class="weui_btn weui_btn_default">关闭</a>
				<script language="javascript">setTimeout("window.opener=null;window.open('','_self');window.close();", <?php echo $time; ?>);</script>   
			<?php } else  {?>
				<a href="<?php echo $url?>" class="weui_btn weui_btn_default">确定</a>
				<script language="javascript">setTimeout("location.href='<?php echo $url; ?>';", <?php echo $time; ?>);</script>   
			<?php } ?>
        </p>
    </div>
</div>
</div>
</body>
</html>