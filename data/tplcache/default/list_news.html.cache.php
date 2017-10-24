<?php include $this->_include('header.html');  if ($member['modelid'] == 5) { ?>
<script type="text/javascript">
$(function(){
	viewModel.changTarBar(1);
	$('#tips_doctor').hide();//移除提示
})
</script>
<?php }  if ($member['modelid'] == 7 && $catid == 7) { ?>
<script type="text/javascript">
$(function(){
	viewModel.changTarBar(1);
	$('#tips_doctor').hide();//移除提示
})
</script>
<?php } ?>
<div class="weui_cells weui_panel_access nomtop">
	
	<div class="bd">
	    <div class="weui_search_bar" id="search_bar">
	        <form action="index.php" class="weui_search_outer" method="get">
	        	<input type="hidden" value="index" name="c">
				<input type="hidden" value="search" name="a">
				<input type="hidden" value="1" name="modelid">
	            <div class="weui_search_inner">
	                <i class="weui_icon_search"></i>
	                <input type="search" name="kw" class="weui_search_input" id="search_input" placeholder="请您输入您要想了解的资讯" required="">
	                <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
	            </div>
	            <!--label for="search_input" class="weui_search_text" id="search_text">
	                <i class="weui_icon_search"></i>
	                <span>请您输入您要想了解的资讯</span>
	            </label-->
	        </form>
	        <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
	    </div>
	</div>

	<?php include $this->_include('block_nav.html'); ?>
</div>
	
<?php include $this->_include('list.html');  include $this->_include('footer.html'); ?>