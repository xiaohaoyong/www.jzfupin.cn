<?php include $this->_include('header.html'); ?>
<script type="text/javascript">
$(function(){
	viewModel.selectUi("#sex","居民性别",[
			{
		      title: "不限",
		      value: "0",
		    },
		    {
		      title: "男",
		      value: "1",
		    },
		    {
		      title: "女",
		      value: "2",
		    }
		]);
	viewModel.selectUi("#pool","是否贫困",[
			{
		      title: "不限",
		      value: "",
		    },
		    {
		      title: "是",
		      value: "1",
		    },
		    {
		      title: "否",
		      value: "0",
		    }
		]);
	viewModel.selectUi("#condition","健康情况",["健康","亚健康", "疾病"]);
	$("#tj").swiper({
	    /*freeMode : true,*/
	    paginationClickable: true,
        slidesPerView: 4,

	  	// slidesPerView: 4,
    //     centeredSlides: true,
    //     paginationClickable: true,
        spaceBetween: 0
	  });
})
</script>
<style>
.swiper-wrapper.text-sm{
	height:36px;
	line-height: 36px;
}
.swiper-wrapper .weui-col-25.swiper-slide {
    width: 25%;
    white-space:nowrap;  
    text-align:center;
}
</style>
<div class="user_list">
		<?php $all = 0;  $poor = 0;  $return = $this->_listdata("catid=$catid userid=$member[id] iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $all++;  if ($v[poor]) {  $poor++;  }  } ?>
		<div class="swiper-container weui_panel weui_panel_access" id="tj">
			<div class="swiper-wrapper text-sm">
				<div class="weui-col-25 swiper-slide">总人数:<?php echo $all; ?></div>
				<div class="weui-col-25 swiper-slide">贫困人数:<?php echo $poor; ?></div>
				<div class="weui-col-25 swiper-slide">平均人数:0</div>
				<div class="weui-col-25 swiper-slide">贫困平均人数:0</div>
			</div>
		</div>


	<form action="index.php" method="get">
		<div class="bd">
		    <div class="weui_search_bar" id="search_bar">
		        <div class="weui_search_outer">
	          		<div class="weui_search_inner">
						<input type="hidden" value="index" name="c">
						<input type="hidden" value="searchjum" name="a">
						<input type="hidden" value="<?php echo $modelid; ?>" name="modelid">
		                <i class="weui_icon_search"></i>
		                <input type="search" name="kw" class="weui_search_input" id="search_input" placeholder="请输入您要查询的人姓名" required="">
		                <a href="javascript:" class="weui_icon_clear" id="search_clear"></a>
		            </div>
		            <!--label for="search_input" class="weui_search_text" id="search_text" style="text-align:left;font-size:14px;">
		                <i class="weui_icon_search" style="margin-left: 10px;padding: 4px 0;"></i> <span>请输入您要查询的人姓名</span>
		            </label-->
		        </div>
		        <a href="javascript:" class="weui_search_cancel" id="search_cancel">取消</a>
		        <a href="/member/index.php?c=content&a=family" class="weui_btn weui_btn_mini weui_btn_plain_primary add_user"> </a>
		    </div>
		</div>

		<div class="weui-row weui-no-gutter col-border">
			<div class="weui-col-33 color-gray">
				<div class="weui_cell">
			        <div class="weui_cell_bd weui_cell_primary">
			          <input class="weui_input text-c" id="sex" name="sex" type="text" readonly="" placeholder="居民性别">
			        </div>
			        <i class="ion-ios-arrow-down"></i>
			    </div>
			</div>
			<div class="weui-col-33 color-gray">
				<div class="weui_cell">
			        <div class="weui_cell_bd weui_cell_primary">
			          <input class="weui_input text-c" id="pool" name="pool" type="text" readonly="" placeholder="是否贫困">
			        </div>
			        <i class="ion-ios-arrow-down"></i>
			    </div>
			</div>
			<div class="weui-col-33 color-gray">
				<div class="weui_cell">
			        <div class="weui_cell_bd weui_cell_primary">
			          <input class="weui_input text-c" id="condition" name="jkzk"  type="text" readonly="" placeholder="健康情况">
			        </div>
			        <i class="ion-ios-arrow-down"></i>
			    </div>
			</div>
		</div>
		<button style="display:none">0</button>
	<form>

		<div class="weui_panel weui_panel_access">
	        <div class="weui_panel_bd">
	            <?php $return = $this->_listdata("catid=$catid userid=$member[id] iaeweb=1 page=$page"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  $avatar="";  $age="";  $thumb="";  $age = !empty($v['birthday']) ?  birthday($v['birthday']) : $v['age'];  if ($v['uid'] > 0) { ?>
	            	<a name="user<?php echo $v[uid]; ?>"></a>
	            	<?php $return_u = $this->_listdata("table=member id=$v[uid]  return=u"); extract($return_u); if (is_array($return_u))  foreach ($return_u as $key_u=>$u) {  $avatar = !empty($u['avatar']) ? $u['avatar'] : "/assets/images/avatar.png";  }  }  $thumb = !empty($v['thumb']) ? $v['thumb'] : $avatar;  $thumb = !empty($thumb) ? $thumb : "/assets/images/avatar.png"; ?>



	            <div class="weui_media_box weui_media_appmsg">
	                <a class="weui_media_hd" href="<?php echo $v[url]; ?>">
	                   <div class="weui_media_appmsg_thumb thumb_avatar radius100" style="background-image:url(<?php echo $thumb; ?>);"></div>
	                </a>
	                <div class="weui_media_bd" style="cursor:pointer" onclick="window.location.href='<?php echo $v[url]; ?>';">
						<h4 class="weui_media_title">
							<?php echo $v[title]; ?>&nbsp;&nbsp;
							<span class="text-sm color-gray"><?php echo $sex[$v[sex]]; ?>&nbsp;<?php echo $age; ?>岁</span>
							<?php if ($v[jkzk] == "疾病") { ?><span class="disease">慢</span><?php } ?>
						</h4>
    					<!--p class="weui_media_desc">随诊疾病：<span class="disease">糖尿病</span></p-->
						<p class="weui_media_desc">签约时间：<?php echo date('Y-m-d',$v['time']); ?></p>
						<!--p class="weui_media_desc">就诊时间：2016-3-9</p-->
	                </div>
	                <?php if ($v['telme']) { ?> <a href="javascript:;" data-cid="<?php echo $v[id]; ?>" data-phone="<?php echo $v['phone']; ?>" class="weui_cell_ft tel_jm"><span class="weui_btn weui_btn_mini weui_btn_primary">用药指导</span></a><?php } ?>
	            </div>
	            <?php } ?>
		    </div>
	    </div>
	    <div class="pages"><?php echo $pagelist; ?></div>
	</div>
<?php include $this->_include('footer.html'); ?>