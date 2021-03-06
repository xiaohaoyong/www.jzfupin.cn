<?php include $this->_include('header.html'); ?>
<script src="/assets/lib/webuploader/webuploader.nolog.min.js"></script>
<script src="/assets/lib/webuploader/upload.js"></script>
<script type="text/javascript">
	$(function(){
		webUploadH5($('#hwpic .fileList'),$('#hwpic .filePicker'),'data[hwpic]',true);
		webUploadH5($('#xdtpic .fileList'),$('#xdtpic .filePicker'),'data[xdtpic]',true);
		webUploadH5($('#xtpic .fileList'),$('#xtpic .filePicker'),'data[xtpic]',true);

		
		var maibo = '<select class="weui_select" name="data[maibo]">';
		for (var i = 20; i < 201; i++) {
			if(i==72){
				maibo += '<option value="'+i+'" selected>'+i+'</option>';	
			} else {
				maibo += '<option value="'+i+'">'+i+'</option>';	
			}
		};
		maibo += '</select>';
		$('#maibo').html(maibo);


		var tiwen = '<select class="weui_select" name="data[tiwen]">';
		for (var i = 330; i < 431; i++) {
			if(i==365){
				tiwen += '<option value="'+i/10+'" selected>'+i/10+'</option>';	
			} else {
				tiwen += '<option value="'+i/10+'">'+i/10+'</option>';	
			}
		};
		tiwen += '</select>';
		$('#tiwen').html(tiwen);


		var shengao = '<select class="weui_select" name="data[shengao]">';
		for (var i = 30; i < 241; i++) {
			if(i==170){
				shengao += '<option value="'+i+'" selected>'+i+'</option>';	
			} else {
				shengao += '<option value="'+i+'">'+i+'</option>';	
			}
		};
		shengao += '</select>';
		$('#shengao').html(shengao);


		var tizhong = '<select class="weui_select" name="data[tizhong]">';
		for (var i = 2; i < 201; i++) {
			if(i==65){
				tizhong += '<option value="'+i+'" selected>'+i+'</option>';	
			} else {
				tizhong += '<option value="'+i+'">'+i+'</option>';	
			}
		};
		tizhong += '</select>';
		$('#tizhong').html(tizhong);

		var huxi = '<select class="weui_select" name="data[huxi]">';
		for (var i = 6; i < 61; i++) {
			if(i==16){
				huxi += '<option value="'+i+'" selected>'+i+'</option>';	
			} else {
				huxi += '<option value="'+i+'">'+i+'</option>';	
			}
		};
		huxi += '</select>';
		$('#huxi').html(huxi);

		var ssy = '<select class="weui_select" name="data[ssy]">';
		for (var i = 30; i < 201; i++) {
			if(i==100){
				ssy += '<option value="'+i+'" selected>'+i+'</option>';	
			} else {
				ssy += '<option value="'+i+'">'+i+'</option>';	
			}
		};
		ssy += '</select>';
		$('#ssy').html(ssy);

		var szy = '<select class="weui_select" name="data[szy]">';
		for (var i = 20; i < 201; i++) {
			if(i==100){
				szy += '<option value="'+i+'" selected>'+i+'</option>';	
			} else {
				szy += '<option value="'+i+'">'+i+'</option>';	
			}
		};
		szy += '</select>';
		$('#szy').html(szy);


		var xuetang = '<select class="weui_select" name="data[xuetang]">';
		for (var i = 20; i < 201; i++) {
			if(i==100){
				xuetang += '<option value="'+i/10+'" selected>'+i/10+'</option>';	
			} else {
				xuetang += '<option value="'+i/10+'">'+i/10+'</option>';	
			}
		};
		xuetang += '</select>';
		$('#xuetang').html(xuetang);

		var chxt = '<select class="weui_select" name="data[chxt]">';
		for (var i = 20; i < 201; i++) {
			if(i==100){
				chxt += '<option value="'+i/10+'" selected>'+i/10+'</option>';	
			} else {
				chxt += '<option value="'+i/10+'">'+i/10+'</option>';	
			}
		};
		chxt += '</select>';
		$('#chxt').html(chxt);

		$('#tizhong select').change(function(){
			var tz = Number($('#tizhong select').val());
			var sg = Number($('#shengao select').val())*0.01;
			var BMI = tz/(sg*sg);
			$('#BMI').val(BMI.toFixed(1));
		});
		$('#shengao select').change(function(){
			var tz = Number($('#tizhong select').val());
			var sg = Number($('#shengao select').val())*0.01;
			var BMI = tz/(sg*sg);
			$('#BMI').val(BMI.toFixed(1));
		});



	})
</script>
<style>
	.weui_cell_select .weui_cell_bd:after{border-width:0;}
	.weui_select{height:40px;line-height: 40px;}
</style>
<style>
.weui_cells{font-size: 14px}
</style>
<form action="" method="post">
	<div class="weui_cells_title">新增预警</div>
	<div class="weui_cells">
		<input type="hidden" class="button" value="提交" name="submit">
		<input type="hidden" class="button" value="/?id=<?php echo $cid; ?>" name="gobackurl">
		<div class="weui-row weui-no-gutter" id="user_nav">
			<div class="weui_cell weui_cell_select weui_select_after weui-col-100">
		    	<div class="weui_cell_hd">血压：</div>
		    	<div class="weui_cell_bd weui_cell_primary">
	               <div class="weui-row weui-no-gutter">
		               	<div class="weui-col-50" style="border-right:1px solid #eee" id="ssy">
		               	</div>
		               	<div class="weui-col-50" id="szy">
		               	</div>
		           </div>
	            </div>
	            <div class="weui_cell_ft">mmHg</div>
		    </div>

		    <div class="weui_cell weui_cell_select weui_select_after weui-col-50">
		    	<div class="weui_cell_hd">空腹血糖：</div>
		    	<div class="weui_cell_bd weui_cell_primary" id="xuetang">
	            </div>
	            <div class="weui_cell_ft">mmol/L</div>
		    </div>

		    <div class="weui_cell weui_cell_select weui_select_after weui-col-50">
		    	<div class="weui_cell_hd">餐后血糖：</div>
		    	<div class="weui_cell_bd weui_cell_primary" id="chxt">
	            </div>
	            <div class="weui_cell_ft">mmol/L</div>
		    </div>

		    <div class="weui_cell weui_cell_select weui_select_after weui-col-50">
		    	<div class="weui_cell_hd">身高：</div>
		    	<div class="weui_cell_bd weui_cell_primary" id="shengao">
	            </div>
	            <div class="weui_cell_ft">cm</div>
		    </div>

		    <div class="weui_cell weui_cell_select weui_select_after weui-col-50">
		    	<div class="weui_cell_hd">体重：</div>
		    	<div class="weui_cell_bd weui_cell_primary" id="tizhong">
	            </div>
	            <div class="weui_cell_ft">kg</div>
		    </div>

		    <div class="weui_cell weui_cell_select weui_select_after weui-col-50">
		    	<div class="weui_cell_hd">体温：</div>
		    	<div class="weui_cell_bd weui_cell_primary" id="tiwen">
	            </div>
	            <div class="weui_cell_ft">℃</div>
		    </div>
		    <div class="weui_cell weui-col-50">
		    	<div class="weui_cell_hd">BMI：</div>
		    	<div class="weui_cell_bd weui_cell_primary">
	               <input class="weui_input" type="text" name="data[BMI]" placeholder="" id="BMI">
	            </div>
	            <div class="weui_cell_ft">kg/m²</div>
		    </div>

		    <div class="weui_cell weui_cell_select weui_select_after weui-col-50">
		    	<div class="weui_cell_hd">呼吸：</div>
		    	<div class="weui_cell_bd weui_cell_primary" id="huxi">
	            </div>
	            <div class="weui_cell_ft">次/分</div>
		    </div>
		    <div class="weui_cell weui_cell_select weui_select_after weui-col-50">
		    	<div class="weui_cell_hd">脉搏：</div>
		    	<div class="weui_cell_bd weui_cell_primary" id="maibo">
	               <!--input class="weui_input" type="text" name="data[maibo]" placeholder=""-->
	            </div>
	            <div class="weui_cell_ft">次/分</div>
		    </div>
	    </div>
	</div>
	<div class="weui_cells nomtop">
	    <div class="weui_cell">
	    	<div class="weui_cell_hd">从事劳动：</div>
	    	<div class="weui_cell_bd weui_cell_primary">
               <div class="weui-row weui-no-gutter">
	               <input type="radio" name="data[csldqk]" value="不能从事" checked="">&nbsp;不能从事&nbsp;&nbsp;<input type="radio" name="data[csldqk]" value="轻体力工作">&nbsp;轻体力工作&nbsp;&nbsp;<input type="radio" name="data[csldqk]" value="正常劳动">&nbsp;正常劳动
	           </div>
            </div>
	    </div>
	    <div class="weui_cell">
	    	<div class="weui_cell_hd">用药情况：</div>
	    	<div class="weui_cell_bd weui_cell_primary">
               <div class="weui-row weui-no-gutter">
	               <input type="radio" name="data[yyqk]" value="未服用药物" checked="">&nbsp;未服用药物&nbsp;&nbsp;<input type="radio" name="data[yyqk]" value="间断性用药">&nbsp;间断性用药&nbsp;&nbsp;<input type="radio" name="data[yyqk]" value="长期用药">&nbsp;长期用药
	           </div>
            </div>
	    </div>
    </div>
    <div class="weui_cells_title">服用药物名称及用法：</div>
    <div class="weui_cells">
	    <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea class="weui_textarea" placeholder="阿莫西林：2粒/次，3次/日" name="data[yybz]" rows="5"></textarea>
            </div>
        </div>
	</div>
	<div class="weui_cells_title">血糖图：</div>
    <div class="weui_cells nomtop">
	    <div class="weui_cell nob">
	        <div class="weui_cell_bd weui_cell_primary">
	            <div class="weui_uploader">
	                <div class="weui_uploader_bd" id="xtpic">
	                    <ul class="weui_uploader_files fileList"></ul>
	                    <div class="weui_uploader_input_wrp filePicker"> </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="weui_cells_title">心电图：</div>
    <div class="weui_cells">
	    <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea class="weui_textarea" placeholder="请输入心电图说明" name="data[xdtinfo]" rows="2"></textarea>
            </div>
        </div>
    </div>
    <div class="weui_cells nomtop">
	    <div class="weui_cell nob">
	        <div class="weui_cell_bd weui_cell_primary">
	            <div class="weui_uploader">
	                <div class="weui_uploader_bd" id="xdtpic">
	                    <ul class="weui_uploader_files fileList"></ul>
	                    <div class="weui_uploader_input_wrp filePicker"> </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="weui_cells_title">红外诊断图：</div>
    <div class="weui_cells">
	    <div class="weui_cell">
            <div class="weui_cell_bd weui_cell_primary">
                <textarea class="weui_textarea" placeholder="请输入红外诊断图说明" name="data[hwinfo]" rows="2"></textarea>
            </div>
        </div>
    </div>
    <div class="weui_cells nomtop">
	    <div class="weui_cell nob">
	        <div class="weui_cell_bd weui_cell_primary">
	            <div class="weui_uploader">
	                <div class="weui_uploader_bd" id="hwpic">
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