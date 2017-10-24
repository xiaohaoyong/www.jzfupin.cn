<?php include $this->admin_tpl('header');?>
<script type="text/javascript">
top.document.getElementById('position').innerHTML = '会员信息';
</script>
<script type="text/javascript">
function ajaxemail() {
	$('#email_text').html('');
	$.post('<?php echo url('member/ajaxemail'); ?>&rid='+Math.random(), { email:$('#email').val(), id:<?php echo $id; ?> }, function(data){ 
        $('#email_text').html(data); 
	});
}
</script>
<div class="subnav">
		<form method="post" action="" id="myform" name="myform">
		<table width="100%" class="table_form ">
		<tbody>
		<tr>
			<th width="120">修改会员：</th>
			<td><?php echo $data['username']; ?>&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<th>手机号：</th>
			<td><?php echo $data['phone']; ?></td>
		</tr>
		<tr>
			<th>姓名：</th>
			<td><?php echo $data['name']; ?></td>
		</tr>
		<?php if($data['modelid']==5) { ?>
		<tr>
			<th>关联医生：</th>
			<td>
			    <select class="select" id="userid" name="data[userid]">
					<option value="0">选择医生</option>
					<?php foreach($docs as $d) { ?>
    					<?php if($data['userid']==$d['id']) { ?>
    					    <option value="<?php echo $d['id'];?>" selected><?php echo $d['name'];?></option>
    				    <?php } else { ?>
    				        <option value="<?php echo $d['id'];?>"><?php echo $d['name'];?></option>
    				    <?php } ?>
					<?php } ?>
				</select>
			</td>
		</tr>
		<?php } ?>
		<tr>
			<th>所属模型：</th>
			<td><?php echo $member_model['modelname']; ?></td>
		</tr>
		<tr>
			<th>新密码：</th>
			<td><input type="text" class="input-text" size="25" value="" name="password">
			<div class="onShow">不修改密码请留空。</div></td>
		</tr>
		<tr>
			<th>注册邮箱：</th>
			<td><input type="text" class="input-text" size="25" id="email" value="<?php echo $data['email']; ?>" name="data[email]"onBlur="ajaxemail()">
			<span id="email_text"></span>
			</td>
		</tr>
		<tr>
			<th>注册时间：</th>
			<td><?php echo date('Y-m-d H:i:s', $data['regdate']); ?></td>
		  </tr>
		<tr>
			<th>注册IP：</th>
			<td><?php echo $data['regip']; ?></td>
		</tr>

		<?php if($member_model['modelid'] == 7) {?>
		<tr>
			<th>状态：</th>
			<td>
			<input type="radio" <?php if (!isset($data['status']) || $data['status']==2) { ?>checked<?php } ?> value="2" name="data[status]"> 待审核认证
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" <?php if (!isset($data['status']) || $data['status']==1) { ?>checked<?php } ?> value="1" name="data[status]"> 已认证
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" <?php if (isset($data['status']) && $data['status']==0) { ?>checked<?php } ?> value="0" name="data[status]"> 待提交认证
			</td>
		</tr>
		<?php } else {?>
		<tr>
			<th>状态：</th>
			<td>
			<input type="radio" <?php if (!isset($data['status']) || $data['status']==1) { ?>checked<?php } ?> value="1" name="data[status]"> 认证
			&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" <?php if (isset($data['status']) && $data['status']==0) { ?>checked<?php } ?> value="0" name="data[status]"> 未认证
			</td>
		</tr>
		<?php } ?>

		<?php  echo $data_fields;   ?>
		<tr>
			<th>&nbsp;</th>
			<td><input type="submit" class="button" value="提交" name="submit"></td>
		</tr>
		</tbody>
		</table>
		</form>
</div>
</body>
</html>
