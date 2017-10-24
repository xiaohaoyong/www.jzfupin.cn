
<div class="weui-row weui-no-gutter col-border line2 panel_nav cou_nav swiper-container" id="list_nav">
	<div class="swiper-wrapper">
	
	<?php if ($member['modelid'] == 7) {  $n=$j=0;  $return = $this->_listdata("table=category parentid=0 modelid=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
			<div class="swiper-slide text-c"><a href="/?catid=<?php echo $v[catid]; ?>"<?php if ($v[catid] == $catid) {  $j=$n; ?> class="open"<?php } ?>><?php echo $v[catname]; ?></a></div>
			<?php $n++;  }  } else {  $n=$j=0;  $catids[]=1;  $return = $this->_category("parentid=1");  if (is_array($return))  foreach ($return as $key=>$v) { $allchildids = @explode(',', $v['allchildids']);    $current = in_array($catid, $allchildids); $catids[]=$v[catid];  }  $catids = implode(',',$catids);  $return = $this->_listdata("table=category parentid=0 catid=$catids"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
			<div class="swiper-slide text-c"><a href="/?catid=<?php echo $v[catid]; ?>"<?php if ($v[catid] == $catid) {  $j=$n; ?> class="open"<?php } ?>><?php echo $v[catname]; ?></a></div>
			<?php $n++;  }  $return = $this->_listdata("table=category catid=34 num=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
			<div class="swiper-slide text-c"><a href="/?catid=<?php echo $v[catid]; ?>"<?php if ($v[catid] == $catid) {  $j=$n; ?> class="open"<?php } ?>><?php echo $v[catname]; ?></a></div>
			<?php $n++;  }  } ?>


	</div>
</div>
<script type="text/javascript">
$(function(){
	$("#list_nav").swiper({
	    /*freeMode : true,*/
	    paginationClickable: true,
        slidesPerView: 4,
        spaceBetween: 0,
        initialSlide: <?php echo $j; ?>
	  });
});
</script>
