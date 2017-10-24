<?php include $this->_include('header.html'); ?>

<div class="weui_cells weui_panel_bd nomtop">
    <div class="weui_media_box weui_media_text">
		<div class="weui_media_bd">
	      <h4 class="weui_media_title">
	        <span class="pull-right color-blue text-sm"><?php echo $cats[$catid][catname]; ?></span>
	        <?php echo $title; ?>
	      </h4>
	      <p class="weui_media_desc allinfo"><?php echo $content; ?></p>
	      <?php if (!empty($files)) {  $p = $files; ?>
	      <div class="weui-row files_list">
	        <?php $n=0;  if (is_array($p[fileurl]))  foreach ($p[fileurl] as $key=>$t) {  if ($n < 3) { ?>
	        <div class="weui-col-33">
	          <img src="<?php echo $t; ?>" width="100%" class="radius5">
	        </div>
	        <?php }  $n++;   } ?>
	      </div>
	      <?php } ?>
	      	<ul class="weui_media_info">
				<li class="weui_media_info_meta"><?php echo date('Y-m-d',$time); ?></li>
				<!--li class="pull-right">
					<a href="javascript:;" class="a_showinfo">
						<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
						<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
					</a>
				</li-->
		 	</ul>
	    </div>  
    </div>
</div>

<div class="weui_cells weui_panel_bd">
<?php $return = $this->_listdata("table=form_answer cid=$id order=id_desc num=10"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $ext = unserialize($v['xywyhd']);  $dtitle = $ext['dtitle'] ? $ext['dtitle'] : "";  $dicon = $ext['dicon'] ? $ext['dicon'] : "/assets/images/avatar.png"; ?>
    <div class="weui_media_box weui_media_text">
		<div class="weui_media_bd">
		  <div class="weui_media_appmsg_thumb thumb_avatar radius100  pull-right" style="background-image:url(<?php echo $dicon; ?>);width:24px;height:24px"></div>
	      <h4 class="weui_media_title">
			<?php echo $v['name']; ?> <span class="text-sm color-gray"><?php echo $dtitle; ?></span> 答：
	      </h4>
	      <div class="weui_media_desc allinfo"><?php echo $v[content]; ?></div>
	      	<ul class="weui_media_info">
				<li class="weui_media_info_meta"><?php echo date('Y-m-d h:i',$v['time']); ?></li>
				<!--li class="pull-right">
					<a href="javascript:;" class="a_showinfo">
						<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
						<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
					</a>
				</li-->
	 		</ul>
	    </div>  
    </div>
<?php } ?>
</div>


<?php if ($member['modelid'] == 7 && $catid == 6) { ?>
<a name="answer"></a>
<form action="<?php echo url('index/form', array('modelid'=>14, 'cid'=>$id)); ?>" method="post">
	<div class="weui_cells_title">我要回答</div>
	<div class="weui_cells weui_cells_form">
		<input type="hidden" class="button" value="我要回答" name="submit">
		<div class="weui_cell">
			<div class="weui_cell_bd weui_cell_primary">
				<textarea class="weui_textarea" name="data[content]" placeholder="请输入内容" rows="6"></textarea>
			</div>
		</div>
	</div>
	<div class="weui_btn_area">
		<button class="weui_btn weui_btn_primary">提交回答</button>
	</div>
</form>
<?php }  include $this->_include('footer.html'); ?>