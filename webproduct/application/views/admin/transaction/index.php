<!--head-->

<?php $this->load->view('admin/transaction/head',$this->data)?>

<div class="line"></div>

<div class="wrapper" id="main_transaction" >
<?php $this->load->view('admin/message', $this->data);?>
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>
				Danh sách giao dịch			</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll" border="1px" >
			
			<thead class="filter" ><tr><td colspan="12" >
				<form class="list_filter form" action="<?php echo base_url('admin/transaction/')?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%" ><tbody>
					
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã đơn hàng</label></td>
							<td class="item"><input name="id" value="<?php echo $this->input->get('id')?>" id="filter_id" type="text" style="width:55px;"></td>
							
							
							<td style="width:150px">
								<input type="submit" class="button blueB" value="Lọc">
								<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo base_url('admin/transaction/')?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('/admin/images/') ?>icons/tableArrows.png"></td>
					<td style="width:45px;">Mã đơn hàng</td>
					<td style="width:15px;">User ID</td>
					<td>User name</td>
					<td>phone</td>
					<td>User mail</td>
					<td>Số tiền</td>
					<td>Lời nhắn</td>
					<td >Cổng thanh toán</td>
					<td >Trạng thái</td>
					<td >Ngày tạo</td>
					<td >Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="12">
						<div class="list_action itemActions">
								<a url="<?php echo base_url('admin/transaction/delete_all')?>" class="button blueB" id="submit" href="#submit">
									<span style="color:white;">Xóa hết</span>
								</a>
						 </div>
							
					     <div class="pagination">
							<?php echo $this->pagination->create_links()?>
			              </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
			<?php foreach ($list as $row):?>
			      <tr class="row_<?php echo $row->id?>" >
					<td><input type="checkbox" name="id[]" value="<?php echo $row->id?>"></td>
					
					<td class="textC"><?php echo $row->id?></td>
					<td class="textC"><?php echo $row->user_id?></td>
					<td class="textC"><?php echo $row->user_name?></td>
					<td class="textC"><?php echo $row->user_phone?></td>
					<td class="textC"><?php echo $row->user_email?></td>
					<td>
					  <?php echo  number_format($row->amount).' đ' ?>					
					 </td>
					 <td class="textC"><?php echo $row->message?></td>
					<td><?php echo $row->payment?></td>
					<td><?php 
					if($row->status==0){
						echo 'Chưa thanh toán ';
					}
					else{
						echo'Đã thanh toán';
					}
					?></td>
					

					<td class="textC"><?php echo get_date($row->created)?></td>
					
					<td class="option textC">
								
						 
						
						<a href="<?php echo base_url('admin/transaction/del/'.$row->id)?>" title="Xóa" class="tipS verify_action">
						    <img src="<?php echo public_url('/admin/images/') ?>icons/color/delete.png">
						</a>
						
						
						 <a href="<?php echo base_url('admin/transaction/edit/'.$row->id)?>" title="Chỉnh sửa" class="tipS">
							<img src="<?php echo public_url('/admin/images/') ?>icons/color/edit.png">
						</a>
						
					</td>
				</tr>
		        <?php endforeach;?>			      
		   </tbody>
			
		</table>
	</div>
	
</div>