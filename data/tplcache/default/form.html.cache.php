<?php include $this->_include('header.html'); ?>
<script src="/assets/lib/webuploader/webuploader.nolog.min.js"></script>
<script src="/assets/lib/webuploader/upload.js"></script>
<script type="text/javascript">
	$(function(){
		webUploadH5($('#uplodImages .fileList'),$('#uplodImages .filePicker'),'data[files]',true);
	});
</script>
<form action="" method="post">
	<div class="weui_cells_title">体检报告内容</div>
	<div class="weui_cells weui_cells_form">
		<input type="hidden" class="button" value="提交" name="submit">
		<input type="hidden" class="button" value="/?id=<?php echo $cid; ?>" name="gobackurl">
		<div class="weui_cell">
			<div class="weui_cell_bd weui_cell_primary">
				<textarea class="weui_textarea" name="data[content]" placeholder="请输入体检报告内容" rows="15"></textarea>
			</div>
		</div>
	</div>
	<div class="weui_cells weui_cells_form nomtop">
	    <div class="weui_cell nob">
	        <div class="weui_cell_bd weui_cell_primary">
	            <div class="weui_uploader">
	                <div class="weui_uploader_bd" id="uplodImages">
	                    <ul class="weui_uploader_files fileList"></ul>
	                    <div class="weui_uploader_input_wrp filePicker"> </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="weui_btn_area">
		<button class="weui_btn weui_btn_primary">提交</button>
	</div>
</form>
<?php include $this->_include('footer.html'); ?>