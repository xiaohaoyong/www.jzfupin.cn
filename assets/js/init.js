var addr ={
  changAvatar:'/member/index.php?c=index&a=avatar',
  getSmsCode:'/?c=api&a=sendsms',
  checkSmsCode:'/?c=api&a=checksms',
  telme:'/?c=api&a=telme',
  toushu:'/?c=api&a=toushu',
  golike:'/?c=index&a=form&modelid=17',
  getcontentnum:'/?c=api&a=getcontentnum',
  teljm:'/?c=api&a=teljm',
  getjcscjson:'/?c=api&a=jcscjson&t=yimaiCheckCategory&api=1226',
  getjcsclistjson:'/?c=api&a=jcscjson&t=yimaiCheckList&api=1230',
  getyyzsjson:'/?c=api&a=jcscjson&t=yimaiCodexCategory&api=1231',
  getyyzslistjson:'/?c=api&a=jcscjson&t=yimaiCodexList&api=1232',
}
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
  },
  changAvatar:function(avatar){
    $.ajax(addr.changAvatar, {
      type: 'POST',
      data: {avatar:avatar},
      success: function (resInfo) {
        console.log(resInfo);
      }
    });
  },
  daojishi: function (obj,second){
      if (second != 0) {
          obj.addClass('weui_btn_disabled').text("请查看短信(" + second + ")");
          setTimeout(function () {
              second--;
              viewModel.daojishi(obj,second);
          }, 1000);
      }
      else {
          $('input#phone').removeAttr('disabled');
          obj.removeClass('weui_btn_disabled').text("获取验证码");
      }
  },
  getSmsCode:function(){
    var $this = $(this);
    var phone = $.trim($('input#phone').val());
    var reg = /^0?1[3|4|5|7|8][0-9]\d{8}$/;
    // var isgetsms = Number($('input#isgetsms').val());
    // if(isgetsms == 1) { $.alert('不能重复发送'); return false;}
    console.log(phone);
    if (!$this.hasClass('weui_btn_disabled')) {
      if (reg.test(phone)) {
        $.ajax(addr.getSmsCode, {
          type: 'POST',
          data: {phone:phone},
          beforeSend:function(){
            $.showLoading();
            $this.addClass('weui_btn_disabled').text("获取中...");
          },
          success: function (resInfo) {
            $.hideLoading();
            console.log(resInfo);
            if(resInfo.data.code == 0){
               $.toast("发送成功");
               $('input#phone').attr('disabled','true');
               viewModel.daojishi($this,60);
               //$('input#isgetsms').val('1');
            } else {
              $this.removeClass('weui_btn_disabled').text("获取验证码");
              var alert_msg = resInfo.data.msg;
              if(resInfo.data.detail) alert_msg = resInfo.data.detail;
              $.alert(alert_msg, "错误提示");
            }
          }
        });
      } else {
        $.alert("请输入正确的电话号码", "错误提示");
      };
    }
  },
  cheaksms:function(){
    var res = 0;
    var smscode = $.trim($('input#smscode').val());
    var phone = $.trim($('input#phone').val());
    if(smscode != "" && phone != ""){
      $.ajax(addr.checkSmsCode, {
        type: 'POST',
        async: false,
        data: {
          phone:phone,
          smscode:smscode
        },
        beforeSend:function(){
          $.showLoading();
        },
        success: function (resInfo) {
          $.hideLoading();
          console.log(resInfo);
          if(resInfo.code == 0){
            res = 1;
          } else {
            res = 0;
            $.alert(resInfo.msg);
          }
        }
      });
    } else {
      if(smscode == "" )$.alert('请输入短信验证码');
      if(phone == "" )$.alert('请输入手机号');
    }
    return res;
  },
  telme:function(uid){
    $.ajax(addr.telme, {
        type: 'POST',
        data: {uid:uid},
        beforeSend:function(){
          $.showLoading();
        },
        success: function (resInfo) {
          $.hideLoading();
          console.log(resInfo);
          if(resInfo == 1) $.toast("操作成功");
        }
      });
  },
  toushu:function(cid){
     $.prompt("请填写你的投诉描述", "输入描述", function(text) {
        $.ajax(addr.toushu, {
          type: 'POST',
          data: {cid:cid,content:text},
          beforeSend:function(){
            $.showLoading();
          },
          success: function (resInfo) {
            $.hideLoading();
            console.log(resInfo);
            if(resInfo == 1) $.toast("操作成功");
          }
        });
      }, function() {
        //取消操作
      });
  },
  getcontentnum:function(id,obj,type){
    $.ajax(addr.getcontentnum, {
      type: 'POST',
        data: {
          type:type,
          id:id,
        },
        success: function (resInfo) {
          obj.text(resInfo.num);
        }
      });
  },
  golike:function(){
    var cid = $(this).attr('data-id');
    var type = $(this).attr('data-type');
    var _this = $(this);
    $.ajax(addr.golike+"&cid="+cid, {
        type: 'POST',
        data: {
          ajax:1,
          data:{type:type},
          submit:"提交"
        },
        beforeSend:function(){
          $.showLoading();
        },
        success: function (resInfo) {
          $.hideLoading();
          console.log(resInfo);
          if(resInfo.code == 1) { 
            $.toast("操作成功");
            //_this.text();
            viewModel.getcontentnum(cid,_this.find('span').eq(0),type);
          } else {
            $.alert(resInfo.msg);
          }
        }
      });
  },
  showallinfo:function(){
    var list = $(this).parents('div.weui_panel_bd');
    var pdesc = $(this).parents('div.weui_media_box').find('p.weui_media_desc');
    var files_list = $(this).parents('div.weui_media_box').find('div.files_list');

    if($(this).hasClass('active_a')){
      pdesc.removeClass('allinfo');
      files_list.hide();
      $(this).removeClass('active_a');
    } else {
      list.find('p.weui_media_desc').removeClass('allinfo');
      list.find('div.weui_media_desc').hide();
      pdesc.addClass('allinfo');
      files_list.show();
      $(this).addClass('active_a');
    }
  },
  teljm:function(){
    var phone = $(this).attr('data-phone');
    var cid = $(this).attr('data-cid');
    var _this = $(this);
     $.confirm("您确定要拨打电话给居民吗?", "确认拨打", function() {
        $.ajax(addr.teljm, {
          type: 'POST',
          data: {cid:cid},
          // beforeSend:function(){
          //   $.showLoading();
          // },
          success: function (resInfo) {
            // $.hideLoading();
            console.log(resInfo);
            if(resInfo == 1) {
              _this.remove();
              window.location.href="tel:"+phone;
            }
          }
        });
      }, function() {
        //取消操作
      });
  },
  loadjcsccat:function(id){
    $.ajax(addr.getjcscjson, {
      type: 'POST',
      data: {id:id},
      beforeSend:function(){
        $.showLoading();
      },
      success: function (resInfo) {
        $.hideLoading();
        console.log(resInfo);
        $('#cat_list').empty().html($('#cat_list_tmpl').tmpl(resInfo.data));
      }
    });
  },
  loadjcsclist:function(id){
    $.ajax(addr.getjcsclistjson, {
      type: 'POST',
      data: {id:id},
      beforeSend:function(){
        $.showLoading();
      },
      success: function (resInfo) {
        $.hideLoading();
        console.log(resInfo);
        $('#c_list').empty().html($('#c_list_tmpl').tmpl(resInfo.data));
      }
    });
  },
  loadyyzscat:function(id){
    $.ajax(addr.getyyzsjson, {
      type: 'POST',
      data: {id:id},
      beforeSend:function(){
        $.showLoading();
      },
      success: function (resInfo) {
        $.hideLoading();
        console.log(resInfo);
        if(resInfo.no == 1) {
          $('#cat_list').empty().html($('#cat_list_no_tmpl').tmpl(resInfo.data));
        } else {
          $('#cat_list').empty().html($('#cat_list_tmpl').tmpl(resInfo.data));
        }
      }
    });
  },
  loadyyzslist:function(id){
    $.ajax(addr.getyyzslistjson, {
      type: 'POST',
      data: {id:id},
      beforeSend:function(){
        $.showLoading();
      },
      success: function (resInfo) {
        $.hideLoading();
        console.log(resInfo);
        $('#c_list').empty().html($('#c_list_tmpl').tmpl(resInfo.data));
      }
    });
  },
  getjcscjson:function(){
    var _this = $(this);
    var id = _this.attr('data-id');
    $('.weui_bar_item_on').removeClass('weui_bar_item_on');
    _this.addClass('weui_bar_item_on');
    viewModel.loadjcsccat(id);
  },
  getyyzsjson:function(){
    var _this = $(this);
    var id = _this.attr('data-id');
    $('.weui_bar_item_on').removeClass('weui_bar_item_on');
    _this.addClass('weui_bar_item_on');
    viewModel.loadyyzscat(id);
  }
};
//格式传统表单 输出为对象
$.fn.serializeObject = function()  
  {  
     var o = {};  
     var a = this.serializeArray();  
     $.each(a, function() {  
         if (o[this.name]) {  
             if (!o[this.name].push) {  
                 o[this.name] = [o[this.name]];  
             }  
             o[this.name].push(this.value || '');  
         } else {  
             o[this.name] = this.value || '';  
         }  
     });  
     return o;  
  }; 

$(function(){

  $('a.a_like').click(viewModel.golike);//初始化 点赞功能

  //$('a.a_showinfo').click(viewModel.showallinfo);//初始化 展开功能

  //修复ajax 不生效 展开功能
  $('body').on('click','a.a_showinfo',viewModel.showallinfo);

  $('a.tel_jm').click(viewModel.teljm);//初始化 用药指导

  $('#jcsc_nav a.weui_navbar_item').click(viewModel.getjcscjson);

  $('#yyzs_nav a.weui_navbar_item').click(viewModel.getyyzsjson);

})