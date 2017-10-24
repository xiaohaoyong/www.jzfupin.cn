<?php include $this->_include('header.html'); ?>
<script type="text/javascript">
$(function(){
	$('#tabbar').hide();
	$('#tips_jm').hide();
	$('.complete').on('click','#getsmscode',viewModel.getSmsCode);
	$('.complete').on('click','#checksms',function(){
		var agree = $('input#agree:checked').length;

		if(agree > 0 ){
			var re = viewModel.cheaksms();
			<?php if ($member[modelid] == 7) { ?>
				if(re) window.location.href= "/member/index.php?c=index&a=edit";//医生完善
			<?php } else { ?>
				if(re) window.location.href= "/";//居民首页
			<?php } ?>
		} else {
			$.alert("请同意《村医对口帮扶协议》！");
		}
	});
});
</script>
<style type="text/css">
.top_message{display: none}
</style>
<input type="hidden" id="isgetsms" value="0" />
<div class="complete">
	<div class="hd">
		<h2 class="page_title"><img src="/assets/images/loginbg.png" class="logo"/></h2>
	</div>
	<div class="weui_cells weui_cells_form">
	    <div class="weui_cell weui_vcode">
	        <div class="weui_cell_bd weui_vcode weui_cell_primary">
	            <input class="weui_input" type="tel" name="data[phone]" id="phone" placeholder="请输入手机号">
	        </div>
	        <div class="weui_cell_ft">
	        	<a class="weui_btn weui_btn_default" href="javascript:" id="getsmscode">获取验证码</a>
	        </div>
	    </div>
	    <div class="weui_cell">
	        <div class="weui_cell_bd weui_cell_primary">
	            <input class="weui_input" type="tel" name="data[smscode]" id="smscode" placeholder="请输入验证码">
	        </div>
	    </div>

	    <div class="weui_cell weui_cell_switch">
	        <div class="weui_cell_ft weui_cell_hd">
	            <input class="weui_switch" type="checkbox" id="agree" checked style="zoom: 0.8;">
	        </div>
	        <div class="weui_cell_hd weui_cell_primary">
	        	<p class="weui_cells_title">勾选代表您同意《<a href="<?php echo $cats[14][url]; ?>">村医对口帮扶协议</a>》</p>
	        </div>
	    </div>
	</div>

	<div class="weui_btn_area">
	    <button class="weui_btn weui_btn_primary" id="checksms">提交</button>
	</div>
</div>
<?php include $this->_include('footer.html'); ?>