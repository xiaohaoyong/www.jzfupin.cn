<?php include $this->_include('header.html'); ?>

<script type="text/javascript">
$(function(){
	viewModel.changTarBar(2);
})
</script>
<style type="text/css">
	.weui_grid.user_nav{padding:10px 0; text-align: center;}
</style>

<?php $return_con = $this->_listdata("catid=25 uid=$member[id] num=1 iaeweb=1  return=con"); extract($return_con); if (is_array($return_con))  foreach ($return_con as $key_con=>$con) {  }  $age = empty($con['age']) ?  birthday($con['birthday']) : $con['age'];  $sex = $con['sex'] ?  $con['sex'] : $member['sex'];  $age = $age ? $age : $member['age'];  $avatar = !empty($member['avatar']) ? $member['avatar'] : "/assets/images/avatar.png";  $title = $member[name];  $age_old = !empty($member['age'])?  birthday($con[birthday]) : $member['age'];  $phone = $member[phone];  $thumb = !empty($con[thumb]) ? $con[thumb] : $avatar;  $thumb = !empty($thumb) ? $thumb : "/assets/images/avatar.png";  $title = !empty($con['title']) ? $con['title'] : $member['name'];  $message_num=0;  $return = $this->_listdata("table=diy_message order=id_desc userid=$member[id] status=0"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $message_num++;  } ?>

<div class="weui_cells nomtop">
	<div class="weui_msg">
		<h2 class="page_title">
			<div class="weui_media_appmsg_thumb thumb_avatar radius100" style="background-image:url(<?php echo $thumb; ?>);"></div>
		</h2>
		<h2 class="weui_msg_title"><?php echo $title; ?></h2>
		<h2 class="text-sm color-gray"><?php echo $arraysex[$sex]; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $age; ?>岁</h2>
		<div class="weui_btn_area nomtop">
			<!--<a href="javascript:;" class="weui_btn weui_btn_mini weui_btn_default">按钮</a>
			<a href="javascript:;" class="weui_btn weui_btn_mini weui_btn_default">按钮</a>
			<a href="<?php echo url('login/out'); ?>" class="weui_btn weui_btn_mini weui_btn_default">开发按钮</a>-->
		</div>
		<div class="blank15"></div>
	</div>
</div>

<?php if ($con[poor]) { ?>
<div class="weui_cells nomtop">
	<div class="weui_grids">
		<a href="javascript:;" class="weui_grid user_nav text-sm"><?php echo $con[pksx]; ?><span class="color-gray block">贫困属性</span></a>
		<a href="javascript:;" class="weui_grid user_nav text-sm"><?php echo $con[pkxz]; ?><span class="color-gray block">贫困性质</span></a>
		<a href="javascript:;" class="weui_grid user_nav text-sm"><?php echo $con[pkyy]; ?><span class="color-gray block">贫困原因</span></a>
	</div>
</div>
<?php } ?>


<div class="weui_cells">
    <div class="weui_grids">
        <a href="<?php echo $cats[26][url]; ?>" class="weui_grid">
            <div class="weui_grid_icon">
                <?php if ($message_num > 0) { ?><span class="ui-badge"><?php echo $message_num; ?></span><?php } ?>
                <i class="ion-ios-bell"></i>
            </div>
            <p class="weui_grid_label">
                消息提醒
            </p>
        </a>
        <a href="/?id=<?php echo $con[id]; ?>&tab=3&header=2" class="weui_grid">
            <div class="weui_grid_icon">
                <i class="ion-chatbubbles"></i>
            </div>
            <p class="weui_grid_label">问诊记录</p>
        </a>
        <a href="/?id=<?php echo $con[id]; ?>&tab=4&header=2" class="weui_grid">
            <div class="weui_grid_icon">
                <i class="ion-ios-pulse-strong"></i>
            </div>
            <p class="weui_grid_label">预警记录</p>
        </a>
        <a href="/?c=api&a=quan&header=2" class="weui_grid">
            <div class="weui_grid_icon">
                <i class="ion-ios-book"></i>
            </div>
            <p class="weui_grid_label">宣教记录</p>
        </a>
		<a href="/?c=api&a=family" class="weui_grid">
			<div class="weui_grid_icon">
				<i class="ion-ios-people"></i>
			</div>
			<p class="weui_grid_label">家庭成员</p>
		</a>
        <a href="/?c=index&a=form&modelid=3" class="weui_grid">
            <div class="weui_grid_icon">
                <i class="ion-paintbrush"></i>
            </div>
            <p class="weui_grid_label">意见反馈</p>
        </a>

    </div>
</div>

<?php include $this->_include('footer.html'); ?>