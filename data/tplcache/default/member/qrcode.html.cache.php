<?php include $this->_include('header.html'); ?>

<div class="top_tabbar">
    <div class="weui-row weui-no-gutter">
        <a href="/member/?c=content&a=qrcode" class="weui-col-50 open">扫码添加</a>
        <a href="/member/?c=content&a=family" class="weui-col-50">手动添加</a>
    </div>
</div>

<div style="margin:20px;text-align:center">
	<img src="<?php echo $qrcode; ?>" width="80%" />
</div>