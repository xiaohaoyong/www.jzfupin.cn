<div class="weui_cells nomtop">
	<div class="weui_msg">
		<h2 class="page_title">
			<div class="weui_media_appmsg_thumb thumb_avatar radius100" style="background-image:url(<?php echo $member[avatar]; ?>);"></div>
		</h2>
		<h2 class="weui_msg_title"><?php echo $member[name]; ?></h2>
		<?php if ($member['modelid'] == 5) { ?><h2 class="text-sm color-gray"><?php echo $arraysex[$member[sex]]; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $member[age]; ?>岁</h2><?php } ?>
		<div class="weui_btn_area nomtop">
			<?php if (!empty($member['good'] && $member['modelid'] == 7 )) { ?>
			<a href="javascript:;" class="weui_btn weui_btn_mini weui_btn_default"><?php echo $member['good']; ?></a>
			<?php } ?>
		</div>
		<div class="blank15"></div>
	</div>
	<?php if ($member['modelid'] == 5) { ?>
	<div class="weui_cell text-sm">
        <div class="weui_cell_bd weui_cell_primary">身份证号</div>
        <div class="weui_cell_bd">
           <?php echo $member['cardid']; ?>
        </div>
    </div>
    <div class="weui_cell text-sm">
        <div class="weui_cell_bd weui_cell_primary">联系方式</div>
        <div class="weui_cell_bd">
           <?php echo $member['phone']; ?>
        </div>
    </div>
    <div class="weui_cell text-sm">
        <div class="weui_cell_bd weui_cell_primary">户主</div>
        <div class="weui_cell_bd">
           <?php echo $member['family']; ?>
        </div>
    </div>
    <?php } ?>
</div>
<?php if ($member['modelid'] == 5) { ?>
<div class="weui_cells weui-row weui-no-gutter col-border line2 panel_nav" style="margin-top:10px;" id="user_nav">
  <a href="javascript:;" class="weui-col-25">体检结果</a>
  <a href="javascript:;" class="weui-col-25">健康指标</a>
  <a href="javascript:;" class="weui-col-25">问诊列表</a>
  <a href="javascript:;" class="weui-col-25">预警列表</a> 
</div>
<?php }  if ($member['modelid'] == 7) {  $uids=[];  $return_con = $this->_listdata("catid=25 userid=$member[id]  return=con"); extract($return_con); if (is_array($return_con))  foreach ($return_con as $key_con=>$con) {  if ($con[uid]) {  $uids[] = $con[uid];  }  }  $uids = implode(',',$uids);  $zan = 0;  $cai = 0;  $pin = 0;  $tou = 0;  $return = $this->_listdata("table=form_like userid=$uids type=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $zan++;  }  $return = $this->_listdata("table=form_like userid=$uids type=0"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $cai++;  }  $return = $this->_listdata("table=form_share userid=$uids"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $pin++;  }  $return = $this->_listdata("table=diy_tousu uid=$uids"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $tou++;  } ?>



<div class="weui_cells weui-row weui-no-gutter col-border panel_nav nomtop line12 grzx_like" style="border-width:0 1px 0 1px">
	<a href="javascript:;" class="weui-col-25"><?php echo $zan; ?><span class="text-sm block">被赞次数</span></a>
	<a href="javascript:;" class="weui-col-25"><?php echo $cai; ?><span class="text-sm block">倒彩次数</span></a>
	<a href="javascript:;" class="weui-col-25"><?php echo $pin; ?><span class="text-sm block">评论次数</span></a>
	<a href="javascript:;" class="weui-col-25"><?php echo $tou; ?><span class="text-sm block">评价次数</span></a>
</div>
<?php } ?>