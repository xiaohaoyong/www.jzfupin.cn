<?php include $this->_include('header.html');  $display="";  $copen='display:none';  if ($_GET['header']) {  $display='display:none';  $copen="";  } ?>
<script type="text/javascript">
	$(function(){
		<?php if (isset($_GET['tab'])) { ?>
			var tab_index = <?php echo $_GET['tab']; ?>;
		<?php } else { ?>
			var tab_index = 1;
		<?php } ?>
		if(tab_index > 0){ 
			$('#user_nav').find('a.weui-col-25').eq(tab_index*1-1).addClass('open');
			$('#list_info').find('div.weui_panel_bd').eq(tab_index*1-1).show();

			$('#header_name').text($('#user_nav').find('a.weui-col-25').eq(tab_index*1-1).text());
		}

		$('.toushu').click(function(){
			viewModel.toushu($(this).attr('data-id'));
		});
	});
</script>
<?php $age = empty($age) ?  birthday($birthday) : $age;  if ($uid > 0) {  $return = $this->_listdata("table=member id=$uid num=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $avatar = !empty($v['avatar']) ? $v['avatar'] : "/assets/images/avatar.png";  $age_old = !empty($v['age'])?  birthday($birthday) : $v['age'];  $phone = $v[phone];  }  }  $thumb = !empty($thumb) ? $thumb : $avatar;  $thumb = !empty($thumb) ? $thumb : "/assets/images/avatar.png"; ?>
<div class="weui_cells nomtop" style="<?php echo $display; ?>">
	<div class="weui_msg">
		<h2 class="page_title">
			<div class="weui_media_appmsg_thumb thumb_avatar radius100" style="background-image:url(<?php echo $thumb; ?>);"></div>
		</h2>
		<h2 class="weui_msg_title"><?php echo $title; ?></h2>
		<h2 class="text-sm color-gray"><?php echo $arraysex[$sex]; ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $age; ?>岁</h2>
		<div class="weui_btn_area nomtop">
			<!--a href="javascript:;" class="weui_btn weui_btn_mini weui_btn_default">标签</a-->
		</div>
		<div class="blank15"></div>
	</div>
	<div class="weui_cell text-sm">
        <div class="weui_cell_bd weui_cell_primary">身份证号</div>
        <div class="weui_cell_bd">
           <?php echo $cardid; ?>
        </div>
    </div>
    <div class="weui_cell text-sm">
        <div class="weui_cell_bd weui_cell_primary">联系方式</div>
        <div class="weui_cell_bd">
           <?php echo $phone; ?>
        </div>
    </div>
    <div class="weui_cell text-sm">
        <div class="weui_cell_bd weui_cell_primary">户主</div>
        <div class="weui_cell_bd">
           	<?php if ($familyid > 0) {  $return = $this->_listdata("catid=$catid id=$familyid"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  echo $v[title];  }  } else {  echo $title;  } ?>
        </div>
    </div>
</div>
<div class="weui_cells weui-row weui-no-gutter col-border line2 panel_nav" id="user_nav" style="<?php echo $display; ?>">
    <a href="/?id=<?php echo $id; ?>&tab=1" class="weui-col-25">体检结果</a>
  	<a href="/?id=<?php echo $id; ?>&tab=2" class="weui-col-25">健康指标</a>
  	<a href="/?id=<?php echo $id; ?>&tab=3" class="weui-col-25">问诊列表</a>
  	<a href="/?id=<?php echo $id; ?>&tab=4" class="weui-col-25">预警列表</a> 
</div>
<div class="weui_cells_title" id="header_name" style="<?php echo $copen; ?>"></div>
<div id="list_info">
	<div class="weui_cells weui_panel_bd nomtop" style="display:none">
		<?php if ($member['id'] == $userid) { ?>
		<div class="weui_btn_area">
		    <a href="/index.php?a=form&modelid=20&cid=<?php echo $id; ?>" class="weui_btn weui_btn_primary">添加体检报告</a>
		</div>
		<?php }  $return = $this->_listdata("table=form_report order=id_desc cid=$id"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
		<div class="weui_media_box weui_media_text">
			<div class="weui_media_bd">
				<p class="weui_media_desc"><?php echo $v[content]; ?></p>
				<?php if (!empty($v[files])) {  $p = unserialize($v[files]); ?>
			      <div class="weui-row files_list" style="display:none">
			        <?php if (is_array($p[fileurl]))  foreach ($p[fileurl] as $key=>$t) { ?>
			        <div class="weui-col-33">
			          <img src="<?php echo $t; ?>" width="100%" class="radius5">
			        </div>
			        <?php  } ?>
			      </div>
			    <?php } ?>
				<ul class="weui_media_info">
					<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
					<?php if ($member[id] == $uid) { ?><li class="weui_media_info_meta weui_media_info_meta_extra"><a href="javascript:;" class="toushu" data-id="<?php echo $v[id]; ?>">投诉</a></li><?php } ?>
					<li class="pull-right">
						<a href="javascript:;" class="a_showinfo">
							<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
							<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
						</a>
					</li>
				</ul>	
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="weui_cells weui_panel_bd nomtop" style="display:none">
		<?php $return = $this->_listdata("table=form_warning order=id_desc cid=$id num=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
		<div class="weui_media_box weui_media_text">
			<div class="weui_media_bd">
				<p class="weui_media_desc">
					<?php if ($v[ssy] < 91 || $v[ssy] > 141 || $v[szy] < 61 || $v[szy] > 91) { ?>
					血压：<span style="color:red"><?php echo $v[ssy]; ?>/<?php echo $v[szy]; ?>mmHg </span>
					<?php } else { ?>
					血压：<?php echo $v[ssy]; ?>/<?php echo $v[szy]; ?>mmHg 
					<?php } ?>
					<span class="pull-right">脉搏：<?php echo $v[BMI]; ?>次/分</span> <br />
					<?php if ($v[xuetang] < 4 || $v[xuetang] > 6.2) { ?>
					空腹血糖：<span style="color:red"><?php echo $v[xuetang]; ?>mmol/L  </span>
					<?php } else { ?>
					空腹血糖：<?php echo $v[xuetang]; ?>mmol/L 
					<?php } ?>
					<span class="pull-right">
						<?php if ($v[chxt] > 11.2) { ?>
						餐后血糖：<?php echo $v[chxt]; ?>mmol/L
						<?php } else { ?>
						餐后血糖：<?php echo $v[chxt]; ?>mmol/L 
						<?php } ?>
					</span> <br />
				</p>
				<?php if (!empty($v[hwpic])) {  $p = unserialize($v[hwpic]); ?>
			      <div class="weui-row files_list" style="display:none">
			      	<hr />
			      	<div class="weui-col-100 text-sm">红外诊断图:<?php echo $v[hwinfo]; ?></div>
			        <?php if (is_array($p[fileurl]))  foreach ($p[fileurl] as $key=>$t) { ?>
			        <div class="weui-col-33">
			          <img src="<?php echo $t; ?>" width="100%" class="radius5">
			        </div>
			        <?php  } ?>
			      </div>
			    <?php }  if (!empty($v[xdtpic])) {  $xdt = unserialize($v[xdtpic]); ?>
			      <div class="weui-row files_list" style="display:none">
			      	<hr />
			      	<div class="weui-col-100 text-sm">红外诊断图:<?php echo $v[xdtinfo]; ?></div>
			        <?php if (is_array($xdt[fileurl]))  foreach ($xdt[fileurl] as $key=>$t) { ?>
			        <div class="weui-col-33">
			          <img src="<?php echo $t; ?>" width="100%" class="radius5">
			        </div>
			        <?php  } ?>
			      </div>
			    <?php } ?>
				<ul class="weui_media_info">
					<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
					<?php if ($member[id] == $uid) { ?><li class="weui_media_info_meta weui_media_info_meta_extra"><a href="javascript:;" class="toushu" data-id="<?php echo $v[id]; ?>">投诉</a></li><?php } ?>
					<li class="pull-right">
						<a href="javascript:;" class="a_showinfo">
							<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
							<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
						</a>
					</li>
				</ul>	
			</div>
		</div>
		<?php } ?>
	</div>
	<div class="weui_cells weui_panel_bd nomtop" style="display:none">
		<?php if ($uid > 0) {  $return = $this->_listdata("catid=4 userid=$uid order=id_desc status=0,1,2 iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
		    <div class="weui_media_box weui_media_text">
				<div class="weui_media_bd" onclick="window.location.href='<?php echo $v[url]; ?>';">
			      <!--h4 class="weui_media_title">
			        <span class="pull-right color-blue text-sm"><?php echo $cats[$v[catid]][catname]; ?></span>
			        <?php if ($v['status']==0) { ?><font color="#FF0000">[未审]</font><?php }  echo $v[title]; ?>
			      </h4-->
			      <p class="weui_media_desc"><?php echo $v[description]; ?></p>
			      <?php if (!empty($v[files])) {  $p = unserialize($v[files]); ?>
			      <div class="weui-row files_list" style="display:none">
			        <?php if (is_array($p[fileurl]))  foreach ($p[fileurl] as $key=>$t) { ?>
			        <div class="weui-col-33">
			          <img src="<?php echo $t; ?>" width="100%" class="radius5">
			        </div>
			        <?php  } ?>
			      </div>
			      <?php } ?>
			      <ul class="weui_media_info">
						<li class="weui_media_info_meta color-blue"><?php echo $cats[$v[catid]][catname]; ?></li>
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
	    <?php }  } ?>
	</div>
	<div class="weui_cells weui_panel_bd nomtop" style="display:none">
		<?php if ($member['id'] == $userid) { ?>
		<div class="weui_btn_area">
		    <a href="/index.php?a=form&modelid=23&cid=<?php echo $id; ?>" class="weui_btn weui_btn_primary">新增预警</a>
		</div>
		<?php }  $return = $this->_listdata("table=form_warning order=id_desc cid=$id"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
		<div class="weui_media_box weui_media_text"> 
			<div class="weui_media_bd">
				<p class="weui_media_desc">
					血压：<?php echo $v[ssy]; ?>/<?php echo $v[szy]; ?>mmHg <span class="pull-right">身高：<?php echo $v[shengao]; ?>cm</span><br />
					血糖：<?php echo $v[xuetang]; ?>mmol/L <span class="pull-right">体重：<?php echo $v[tizhong]; ?>kg</span> <br />
					体温：<?php echo $v[tiwen]; ?>℃  <span class="pull-right">BMI：<?php echo $v[BMI]; ?>kg/m²</span><br />
					呼吸：<?php echo $v[tiwen]; ?>次/分 <span class="pull-right">脉搏：<?php echo $v[BMI]; ?>次/分</span>
				</p>
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
		<?php } ?>
	</div>
</div>
<?php include $this->_include('footer.html'); ?>