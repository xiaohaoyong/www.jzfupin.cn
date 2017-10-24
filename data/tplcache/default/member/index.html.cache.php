<?php include $this->_include('header.html'); ?>

<script type="text/javascript">
$(function(){

<?php if ($member['modelid'] == 7) { ?>
	viewModel.changTarBar(2);
<?php }  if ($member['modelid'] == 5) { ?>
	$('#user_nav').find('a').eq(0).addClass('open');
<?php } ?>

})
</script>

<?php include $this->_include('member/user_header.html');  $message_num=0;  $return = $this->_listdata("table=diy_message order=id_desc userid=$member[id] status=0"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $message_num++;  }  if ($member['modelid'] == 7) { ?>
<div class="weui_cells nomtop">
    <div class="weui_grids">
        <a href="<?php echo url('index/edit'); ?>" class="weui_grid">
            <div class="weui_grid_icon">
                <?php if ($member[status] !=1) { ?><span class="ui-badge">1</span><?php } ?>
                <i class="ion-compose"></i>
            </div>
            <p class="weui_grid_label">
                个人资料
            </p>
        </a>
        <a href="/index.php?catid=18#asklist" class="weui_grid">
            <div class="weui_grid_icon">
                <i class="ion-chatbubbles"></i>
            </div>
            <p class="weui_grid_label">问答列表</p>
        </a>
        
        <a href="<?php echo $cats[26][url]; ?>" class="weui_grid">
            <div class="weui_grid_icon">
                <?php if ($message_num > 0) { ?><span class="ui-badge"><?php echo $message_num; ?></span><?php } ?>
                <i class="ion-ios-bell"></i>
            </div>
            <p class="weui_grid_label">
                消息提醒
            </p>
        </a>

        <a href="#/progress" class="weui_grid">
            <div class="weui_grid_icon">
                <i class="ion-ios-book-outline"></i>
            </div>
            <p class="weui_grid_label">宣教阅读</p>
        </a>
		<a href="<?php echo $cats[14][url]; ?>" class="weui_grid">
			<div class="weui_grid_icon">
				<i class="ion-ios-list-outline"></i>
			</div>
			<p class="weui_grid_label">帮扶规则</p>
		</a>
        
        <a href="#/dialog" class="weui_grid">
            <div class="weui_grid_icon">
                <i class="ion-android-clipboard"></i>
            </div>
            <p class="weui_grid_label">预警记录</p>
        </a>
        <!--a href="/index.php?c=index&a=form&modelid=3" class="weui_grid">
            <div class="weui_grid_icon">
                <i class="ion-paintbrush"></i>
            </div>
            <p class="weui_grid_label">意见反馈</p>
        </a-->

    </div>
</div>

<div class="weui_btn_area">
    <a href="/index.php?c=index&a=form&modelid=3" class="weui_btn weui_btn_primary">意见反馈</a>
</div>
<?php } else {  }  include $this->_include('footer.html'); ?>