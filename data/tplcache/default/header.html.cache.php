<!DOCTYPE html>
<html>
<head>
	<title>拉手医生</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<link rel="stylesheet" href="/assets/lib/weui.min.css">
	<link rel="stylesheet" href="/assets/css/jquery-weui.css">
	<link rel="stylesheet" href="/assets/css/ionicons.min.css">
	<link rel="stylesheet" href="/assets/css/mobile.css?v=2016061701">
	<script src="/assets/lib/jquery-2.1.4.js"></script>
	<script src="/assets/js/jquery-weui.js"></script>
	<script src="/assets/js/jquery.tmpl.min.js"></script>
	<script src="/assets/js/swiper.js"></script>
	<script src="/assets/js/init.js?v=206061803"></script>
	<?php if ($catid==14) { ?>
		<style type="text/css">
			.top_message{display: none}
		</style>
	<?php } ?>
</head>
<body ontouchstart>
	<div id="container">
	<?php include $this->_include('msg_list.html');  if ($member && $member['status'] == 0 && $member['modelid'] == 7) { ?>
	<div class="weui_cells weui_cells_access nomtop top_message" id="tips_doctor">
		<a class="weui_cell" href="<?php echo url('index/edit'); ?>">
			<div class="weui_cell_bd weui_cell_primary">
					<p style="color:#4e64d3;">请您尽快提供认证，加入我们大家庭！</p>
			</div>
			<div class="weui_cell_ft"></div>
		</a>
	</div>
	<?php }  if ($member && $member['userid'] == 0 && $member['modelid'] == 5) { ?>
	<div class="weui_cells weui_cells_access nomtop top_message" id="tips_jm">
		<div class="weui_cell">
			<div class="weui_cell_bd weui_cell_primary">
					<p style="color:#4e64d3;">请联系身边的医生管理您的健康！</p>
			</div>
		</div>
	</div>
	<?php } ?>
