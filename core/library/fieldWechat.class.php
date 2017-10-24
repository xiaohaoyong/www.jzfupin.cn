<?php
if (!defined('IN_IAEWEB')) exit();

class fieldWechat {
	public static function input($name, $content = '', $setting = '',$tips, $inputtype = 'text')
    {
        $str ='<div class="weui_cell_bd weui_cell_primary">'.
                '<input class="weui_input" id="'. $name .'" type="'.$inputtype.'" name="data[' . $name . ']" value="' . $content . '" placeholder="'. $tips .'">'.
            '</div>';
        //$style = isset($setting['size']) ? " style='width:" . ($setting['size'] ? $setting['size'] : 150) . "px;'" : '';
        //return '<input type="text" value="' . $content . '" class="input-text" name="data[' . $name . ']" ' . $style . '>';
        return $str;
    }

    public static function textarea($name, $content = '', $setting = '',$tips)
    {
        //$style = isset($setting['width']) && $setting['width'] ? 'width:' . $setting['width'] . 'px;' : '';
        //$style .= isset($setting['height']) && $setting['height'] ? 'height:' . $setting['height'] . 'px;' : '';
        //return '<textarea style="' . $style . '" name="data[' . $name . ']">' . $content . '</textarea>';
        
        $str ='<div class="weui_cell_bd weui_cell_primary">'.
                '<textarea class="weui_textarea" name="data[' . $name . ']" placeholder="'. $tips .'" rows="3">' . $content . '</textarea>'.
            '</div>';
        return $str;
    }

    public static function editor($name, $content = '', $setting = '')
    {
        $width = isset($setting['width']) && $setting['width'] ? $setting['width'] : '680';
        $height = isset($setting['height']) && $setting['height'] ? $setting['height'] : '420';
        $str = '';
        $page = !isset($setting['system']) && $name == 'content' ? ", 'pagebreak'" : '';
        $source = defined('IAEWEB_ADMIN') ? "'source', '|'," : '';
        $other = defined('IAEWEB_ADMIN') || defined('IAEWEB_MEMBER') ? "allowFileManager : true, uploadJson : './index.php?c=uploadfile&a=kindeditor_upload', fileManagerJson : './index.php?c=uploadfile&a=kindeditor_filemanager'," : "allowImageUpload: false, allowFlashUpload: false,allowMediaUpload:false,allowFileUpload:false,";
		
        $items = isset($setting['items']) && $setting['items'] ? $setting['items'] : '';

        if (!defined('IAEWEB_EDITOR_LD')) {
            $str .= '<script type="text/javascript" src="../core/img/kindeditor/kindeditor-min.js"></script>';
            define('IAEWEB_EDITOR_LD', 1);
        }
		if ($setting['toolbar'] == 2) {
            $str .= "<script type=\"text/javascript\">
		KindEditor.ready(function(K) {
                window.editor = K.create('#" . $name . "', { 
				" . $other . "
				items:[" . $items . "]
			});
        });
		</script>";
        } else if ($setting['toolbar'] == 1) {
            $str .= "<script type=\"text/javascript\">
		KindEditor.ready(function(K) {
                window.editor = K.create('#" . $name . "', { 
				" . $other . "
				items:[" . $source . "'forecolor','bold','italic','underline','lineheight','|','fontname','fontsize','code','plainpaste','wordpaste','|','image','multiimage','flash','media','insertfile','link','unlink','|','justifyleft','justifycenter','justifyright','justifyfull','insertorderedlist','insertunorderedlist','indent','outdent','clearhtml','quickformat','hr','baidumap'" . $page . ",'|','fullscreen']
			});
        });
		</script>";
        } else {
            $str .= "<script type=\"text/javascript\">
		KindEditor.ready(function(K) {
                window.editor = K.create('#" . $name . "', { 
				" . $other . "
				items:[" . $source . "'forecolor','bold','italic','underline','|','image','flash','media','insertfile','link','unlink','fontname','fontsize','|','justifyleft','justifycenter','justifyright','justifyfull','clearhtml','quickformat','baidumap','|','fullscreen']
			});
        });
		</script>";
        }
        $str .= '<textarea id="' . $name . '" name="data[' . $name . ']" style="width:' . $width . 'px;height:' . $height . 'px;">' . $content . '</textarea>';
        if (!isset($setting['system']) && $name == 'content' && defined('IAEWEB_ADMIN')) {
            $str .= '<div style="padding-top:3px;"><label><input type="checkbox" checked value="1" name="data[xiao_auto_description]">自动获取摘要 </label> <label><input type="checkbox" checked value="1" name="data[xiao_auto_thumb]">自动获取缩略图</label> <label><input type="checkbox" checked value="1" name="data[xiao_download_image]">下载远程图片</label></div>';
        }
        return $str;
    }
	
	public static function select($name, $content = '', $setting = '')
    {
        $select = explode(chr(13), $setting['content']);
        $str = '<div class="weui_cell_bd weui_cell_primary">';
        $str .= "<select class='weui_select' id='" . $name . "' name='data[" . $name . "]'>";
        foreach ($select as $t) {
            $select_name = $select_value = $selected = '';
            list($select_name, $select_value) = explode('|', $t);
            $select_value = is_null($select_value) ? trim($select_name) : trim($select_value);
            $selected = $select_value == $content ? ' selected' : '';
            $str .= "<option value='" . $select_value . "'" . $selected . ">" . $select_name . "</option>";
        }
        return $str . '</select></div>';
    }

    public static function radio($name, $content = '', $setting = '')
    {
        $select = explode(chr(13), $setting['content']);
        $str = '';
        foreach ($select as $t) {
            $select_name = $select_value = $selected = '';
            list($select_name, $select_value) = explode('|', $t);
            $select_value = is_null($select_value) ? trim($select_name) : trim($select_value);
            $selected = $select_value == $content ? ' checked' : '';
            $str .= $select_name . '&nbsp;<input type="radio" name="data[' . $name . ']" value="' . $select_value . '" ' . $selected . '/>&nbsp;&nbsp;';
        }
        return $str;
    }

    public static function checkbox($name, $content = '', $setting = '')
    {
        $arr = string2array($content);
        if ($arr) $content = $arr;
        else $content = @explode(',', $content);
        $select = explode(chr(13), $setting['content']);
        $str = '';
        foreach ($select as $t) {
            $select_name = $select_name = $selected = '';
            list($select_name, $select_value) = explode('|', $t);
            $select_value = is_null($select_value) ? trim($select_name) : trim($select_value);
            $selected = is_array($content) && in_array($select_value, $content) ? ' checked' : '';
            $str .= $select_name . '&nbsp;<input type="checkbox" name="data[' . $name . '][]" value="' . $select_value . '" ' . $selected . ' />&nbsp;&nbsp;';
        }
        return $str;
    }

    public static function file($name, $content = '', $setting = '')
    {
        $_type = explode(',', $setting['type']);
        if ($setting['buttontxt']) {
            $txt = $setting['buttontxt'];
        } else {
            $txt = '上传文件';
        }
        foreach ($_type as $t) {
            $type .= '*.' . $t . ';';
        }
        $size = $setting['size'] * 1024;
        $js = "<script type=\"text/javascript\">
$(function() {
var Button=$(\"#button_" . $name . "\");
	Button.uploadify({
		height : '22',
		width : '68',
		swf           : '../core/img/uploadify/uploadify.swf?ver='+ Math.random(),
		uploader      : './index.php?c=uploadfile&a=uploadify_upload&type=" . $setting['type'] . "',
 		method   : 'post',
		formData : { 'submit' : '1',
		                    'session_id' : '" . session_id() . "'
						},
        fileTypeExts: '" . $type . "',  
        fileObjName:'file',
		buttonText: '" . $txt . "',
        queueSizeLimit: 1,
		fileSizeLimit   : '" . $size . "', 
		onUploadSuccess :function(file,data,response){
		$(\"#" . $name . "\").val(data);
		},
		'onUploadProgress':function(file,bytesUploaded,bytesTotal,totalBytesUploaded,totalBytesTotal){
			var num = Math.round(bytesUploaded / bytesTotal * 10000) / 100.00 + \"%\";
			Button.uploadify('settings','buttonText','上传：' + num);
		},
		'onQueueComplete' : function(queueData) {
			Button.uploadify('disable', false);
			Button.uploadify('settings','buttonText','上传');
			Button.uploadify('cancel','*');
		}
	});
	});</script>";
        $preview = $setting['preview'] ? 'onmouseover="showImg(this)"  onmouseout="hideImg(this)"' : '';
        return $js . '
	<input type="text" class="input-text"  size="50" value="' . $content . '" name="data[' . $name . ']" id="' . $name . '" ' . $preview . '>
	<input id="button_' . $name . '" type="file" multiple="true">';
    }

    public static function files($name, $content = '', $setting = '')
    {
        $preview = $setting['preview'] ? 'onmouseover="showImg(this)"  onmouseout="hideImg(this)"' : '';
        if ($setting['preview']) $p = 1;
        else $p = 0;
        $_type = explode(',', $setting['type']);
        foreach ($_type as $t) {
            $type .= '*.' . $t . ';';
        }
        $size = $setting['size'] * 1024;
        $js = "<script type=\"text/javascript\">
$(function() {
var Button=$(\"#button_" . $name . "\");
	Button.uploadify({
		height : '22',
		width : '68',
		swf           : '../core/img/uploadify/uploadify.swf?ver='+ Math.random(),
		uploader      : './index.php?c=uploadfile&a=uploadify_upload&type=" . $setting['type'] . "',
 		method   : 'post',
		formData : { 'submit' : '1',
		                    'session_id' : '" . session_id() . "'
						},
        fileTypeExts: '" . $type . "',  
        fileObjName:'file',
		buttonText: '批量上传',
        queueSizeLimit: 10,
		fileSizeLimit   : '" . $size . "', 
		onUploadSuccess :function(file,data,response){
		htmlList('" . $name . "',data,file,'" . $preview . "');
		},
		'onUploadProgress':function(file,bytesUploaded,bytesTotal,totalBytesUploaded,totalBytesTotal){
			var num = Math.round(bytesUploaded / bytesTotal * 10000) / 100.00 + \"%\";
			Button.uploadify('settings','buttonText','上传：' + num);
		},
		'onQueueComplete' : function(queueData) {
			Button.uploadify('disable', false);
			Button.uploadify('settings','buttonText','上传');
			Button.uploadify('cancel','*');
		}
	});
	});</script>";
        $str = '
	    <fieldset class="blue pad-10">
        <legend>上传文件列表</legend>
        <div class="picList" id="list_' . $name . '_files"><ul id="' . $name . '-sort-items">';
        if ($content) {
            $content = string2array($content);
            $fileurl = $content['fileurl'];
            $filename = $content['filename'];
            if (is_array($fileurl) && !empty($fileurl)) {
                foreach ($fileurl as $id => $path) {
                    $str .= '<li id="files_999' . $id . '">';
                    $str .= '<input type="text" class="input-text" style="width:450px;" value="' . $fileurl[$id] . '" name="data[' . $name . '][fileurl][]"  id="' . $name . $id . '" ' . $preview . '>';
                    $str .= '<input type="text" class="input-text" style="width:160px;" value="' . $filename[$id] . '" name="data[' . $name . '][filename][]">';
                    $str .= '<a href="javascript:removediv(\'999' . $id . '\');">删除</a></li>';
                }
            }
        }
        $str .= '</ul></fieldset>
		<div class="bk10"></div>
		<input type="button"  class="button" value="添加地址" name="delete" onClick="add_null_file(\'' . $name . '\')" >&nbsp;
		<input id="button_' . $name . '" type="file" multiple="true">
		';
        return $js . $str;
    }

    public static function date($name, $content = '', $setting = '')
    {
        $type = isset($setting['type']) ? $setting['type'] : 'yyyy-MM-dd HH:mm:ss';
        if ($setting['system']) $content = $content ? date('Y-m-d H:i:s', $content) : date('Y-m-d H:i:s'); //系统内置日期字段和自定义是不一样的
         $str ='<div class="weui_cell_bd weui_cell_primary">';
        // if (!defined('IAEWEB_DATE_LD')) {
        //     $str .= '<script type="text/javascript" src="../core/img/calendar/lhgcalendar.min.js"></script>';
        //     define('IAEWEB_DATE_LD', 1); //防止重复加载JS
        // }
        return $str . '
    <input class="weui_input" name="data['. $name .']" type="text" id="' . $name .'" readonly> </div>
	<script type="text/javascript">
	$(function(){
    $("#' . $name . '").calendar();
	});
    </script>';
    }
	
    public static function related($name, $content = '', $setting = '')
    {
     	$style = isset($setting['size']) ? " style='width:" . ($setting['size'] ? $setting['size'] : 200) . "px;'" : '';
		if ($content) {
	    	$_db = iaeweb::load_class('Model');
			$view = iaeweb::load_class('view');
	    	$_ids = $_db->setTableName('content')->getAll('id IN ('.$content.')',null,'id,title','id desc');
            foreach ($_ids as $t) {
               $ids .= '<li id="v1' . $t['id'] . '"><span><a href='.$view->get_show_url($t).' target="_blank">' . $t['title'] . '</a></span><a href="javascript:;" class="close" onclick="remove_relation(\'v1' . $t['id'] . '\',' . $t['id'] . ',\'' . $name . '\')"></a></li>';
            }
		}
        $str = '
		<input type="text" class="input-text" name="data[' . $name . ']" id="' . $name . '" readonly value="' . $content . '"  ' . $style . '  >
		<input type="button" value="添加相关" onClick="omnipotent(\'selectid\',\'' . url('content/related', array('name'=>$name)) . '\',\'添加相关内容\',1)" class="button">
		<ul class="list-dot" id="' . $name . '_text">' . $ids . '</ul>
		';
        return $str;
    }
	
    public static function diy($name, $content = '', $setting = '')
    { 
    	if (!empty($setting['isarr']))	$content = string2array($content);
        $form =  $setting['form'];
		$form = str_replace('$','',$form);
		$form = str_replace('xiao_field_name','$name',$form);
		$form = str_replace('xiao_field_value','$content',$form);
        eval( "\$form = \"$form\";" );
        return htmlspecialchars_decode($setting['jscss'] . $form);
    }

}