<?php include $this->_include('header.html'); ?>
<script type="text/javascript">
$(function(){
	viewModel.changTarBar(0);
})
</script>
        <?php $return = $this->_category("parentid=$catid num=6");  if (is_array($return))  foreach ($return as $key=>$v) { $allchildids = @explode(',', $v['allchildids']);    $current = in_array($catid, $allchildids);?>
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
	        <div class="weui-row">
		      <?php $return = $this->_listdata("table=diy_ad type=医生首页 num=2"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
              <div class="weui-col-50">
                <a href="<?php echo $v[lianjiedizhi]; ?>"><img src="<?php echo $v[pic]; ?>" width="100%" class="radius5" /></a>
		      </div>
              <?php } ?>
		    </div>
	    </div>
    </div>
</div>
<?php $return = $this->_category("catid=1,3 num=2");  if (is_array($return))  foreach ($return as $key=>$v) { $allchildids = @explode(',', $v['allchildids']);    $current = in_array($catid, $allchildids);?>
<div class="weui_cells_title" onclick="window.location.href='<?php echo $cats[$v[catid]][url]; ?>';">
    <span class="pull-right">更多></span><?php echo $cats[$v[catid]][catname]; ?>
</div>
<div class="weui_panel weui_panel_access">
<?php $return = $this->_listdata("catid=$v[catid] num=2 iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
    <div class="weui_panel_bd">
        <div class="weui_media_box weui_media_text" onclick="window.location.href='<?php echo $v[url]; ?>';">
            <h4 class="weui_media_title"><span class="weui_media_info pull-right" style="margin-top:0;line-height:32px;padding:0"><?php echo date('Y-m-d',$v['time']); ?></span><?php echo strcut($v[title],26); ?></h4>
            <p class="weui_media_desc"><?php echo $v[description]; ?></p>
            <!--ul class="weui_media_info">
				<li class="weui_media_info_meta">文字来源</li>
				<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
				<li class="weui_media_info_meta weui_media_info_meta_extra">其它信息</li>
				<li class="pull-right"><a href="<?php echo $cats[$v[catid]][url]; ?>">展开 <i class="ion-ios-arrow-down"></i></a></li>
			</ul-->
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
<?php } ?>
</div>
<?php }  include $this->_include('footer.html'); ?>