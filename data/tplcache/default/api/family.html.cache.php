<?php include $this->_include('header.html'); ?>
<div class="weui_cells_title">家庭成员</div>
<?php $return = $this->_listdata("catid=$catid id=$familyid iaeweb=1 num=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $avatar="";  $age="";  $thumb="";  $age = !empty($v['birthday']) ?  birthday($v['birthday']) : $v['age'];  if ($v['uid'] > 0) { ?>
	<a name="user<?php echo $v[uid]; ?>"></a>
	<?php $return_u = $this->_listdata("table=member id=$v[uid]  return=u"); extract($return_u); if (is_array($return_u))  foreach ($return_u as $key_u=>$u) {  $avatar = !empty($u['avatar']) ? $u['avatar'] : "/assets/images/avatar.png";  }  }  $thumb = !empty($v['thumb']) ? $v['thumb'] : $avatar;  $thumb = !empty($thumb) ? $thumb : "/assets/images/avatar.png"; ?>
<div class="weui_cells weui_panel_access nomtop">
	<div class="weui_panel_bd">
        <div href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
	        <div class="weui_media_hd">
	           	<div class="weui_media_appmsg_thumb thumb_avatar radius100" style="background-image:url(<?php echo $thumb; ?>);"></div>
	        </div>
          <div class="weui_media_bd">
            <h4 class="weui_media_title">
            	<?php echo $v[title]; ?>&nbsp;&nbsp;
            	<span class="text-sm color-gray"><?php echo $sex[$v[sex]]; ?>&nbsp;户主关系：户主本人</span>
            </h4>
            <!--p class="weui_media_desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p-->
          </div>
        </div>
      </div>
</div>
<?php }  $return = $this->_listdata("catid=$catid familyid=$familyid iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $avatar="";  $age="";  $thumb="";  $age = !empty($v['birthday']) ?  birthday($v['birthday']) : $v['age'];  if ($v['uid'] > 0) { ?>
	<a name="user<?php echo $v[uid]; ?>"></a>
	<?php $return_u = $this->_listdata("table=member id=$v[uid]  return=u"); extract($return_u); if (is_array($return_u))  foreach ($return_u as $key_u=>$u) {  $avatar = !empty($u['avatar']) ? $u['avatar'] : "/assets/images/avatar.png";  }  }  $thumb = !empty($v['thumb']) ? $v['thumb'] : $avatar;  $thumb = !empty($thumb) ? $thumb : "/assets/images/avatar.png"; ?>
<div class="weui_cells weui_panel_access nomtop">
	<div class="weui_panel_bd">
        <div href="javascript:void(0);" class="weui_media_box weui_media_appmsg">
	        <div class="weui_media_hd">
	           	<div class="weui_media_appmsg_thumb thumb_avatar radius100" style="background-image:url(<?php echo $thumb; ?>);"></div>
	        </div>
          <div class="weui_media_bd">
            <h4 class="weui_media_title">
            	<?php echo $v[title]; ?>&nbsp;&nbsp;
            	<span class="text-sm color-gray"><?php echo $sex[$v[sex]]; ?>&nbsp;户主关系：<?php echo $v[hzgx]; ?></span>
            </h4>
            <!--p class="weui_media_desc">由各种物质组成的巨型球状天体，叫做星球。星球有一定的形状，有自己的运行轨道。</p-->
          </div>
        </div>
      </div>
</div>
<?php }  include $this->_include('footer.html'); ?>