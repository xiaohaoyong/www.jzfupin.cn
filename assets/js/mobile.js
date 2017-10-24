var viewModel ={
    /*
    * @ 激活底部导航栏目 viewModel.changTarBar(@num);
    *  ：不激活任何栏目
    * 0：首页
    * 1：培训信息
    * 2：个人中心
    */
  changTarBar:function(n){
    $('#tabbar').find('.weui_bar_item_on').removeClass("weui_bar_item_on");
    if(!(typeof(n) == "undefined")) $('#tabbar').find('.weui_tabbar_item').eq(n).addClass("weui_bar_item_on");
  },
  selectUi:function(objname,title,array){
    $(objname).select({
      title: title,
      items: array,
      onChange: function(d) {
        console.log(this, d);
      },
      onClose: function() {
        console.log("close");
      },
      onOpen: function() {
        console.log("open");
      },
    });
  }
}
$(function () {
    var router = new Router({
        container: '#container',
        //enterTimeout: 250,
        //leaveTimeout: 250
    });

    // home
    var home = {
        url: '/',
        className: 'home',
        render: function () {
          return $('#tpl_home').html();
        },
        bind:function(){
          viewModel.changTarBar(0);
        }
    };


    // login
    var login = {
        url: '/login',
        className: 'login',
        render: function () {
          $('#tabbar').hide();
          return $('#tpl_login').html();
        }
    };

    // detial
    var detial = {
        url: '/detial',
        className: 'detial',
        render: function () {
          return $('#tpl_detial').html();
        },
        bind:function(){
          viewModel.changTarBar();
        }
    };

    // 完善资料
    var complete = {
        url: '/complete',
        className: 'complete',
        render: function () {
          return $('#tpl_complete').html();
        },
        bind:function(){
          $("#date").calendar({
            //value: ['1984-12-12'],
            minDate: '1900-12-12'
          });
        }
    };

    // 手动添加居民
    var add_user = {
        url: '/add_user',
        className: 'add_user',
        render: function () {
          return $('#tpl_add_user').html();
        }
    };


    // 辖区居民
    var user_list = {
        url: '/user_list',
        className: 'user_list',
        render: function () {
          return $('#tpl_user_list').html();
        },
        bind:function(){
          viewModel.selectUi("#sex","居民性别",["男", "女"]);
          viewModel.selectUi("#pool","是否贫困",["是", "否"]);
          viewModel.selectUi("#condition","条件查找",["1", "2"]);
        }
    };

    // 问诊专家
    var wzzj = {
        url: '/wzzj',
        className: 'wzzj',
        render: function () {
          return $('#tpl_wzzj').html();
        }
    };

    // 慢危病控
    var mwbk = {
        url: '/mwbk',
        className: 'mwbk',
        render: function () {
          return $('#tpl_mwbk').html();
        }
    };

    // 患者详细页1
    var patient01 = {
        url: '/patient01',
        className: 'patient01',
        render: function () {
          return $('#tpl_patient01').html();
        }
    };

    // 患者详细页2
    var patient02 = {
        url: '/patient02',
        className: 'patient02',
        render: function () {
          return $('#tpl_patient02').html();
        }
    };
    // 患者详细页3
    var patient03 = {
        url: '/patient03',
        className: 'patient03',
        render: function () {
          return $('#tpl_patient03').html();
        }
    };
    // 患者详细页4
    var patient04 = {
        url: '/patient04',
        className: 'patient04',
        render: function () {
          return $('#tpl_patient04').html();
        }
    };
    // 意见反馈
    var yjfk = {
        url: '/yjfk',
        className: 'yjfk',
        render: function () {
          return $('#tpl_yjfk').html();
        }
    };
    // 预防宣教
    var yfxj = {
        url: '/yfxj',
        className: 'yfxj',
        render: function () {
          return $('#tpl_yfxj').html();
        }
    };
    // 培训学习
    var pxxx = {
        url: '/pxxx',
        className: 'pxxx',
        render: function () {
          return $('#tpl_pxxx').html();
        }
    };
    // 个人中心
    var grzx = {
        url: '/grzx',
        className: 'grzx',
        render: function () {
          return $('#tpl_grzx').html();
        }
    };

    // 详细页面
    var xxym = {
        url: '/xxym',
        className: 'xxym',
        render: function () {
          return $('#tpl_xxym').html();
        }
    };

    // 相关协议
    var xgxy = {
        url: '/xgxy',
        className: 'xgxy',
        render: function () {
          return $('#tpl_xgxy').html();
        }
    };
    // 宣教阅读
    var xjyd = {
        url: '/xjyd',
        className: 'xjyd',
        render: function () {
          return $('#tpl_xjyd').html();
        }
    };
    // 问答列表
    var wdlb = {
        url: '/wdlb',
        className: 'wdlb',
        render: function () {
          return $('#tpl_wdlb').html();
        }
    };
    // 随诊记录
    var szjl = {
        url: '/szjl',
        className: 'szjl',
        render: function () {
          return $('#tpl_szjl').html();
        },
        bind:function(){
          viewModel.selectUi("#sex","居民性别",["男", "女"]);
          viewModel.selectUi("#pool","是否贫困",["是", "否"]);
          viewModel.selectUi("#condition","条件查找",["1", "2"]);
        }
    };
    // 居民首页
    var userindex = {
        url: '/userindex',
        className: 'userindex',
        render: function () {
          return $('#tpl_userindex').html();
        }
    };

    // 我的医生
    var userwdys = {
        url: '/userwdys',
        className: 'userwdys',
        render: function () {
          return $('#tpl_userwdys').html();
        }
    };

    router.push(home)
      .push(login)
      .push(detial)
      .push(complete)
      .push(add_user)
      .push(user_list)
      .push(wzzj)
      .push(mwbk)
      .push(patient01)
      .push(patient02)
      .push(patient03)
      .push(patient04)
      .push(yjfk)
      .push(yfxj)
      .push(pxxx)
      .push(grzx)
      .push(xxym)
      .push(xgxy)
      .push(xjyd)
      .push(wdlb)
      .push(szjl)
      .push(userindex)
      .push(userwdys)
      .setDefault('/')
      .init();

       if (/Android/gi.test(navigator.userAgent)) {
           window.addEventListener('resize', function () {
               if (document.activeElement.tagName == 'INPUT' || document.activeElement.tagName == 'TEXTAREA') {
                   window.setTimeout(function () {
                       document.activeElement.scrollIntoViewIfNeeded();
                   }, 0);
               }
           })
       }
   });
