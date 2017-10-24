<?php include $this->_include('header.html'); ?>
<script src="/assets/lib/webuploader/webuploader.nolog.min.js"></script>
<script src="/assets/lib/webuploader/upload.js"></script>
<style>
.weui_uploader_file .del-btn{display:block;}
</style>
<?php if ($member['status'] != 3) {  $dis_input = ""; ?>
<script type="text/javascript">
    $(function(){
        $("#date").calendar({
            value: ['1990-12-12'],
            minDate: '1900-01-01',
            maxDate: '<?php echo date('Y-m-d'); ?>'
        });
        webUploadH5($('#avatarImages .fileList'),$('#avatarImages .filePicker'),'data[avatar]',false,
            function(avatar){
                viewModel.changAvatar(avatar);
            });
        webUploadH5($('#uplodImages .fileList'),$('#uplodImages .filePicker'),'data[images]',true);
        $('.complete').on('click','#getsmscode',viewModel.getSmsCode);
        $('.complete').on('click','.del-btn',function(){
            $(this).parent('.weui_uploader_file').remove();
        });
        //读取身份证
        $('input#cardid')
            .attr('maxlength',18)
            .attr('onkeyup',"value=value.replace(\/\[\^\\d\|x\|X\]\/g,'')")
            .attr('onbeforepaste',"clipboardData.setData('text',clipboardData.getData('text').replace(\/\[\^\\d\|x\|X\]\/g,''))");
        $('input#cardid').bind('input propertychange', function() {
            if($.trim($(this).val()).length > 14) {
                var ic = $.trim($(this).val());
                var birth = ic.substring(6, 10) + "-" + ic.substring(10, 12) + "-" + ic.substring(12, 14);  
                $('#date').val(birth);
            }
        });

    })
</script>
<?php } else {  $dis_input = "disabled"; ?>
<script type="text/javascript">
    $(function(){
        webUploadH5($('#avatarImages .fileList'),$('#avatarImages .filePicker'),'data[avatar]',false,
        function(avatar){
            viewModel.changAvatar(avatar);
        });
    })
</script>
<?php } ?>
<div class="complete">
    <form action="" method="post">
    <input type="hidden" value="保 存" name="submit">
    <div class="weui_cells weui_cells_access weui_cells_form nomtop">
        <div class="weui_cell">
            <div class="weui_cell_hd weui_cell_primary"><label class="weui_label">头像</label></div>
            <!--div class="upload-avatar">
                <img class="avatar_thumb radius100" src="<?php echo $member[avatar]; ?>" alt="">
                <div class="weui_uploader_input_wrp">
                    <input class="weui_uploader_input" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple="">
                </div>
            </div-->
            <div class="upload-avatar">
                <div class="weui_uploader_bd" id="avatarImages">
                    <ul class="weui_uploader_files fileList">
                        <li class="weui_uploader_file" style="background-image:url(<?php echo $member[avatar]; ?>);background-color:#ccc">
                            <input type="hidden" name="data[avatar]" value="<?php echo $member[avatar]; ?>" />
                        </li>
                    </ul>
                    <div class="weui_uploader_input_wrp filePicker"> </div>
                </div>
            </div>
            <div class="weui_cell_ft"></div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">姓名</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" name="data[name]" value="<?php echo $member[name]; ?>" placeholder="请输入姓名" <?php echo $dis_input; ?>>
            </div>
        </div>
        <div class="weui_cell weui_cell_select weui_select_after">
            <div class="weui_cell_hd">
                <label for="" class="weui_label">性别</label>
            </div>
            <div class="weui_cell_bd weui_cell_primary">
                <select class="weui_select" name="data[sex]" <?php echo $dis_input; ?>>
                    <option value="1"<?php if ($member[sex] == 1) { ?> selected<?php } ?>>男</option>
                    <option value="2"<?php if ($member[sex] == 2) { ?> selected<?php } ?>>女</option>
                </select>
            </div>
        </div>
        <?php if ($member['status'] != 100) { ?>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input weui_input_disabled" type="tel" id="phone" name="data[phone]" value="<?php echo $member[phone]; ?>" placeholder="请输入手机号" disabled>
            </div>
        </div>
        <?php } else { ?>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="tel" id="phone" name="data[phone]" value="<?php echo $member[phone]; ?>" placeholder="请输入手机号" <?php echo $dis_input; ?>>
            </div>
            <a class="weui_btn weui_btn_default" href="javascript:" id="getsmscode">获取验证码</a>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="phone" id="smscode" name="data[smscode]" placeholder="请输入短信验证码">
            </div>
        </div>
        <?php } ?>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">身份证</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" name="data[cardid]" id="cardid" value="<?php echo $member[cardid]; ?>" placeholder="请输入身份证" <?php echo $dis_input; ?>>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label for="date" class="weui_label">出生日期</label></div>
            <div class="weui_cell_bd weui_cell_primary">
              <input class="weui_input" id="date" name="data[brithday]" type="text" value="<?php echo $member[brithday]; ?>" placeholder="请选择您的出生日期" readonly="" <?php echo $dis_input; ?>>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">专长疾病</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" name="data[good]" value="<?php echo $member[good]; ?>" placeholder="请输入专长疾病" <?php echo $dis_input; ?>>
            </div>
        </div>
    </div>
    <div class="weui_cells_title">医生简介</div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea class="weui_textarea" placeholder="请输入医生简介" name="data[info]" rows="3" <?php echo $dis_input; ?>><?php echo $member[info]; ?></textarea>
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <div class="weui_uploader">
                    <div class="weui_uploader_hd weui_cell">
                        <div class="weui_cell_bd weui_cell_primary">证书上传</div>
                    </div>
                    <div class="weui_uploader_bd" id="uplodImages">
                        <ul class="weui_uploader_files fileList">
                            <?php $p = unserialize($member[images]);  if (is_array($p['fileurl']))  foreach ($p['fileurl'] as $k=>$v) { ?>
                                <li class="weui_uploader_file" style="background-image:url(<?php echo $v; ?>);">
                                    <i class="weui_icon_cancel del-btn"></i>
                                    <input type="hidden" name="data[images][fileurl][]" value="<?php echo $v; ?>" <?php echo $dis_input; ?> />
                                    <input type="hidden" name="data[images][filename][]" value="<?php echo $p['filename'][$k]; ?>" <?php echo $dis_input; ?> />
                                </li>
                            <?php  } ?>
                        </ul>
                        <div class="weui_uploader_input_wrp filePicker"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="weui_btn_area">
        <button class="weui_btn weui_btn_primary">下一步</button>
    </div>
    </form>
</div>
<?php include $this->_include('footer.html'); ?>
