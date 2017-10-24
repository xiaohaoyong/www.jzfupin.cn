<?php include $this->_include('header.html');  $display="";  $copen='display:none';  if ($_GET['header']) {  $display='display:none';  $copen="";  } ?>
<script type="text/javascript">
$(function(){
	$('#qywy').click(function(){
		$.confirm("确定寻医问药？", function() {
		  	var userid = <?php echo $member[userid]; ?>;
		  	var uid = <?php echo $member[id]; ?>;
		  	if(userid > 0) {
		  		viewModel.telme(uid);
		  	} else {
		  		$.alert('你还没有辖区医生');
		  	}
		  }, function() {
		  	
		  });
	});
});
</script>

<?php if ($what) {  $return = $this->_listdata("table=member id=$member[userid] num=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $return_info = $this->_listdata("table=member_doctor id=$v[id] num=1  return=info"); extract($return_info); if (is_array($return_info))  foreach ($return_info as $key_info=>$info) {  }  $docphone = $v[phone];  $age = birthday($info['brithday']); ?>
<div class="weui_cells nomtop">
	<div class="weui_msg">
		<h2 class="page_title">
			<div class="weui_media_appmsg_thumb thumb_avatar radius100" style="background-image:url(<?php echo $v[avatar]; ?>);">
			</div>
		</h2>
		<h2 class="weui_msg_title"><?php echo $v[name]; ?></h2>
		<h2 class="text-sm color-gray"><?php echo $arraysex[$v[sex]]; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $age; ?>岁</h2>
		<div class="blank15"></div>
	</div>
</div>


<div class="weui_cells_title">专长治疗</div>

<div class="weui_cells">
    <div class="weui_cell">
      <div class="weui_cell_bd weui_cell_primary">
        <p><?php echo $info[good]; ?></p>
      </div>
    </div>
</div>

<div class="weui_cells_title">医生简介</div>


<div class="weui_panel weui_panel_access">
	<div class="weui_panel_bd">
		<div class="weui_media_box weui_media_text">
			<p class="weui_media_desc allinfo"><?php echo $info[info]; ?></p>
		</div>
	</div>
	<div class="blank10"></div>
	<div class="weui-row weui_btn_area weui-cell nomtop">
		<div class="weui-col-33">
	    	<a href="<?php echo $cats[23][url]; ?>"><img src="/assets/images/tw.png" width="100%" /></a>
		</div>
		<div class="weui-col-33">
	    	<a href="tel:<?php echo $docphone; ?>"><img src="/assets/images/dh.png" width="100%" /></a>
		</div>
		<div class="weui-col-33">
	    	<a href="javascript:" id="qywy"><img src="/assets/images/yy.png" width="100%" /></a>
		</div>
	</div>
</div>

<?php }  } else { ?>

<div class="weui_cells weui_panel_access nomtop"  style="<?php echo $display; ?>">
	<?php include $this->_include('block_nav.html'); ?>
</div>

<?php } ?>


<div class="weui_cells_title">
	 医生说
</div>

	<!--默认文章-->
	<?php $return = $this->_listdata("catid=3 status=3 num=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
	<div class="weui_panel weui_panel_access">
    	
    	<div class="weui_panel_bd">
	        <div class="weui_media_box weui_media_text" onclick="window.location.href='<?php echo $v[url]; ?>';">
	            <p class="weui_media_desc"><?php echo $v[description]; ?></p>
	            <ul class="weui_media_info">
					<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
				</ul>
	        </div>
	    </div>
	    <?php if (!empty($v[images])) { ?>
	    <div class="warp">
			<?php $p = unserialize($v[images]); ?>
			<div class="weui-row">
				<?php $n=0;  if (is_array($p[fileurl]))  foreach ($p[fileurl] as $key=>$t) {  if ($n<3) { ?>
				<div class="weui-col-33">
					<img src="<?php echo $t; ?>" width="100%" class="radius5">
				</div>
				<?php }  $n++;   } ?>
			</div>
	    </div>
	    <?php } ?>
	    <div class="weui-row weui-no-gutter col-border like_btn">
	    	<a href="javascript:;" data-id="<?php echo $v[id]; ?>" data-type="1" class="weui-col-33 text-c color-gray a_like">
	    		<img src="/assets/images/xin.png" /><!--i class="ion-ios-heart-outline"></i--> <span><?php echo $v[loves]; ?></span>
	    	</a>
	    	<a href="javascript:;" data-id="<?php echo $v[id]; ?>" data-type="0" class="weui-col-33 text-c color-gray a_like">
	    		<img src="/assets/images/ty.png" /><!--i class="ion-ios-analytics-outline"></i--> <span><?php echo $v[hates]; ?></span>
	    	</a>
	    	<a href="<?php echo $v[url]; ?>#comm" class="weui-col-33 text-c color-gray">
	    		<img src="/assets/images/pl.png" /><!--i class="ion-ios-chatbubble-outline"></i--> <?php echo $v[shares]; ?>
	    	</a>
	    </div>

    </div>
    <?php }  $allid = array();  $n = 0;  $return = $this->_listdata("table=form_share userid=$member[userid]"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $allid[]=$v['cid'];  }  $ids = implode(',',$allid);  if (count($allid) >0) {  $return = $this->_listdata("catid=3 id=$ids iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $return_s = $this->_listdata("table=form_share cid=$v[id] userid=$member[userid]  return=s"); extract($return_s); if (is_array($return_s))  foreach ($return_s as $key_s=>$s) {  $description =  strlen($s['content']) > 60 ? $s['content'] : $v[description];  } ?>
	<div class="weui_panel weui_panel_access">
		<div class="weui_panel_bd">
	        <div class="weui_media_box weui_media_text" onclick="window.location.href='<?php echo $v[url]; ?>';">
	            <!--h4 class="weui_media_title"><?php echo strcut($v[title],26); ?></h4-->
	            <p class="weui_media_desc"><?php echo $description; ?></p>
	            <ul class="weui_media_info">
					<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
					<li class="pull-right">
						<a href="javascript:;" class="a_showinfo">
							<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
							<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
						</a>
					</li>
				</ul>
	        </div>
	    </div>
	    <?php if (!empty($v[images])) { ?>
	    <div class="warp">
			<?php $p = unserialize($v[images]); ?>
			<div class="weui-row">
				<?php $n=0;  if (is_array($p[fileurl]))  foreach ($p[fileurl] as $key=>$t) {  if ($n<3) { ?>
				<div class="weui-col-33">
					<img src="<?php echo $t; ?>" width="100%" class="radius5">
				</div>
				<?php }  $n++;   } ?>
			</div>
	    </div>
	    <?php } ?>
	    <div class="weui-row weui-no-gutter col-border like_btn">
	    	<a href="javascript:;" data-id="<?php echo $v[id]; ?>" data-type="1" class="weui-col-33 text-c color-gray a_like">
	    		<img src="/assets/images/xin.png" /><!--i class="ion-ios-heart-outline"></i--> <span><?php echo $v[loves]; ?></span>
	    	</a>
	    	<a href="javascript:;" data-id="<?php echo $v[id]; ?>" data-type="0" class="weui-col-33 text-c color-gray a_like">
	    		<img src="/assets/images/ty.png" /><!--i class="ion-ios-analytics-outline"></i--> <span><?php echo $v[hates]; ?></span>
	    	</a>
	    	<a href="<?php echo $v[url]; ?>#comm" class="weui-col-33 text-c color-gray">
	    		<img src="/assets/images/pl.png" /><!--i class="ion-ios-chatbubble-outline"></i--> <?php echo $v[shares]; ?>
	    	</a>
	    </div>
    </div>
		<?php }  }  include $this->_include('footer.html'); ?>