<?php include $this->_include('header.html'); ?>

<div class="top_tabbar">
    <div class="weui-row weui-no-gutter">
        <a href="/member/?c=content&a=qrcode" class="weui-col-50">扫码添加</a>
        <a href="/member/?c=content&a=family" class="weui-col-50 open">手动添加</a>
    </div>
</div>

<div class="weui_panel weui_panel_access">
	<div class="weui_panel_bd">
	    <?php $return = $this->_listdata("catid=25 userid=$member[id] familyid=0 iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $age = !empty($v['birthday']) ?  birthday($v['birthday']) : $v['age'];  $thumb = !empty($v['thumb']) ? $v['thumb'] : "/assets/images/avatar.png";  if ($v['uid'] > 0) { ?>
	    	<a name="user<?php echo $v[uid]; ?>"></a>
	    	<?php $return_u = $this->_listdata("table=member id=$v[uid]  return=u"); extract($return_u); if (is_array($return_u))  foreach ($return_u as $key_u=>$u) {  $thumb = !empty($u['avatar']) ? $u['avatar'] : "/assets/images/avatar.png";  }  } ?>
	    <div class="weui_media_box weui_media_appmsg">
	        <a class="weui_media_hd" href="<?php echo $v[url]; ?>">
	           <div class="weui_media_appmsg_thumb thumb_avatar radius100" style="background-image:url(<?php echo $thumb; ?>);"></div>
	        </a>
	        <div class="weui_media_bd">
				<h4 class="weui_media_title">
					<?php echo $v[title]; ?>&nbsp;&nbsp;
					<span class="text-sm color-gray"><?php echo $sex[$v[sex]]; ?>&nbsp;<?php echo $age; ?>岁</span>
				</h4>
	            <p class="weui_media_desc">身份证：<?php echo $v[cardid]; ?></p>
	        </div>
	        <a href="/member/index.php?c=content&a=add&catid=25&familyid=<?php echo $v[id]; ?>" class="weui_cell_ft">
	        	<span class="weui_btn weui_btn_mini weui_btn_primary">添加成员</span>
	        </a>
	    </div>
	    <?php } ?>
	</div>
</div>
<div class="weui_btn_area">
	<a href="/member/index.php?c=content&a=add&catid=25" class="weui_btn weui_btn_primary">添加新户主</a>
</div>

<?php include $this->_include('footer.html'); ?>