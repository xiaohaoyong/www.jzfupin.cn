<?php include $this->_include('header.html');  $origin=!empty($origin)? $origin : $site_name; ?>
<h2 class="show_title"><?php echo $title; ?></h2>
<div class="weui_panel weui_article nomtop">
	<div class="weui_panel_bd">
		<div class="weui_media_box weui_media_text">
			<ul class="weui_media_info" style="margin-top:-15px;margin-bottom:10px">
				<li class="weui_media_info_meta"><?php echo date('Y-m-d',$time); ?></li>
				<li class="weui_media_info_meta weui_media_info_meta_extra">文章来源：<?php echo $origin; ?></li>
			</ul>
			<section>
                <div><?php echo $content; ?></div>
				<?php if (!empty($images) && 1==2) { ?>
				<div class="weui-row">
					<?php if (is_array($images[fileurl]))  foreach ($images[fileurl] as $key=>$t) { ?>
					<div class="weui-col-33">
						<img src="<?php echo $t; ?>" width="100%" class="radius5">
					</div>
					<?php  } ?>
				</div>
				<?php } ?>
            </section>
			<ul class="weui_media_info">
				<li class="weui_media_info_meta"><a href="javascript:;" data-id="<?php echo $id; ?>" data-type="1" class="a_like"><i class="ion-android-favorite-outline"></i> 赞：<span><?php echo $loves; ?></span></a></li>
				<li class="weui_media_info_meta"><a href="javascript:;" data-id="<?php echo $id; ?>" data-type="0" class="a_like"> <i class="ion-thumbsdown"></i> 踩：<span><?php echo $hates; ?></span></a></li>
				<li class="weui_media_info_meta weui_media_info_meta_extra"> 评论：<?php echo $shares; ?></li>
			</ul>
		</div>
	</div>
</div>
<div class="weui_panel weui_panel_access">
	<div class="weui_panel_bd">
	<?php $return = $this->_listdata("table=form_share cid=$id"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
		<!--div class="weui_panel_hd"><span class="pull-right"><?php echo date('Y-m-d H:i:s',$v[time]); ?></span><?php echo $v[name]; ?></div-->
		<div class="weui_media_box weui_media_text">
			<p class="weui_media_desc"><?php echo $v[content]; ?></p>
			<ul class="weui_media_info">
				<li class="weui_media_info_meta"><?php echo $v[name]; ?></li>
				<li class="weui_media_info_meta weui_media_info_meta_extra"><?php echo date('Y-m-d',$v['time']); ?></li>
				<li class="pull-right">
					<a href="javascript:;" class="a_showinfo">
						<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
						<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
					</a>
				</li>
			</ul>	
		</div>
	<?php } ?>
	</div>
</div>
<a name="comm"></a>
<form action="<?php echo url('index/form', array('modelid'=>16, 'cid'=>$id)); ?>" method="post">
	<?php if ($member['modelid'] == 7 && $catid == 3) { ?>
		<div class="weui_cells_title">温馨提示：您的分享评论最终会显示在居民端的医生说中哦</div>
	<?php } else { ?>
		<div class="weui_cells_title">您的评论</div>
	<?php } ?>
	<div class="weui_cells weui_cells_form">
		<input type="hidden" class="button" value="转发分享" name="submit">
		<div class="weui_cell">
			<div class="weui_cell_bd weui_cell_primary">
				<textarea class="weui_textarea" name="data[content]" placeholder="请输入内容" rows="6"></textarea>
			</div>
		</div>
	</div>
	<div class="weui_btn_area">
		<button class="weui_btn weui_btn_primary">提交</button>
	</div>
</form>


<form action="<?php echo url('index/form', array('modelid'=>17, 'cid'=>$id)); ?>" id="like_form" method="post" style="display:none">
	<input type="hidden" name="data[type]" value="1" />
	<input type="submit" class="button" value="赞" name="submit"> <?php echo $loves; ?>
</form>

<form action="<?php echo url('index/form', array('modelid'=>17, 'cid'=>$id)); ?>" id="hate_form" method="post" style="display:none">
	<input type="hidden" name="data[type]" value="0" />
	<input type="submit" class="button" value="踩" name="submit"><?php echo $hates; ?>
</form>

<?php include $this->_include('footer.html'); ?>