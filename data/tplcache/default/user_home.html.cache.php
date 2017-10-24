<?php include $this->_include('header.html'); ?>
<script type="text/javascript">
$(function(){
	viewModel.changTarBar(0);
	$(".swiper-container").swiper({
        loop: true,
        autoplay: 3000
      });
})
</script>
<div class="userindex">
	<div class="weui_cells_title">我的家庭医生</div>
<div class="weui_panel weui_panel_access">
    <div class="weui_panel_bd weui_cells_access">
      	<?php $return = $this->_listdata("table=member id=$member[userid] num=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $return_info = $this->_listdata("table=member_doctor id=$v[id] num=1  return=info"); extract($return_info); if (is_array($return_info))  foreach ($return_info as $key_info=>$info) {  } ?>
      	<a href="/?c=api&a=quan&what=1" onclick="window.location.href='/?c=api&a=quan';" class="weui_media_box weui_media_appmsg">
          <div class="weui_media_hd">
              <div class="weui_media_appmsg_thumb thumb_avatar radius100" style="background-image:url(<?php echo $v[avatar]; ?>);"></div>
          </div>
          <div class="weui_media_bd">
              <h4 class="weui_media_title"><?php echo $v[name]; ?>&nbsp;医生</h4>
              <p class="weui_media_desc">专长治疗：<?php echo $info[good]; ?></p>
          </div>
      	</a>
		<div class="weui_media_box weui_media_text notopbr noptop">
	      <p class="weui_media_desc">医生简介：<?php echo $info[info]; ?></p>
		</div>
		<?php } ?>
	</div>
</div>

		<?php $return = $this->_category("parentid=$catid num=2");  if (is_array($return))  foreach ($return as $key=>$v) { $allchildids = @explode(',', $v['allchildids']);    $current = in_array($catid, $allchildids);?>
<div class="weui_panel weui_panel_access">
	<div class="weui_panel_bd weui_cells_access">
		<a href="<?php echo $v[url]; ?>" class="weui_media_box weui_media_appmsg">
		  <div class="weui_media_hd">
		      <img class="weui_media_appmsg_thumb radius100" src="<?php echo $v[image]; ?>" alt="">
		  </div>
		  <div class="weui_media_bd">
		      <h4 class="weui_media_title"><?php echo $v[catname]; ?></h4>
		       <p class="weui_media_desc"><?php echo $v[seo_description]; ?></p>
		  </div>
		  <span class="weui_cell_ft"></span>
		</a>
	</div>
</div>
		<?php } ?>
<div class="weui_panel weui_panel_access">
	<div class="weui_panel_bd weui_cells_access">
		<div class="warp weui_media_box">
	        <div class="weui-row swiper-container">
		      <div class="weui-col-100 swiper-wrapper">
		      	<?php $return = $this->_listdata("table=diy_ad type=居民首页"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?><a href="<?php echo $v[lianjiedizhi]; ?>" class="swiper-slide"><img src="<?php echo $v[pic]; ?>" width="100%" class="radius5" /></a><?php } ?>
		      </div>
		      <!-- If we need pagination -->
      			<div class="swiper-pagination"></div>
		    </div>
	    </div>
	</div>
</div>
	<?php if ($member[userid] >0) { ?>
	<div class="weui_cells_title" onclick="window.location.href='/?c=api&a=quan';">
		<span class="pull-right">更多></span> 医生说
	</div>
	<?php } else { ?>
	<div class="weui_cells_title">
		医生说
	</div>
	<?php } ?>
    <div class="weui_panel weui_panel_access">
    	
	    	<!--默认文章-->
	    	<?php $return = $this->_listdata("catid=3 status=3 num=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
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
			<?php }  if ($member[userid] >0) {  $allid = array();  $n = 0;  $return = $this->_listdata("table=form_share userid=$member[userid]"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $allid[]=$v['cid'];  }  $ids = implode(',',$allid);  if (count($allid) >0) {  $return = $this->_listdata("catid=3 id=$ids iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $return_s = $this->_listdata("table=form_share cid=$v[id] userid=$member[userid]  return=s"); extract($return_s); if (is_array($return_s))  foreach ($return_s as $key_s=>$s) {  $description =  strlen($s['content']) > 60 ? $s['content'] : $v[description];  } ?>
	    	<div class="weui_panel_bd">
		        <div class="weui_media_box weui_media_text" onclick="window.location.href='<?php echo $v[url]; ?>';">
		            <!--h4 class="weui_media_title"><?php echo strcut($v[title],26); ?></h4-->
		            <p class="weui_media_desc"><?php echo $description; ?></p>
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
			<?php }  }  } ?>
	</div>
	
</div>
<?php include $this->_include('footer.html'); ?>