<?php $uids = array();  $return = $this->_listdata("catid=25 userid=$member[id]"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) {  if ($v[uid]> 0) {  $uids[] = $v[uid];  }  }  $uids = implode(',',$uids);  if ($tab == 1) {  if (!empty($uids)) {  $return = $this->_listdata("catid=6 userid=$uids order=id_desc status=0,1,2 iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
		    <div class="weui_media_box weui_media_text">
				<div class="weui_media_bd">
			      <h4 class="weui_media_title">
			        <span class="pull-right color-blue text-sm"><?php echo $cats[$v[catid]][catname]; ?></span>
			        <?php if ($v['status']==0) { ?><font color="#FF0000">[未审]</font><?php }  echo $v[title]; ?>
			      </h4>
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
						<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
						<?php if ($member[modelid] == 7) { ?><li class="weui_media_info_meta weui_media_info_meta_extra"><a href="<?php echo $v[url]; ?>">我要回答</a></li><?php } ?>
						<li class="pull-right">
							<a href="<?php echo $v[url]; ?>">立即查看</a>
							<!--a href="javascript:;" class="a_showinfo">
								<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
								<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
							</a-->
						</li>
					</ul>
			    </div>  
		    </div>
		    <!--@todo 调去回答-->
	    <?php }  }  }  if ($tab == 2) {  $return = $this->_listdata("catid=8 userid=$member[id] order=id_desc status=0,1,2 iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
	    <div class="weui_media_box weui_media_text">
			<div class="weui_media_bd">
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
					<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
					<li class="pull-right">
					    <a href="<?php echo $v[url]; ?>">立即查看</a>
						<!--a href="javascript:;" class="a_showinfo">
							<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
							<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
						</a-->
					</li>
				</ul>
		    </div>  
	    </div>
	    <!--@todo 调去回答-->
    <?php }  }  if ($tab == 3) {  $return = $this->_listdata("catid=9 userid=$member[id] order=id_desc status=0,1,2 iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
	    <div class="weui_media_box weui_media_text">
			<div class="weui_media_bd">
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
					<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
					<li class="pull-right">
						<a href="<?php echo $v[url]; ?>">立即查看</a>
						<!--a href="javascript:;" class="a_showinfo">
							<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
							<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
						</a-->
					</li>
				</ul>
		    </div>  
	    </div>
	    <!--@todo 调去回答-->
    <?php }  }  if ($tab == 4) {  if (!empty($uids)) {  $return = $this->_listdata("catid=5 userid=$uids order=id_desc status=0,1,2 iaeweb=1"); extract($return); if (is_array($return))  foreach ($return as $key=>$v) { ?>
	    <div class="weui_media_box weui_media_text">
			<div class="weui_media_bd">
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
					<li class="weui_media_info_meta"><?php echo date('Y-m-d',$v['time']); ?></li>
					<li class="pull-right">
						<a href="<?php echo $v[url]; ?>">立即查看</a>
						<!--a href="javascript:;" class="a_showinfo">
							<span class="show_btn">展开 <i class="ion-ios-arrow-down"></i></span>
							<span class="hide_btn">收起 <i class="ion-ios-arrow-up"></i></span>
						</a-->
					</li>
				</ul>
		    </div>  
	    </div>
	    <!--@todo 调去回答-->
    <?php }  }  } ?>