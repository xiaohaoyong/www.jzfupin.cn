</div>
<div id="tabbar">
    <div class="weui_tabbar">
<?php if ($member) {  if ($member['modelid'] == 7) {  if ($member['status'] == 1) { ?>
        <a href="/?catid=15" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <!--i class="ion-ios-home-outline"></i-->
            <img src="/assets/images/home.png" class="img_nav"/>
            <img src="/assets/images/home_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">首页</p>
        </a>
        <a href="<?php echo $cats[7][url]; ?>" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <!--i class="ion-ios-medkit-outline"></i-->
            <img src="/assets/images/peixun.png" class="img_nav"/>
            <img src="/assets/images/peixun_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">培训信息</p>
        </a>
        <?php } else { ?>
        <a href="javascript:;" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <!--i class="ion-ios-home-outline"></i-->
            <img src="/assets/images/home.png" class="img_nav"/>
            <img src="/assets/images/home_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">首页</p>
        </a>
        <a href="javascript:;" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <!--i class="ion-ios-medkit-outline"></i-->
            <img src="/assets/images/peixun.png" class="img_nav"/>
            <img src="/assets/images/peixun_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">培训信息</p>
        </a>
        <?php } ?>
        <a href="/member" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <!--i class="ion-ios-person-outline"></i-->
            <?php if ($member[status] !=1) { ?><span class="ui-badge">1</span><?php } ?>
            <img src="/assets/images/user.png" class="img_nav"/>
            <img src="/assets/images/user_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">个人中心</p>
        </a>
<?php } else { ?>
        <a href="/?catid=22" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <!--i class="ion-ios-home-outline"></i-->
            <img src="/assets/images/home.png" class="img_nav"/>
            <img src="/assets/images/home_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">首页</p>
        </a>
        <a href="<?php echo $cats[1][url]; ?>" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <!--i class="ion-ios-list-outline"></i-->
            <img src="/assets/images/news.png" class="img_nav"/>
            <img src="/assets/images/news_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">扶贫专栏</p>
        </a>
        <a href="/member/?c=index&a=user" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <!--i class="ion-ios-chatbubble-outline"></i-->
            <img src="/assets/images/user.png" class="img_nav"/>
            <img src="/assets/images/user_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">个人中心</p>
        </a>
<?php }  } else { ?>
        <!--a href="/" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <img src="/assets/images/home.png" class="img_nav"/>
            <img src="/assets/images/home_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">首页</p>
        </a>
        <a href="<?php echo $cats[1][url]; ?>" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <img src="/assets/images/news.png" class="img_nav"/>
            <img src="/assets/images/news_open.png" class="img_nav_open" />
          </div>
          <p class="weui_tabbar_label">扶贫专栏</p>
        </a>
        <a href="/member/?c=register" class="weui_tabbar_item">
          <div class="weui_tabbar_icon">
            <i class="ion-ios-lightbulb-outline"></i>
          </div>
          <p class="weui_tabbar_label">快速注册</p>
        </a-->
<?php } ?>
      </div>
</div>
<div style="display:none"><script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1259596417'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1259596417%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script></div>
</body>
</html>