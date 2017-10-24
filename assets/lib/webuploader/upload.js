var webUploadH5 = function($list,$button,inputname,onefile,callback){
	flistlist = [],
	// 优化retina, 在retina下这个值是2
	ratio = window.devicePixelRatio || 1,
	// 缩略图大小
	thumbnailWidth = 79 * ratio,
	thumbnailHeight = 79 * ratio,
	// 初始化Web Uploader
	uploader = WebUploader.create({
		// 自动上传。
		auto: true,
		// swf文件路径
		swf: './assets/lib/webuploader/Uploader.swf',
		// 文件接收服务端。
		server: '/member/index.php?c=uploadfile&a=uploadify_upload&type=gif,jpg,jpeg,png',
		// 选择文件的按钮。可选。
		// 内部根据当前运行是创建，可能是input元素，也可能是flash.
		pick: {
			id: $button,
			multiple: onefile,
		},
		// 只允许选择文件，可选。
		accept: {
			title: 'Images',
			extensions: 'gif,jpg,jpeg,bmp,png',
			mimeTypes: 'image/*',
		}
	});

	// 当有文件添加进来的时候
	uploader.on( 'fileQueued', function( file ) {
		var fileurl = "[fileurl][]";
		var filename = "[filename][]";
		if(!onefile) {
			$list.empty(); //单文件移除老dom
			var fileurl = "";
			var filename = "";
			var $li = $(
			'<li id="' + file.id + '" class="weui_uploader_file weui_uploader_status" data-name="' + file.name + '">' + 
				'<input type="hidden" name="'+ inputname + filename +'" value="'+ file.name +'" />' +
				'<div class="weui_uploader_status_content"></div>' +
			'</li>'
			),$status = $li.find('div');
		} else {
			var $li = $(
			'<li id="' + file.id + '" class="weui_uploader_file weui_uploader_status" data-name="' + file.name + '">' + 
				'<i class="weui_icon_cancel del-btn"></i>' +
				'<input type="hidden" name="'+ inputname + fileurl +'" value="" />' +
				'<input type="hidden" name="'+ inputname + filename +'" value="'+ file.name +'" />' +
				'<div class="weui_uploader_status_content"></div>' +
			'</li>'
			),$status = $li.find('div');
		}
		
		$list.append( $li );
		// 创建缩略图
		uploader.makeThumb( file, function( error, src ) {
			if ( error ) {
				$status.replaceWith('不能预览');
				return;
			}
			$li.css( 'background-image', 'url('+src+')' );
		}, thumbnailWidth, thumbnailHeight );
	});

	// 文件上传过程中创建进度条实时显示。
	uploader.on( 'uploadProgress', function( file, percentage ) {
		var $li = $( '#'+file.id ),
			$percent = $li.find('.weui_uploader_status_content');

		// 避免重复创建
		if ( !$percent.length ) {
			$percent = $('<div class="weui_uploader_status_content"></div>')
					.appendTo( $li );
		}
		percentage =percentage.toFixed(2);
		$percent.text( percentage * 100 + '%' );
	});
	
	//局部设置，给每个独立的文件上传请求参数设置，每次发送都会发送此对象中的参数。。参考：https://github.com/fex-team/webuploader/issues/145
	uploader.on('uploadBeforeSend', function( block, data, headers) {
	    data.submit = new Date().toLocaleTimeString();
	});

	// 文件上传成功，给item添加成功class, 用样式标记上传成功。
	uploader.on( 'uploadSuccess', function( file,response ) {
	  //返回文件路径
	  flistlist.push(response._raw);
	  console.log(flistlist);
	  var $li = $( '#'+file.id ),
	  	$input =  $li.find('input').eq(0),
		$percent = $li.find('.weui_uploader_status_content');
		$li.removeClass('weui_uploader_status').attr('data-url',response._raw);
		$percent.text('');
		$input.val(response._raw);
		//$list.find('input').val(flistlist.join("|"));
		if(callback) callback(response._raw);
	});

	// 文件上传失败，现实上传出错。
	uploader.on( 'uploadError', function( file ) {
		var $li = $( '#'+file.id ),
			$error = $li.find('div.weui_uploader_status_content');
		// 避免重复创建
		if ( !$error.length ) {
			$error = $('<div class="weui_uploader_status_content"></div>').appendTo( $li );
		}
		$error.empty().html('<i class="weui_icon_warn"></i>');
	});
}