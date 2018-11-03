<!--head-->
<?php $this->load->view('admin/transaction/head',$this->data)?>
<div class="line"></div>
<div class="wrapper">
	<div class="widget">
		<div class="title">
			
			<h6>Cập nhật Trạng thái giao dịch</h6>
		 	
		</div>
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="formRow">
					<label class="formLeft" for="param_name">Trạng thái:<span class="req">*</span></label>
					<div class="formRight">
						<span class="oneTwo"><input name="status" id="param_status" value="<?php echo $info->status?>" _autocheck="true"  type="text"></span>
						<br>
						<p>Nếu cập nhật trạng thái thì mới cập nhật giá trị</p>
						
						<pre>  Nhập '1' nếu đã thanh toán</pre>
						<pre>  Nhập '0' nếu chưa thanh toán</pre>
						<span name="name_autocheck" class="autocheck"></span>
						<div name="name_error" class="clear error"><?php echo form_error('name')?></div>
					</div>
					<div class="clear"></div>
				
				
				
				<div class="formSubmit">
	           			<input type="submit" value="Cập nhật " class="redB">
	           			
	           	</div>
			</fieldset>
				
		</form>
	</div>
	
</div>
		