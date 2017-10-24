<?php include $this->_include('header.html'); ?>
<div class="weui_cells_title">"<font style="color:#ff0000"><?php echo $kw; ?></font>"的 搜索结果 共 <?php echo $num; ?> 条</div>
<?php $n=0;  if (is_array($data))  foreach ($data as $t) {  $n++;  $return = $this->_listdata("catid=$t[catid] id=$t[id] iaeweb=1 num=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
<div class="weui_cells weui_panel_access<?php if ($n==1) { ?> nomtop<?php } ?>">
	<div class="weui_panel_bd">
		<div class="weui_media_box weui_media_text mouse_a" onclick="window.location.href='<?php echo $v[url]; ?>';">
			<h4 class="weui_media_title">
				<span class="pull-right color-blue text-sm"><?php echo $cats[$v[catid]][catname]; ?></span>
				<?php echo strcut($v[title],26); ?>
			</h4>
			<p class="weui_media_desc"><?php echo $v[description]; ?></p>
			<ul class="weui_media_info">
				<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
				<!--li class="pull-right"><a href="<?php echo $v[url]; ?>">展开 <i class="ion-ios-arrow-down"></i></a></li-->
			</ul>
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
</div>
<?php }   }  echo $pagelist;  include $this->_include('footer.html'); ?>