<!--head-->

<?php $this->load->view('admin/order/head',$this->data)?>

<div class="line"></div>

<div class="wrapper" id="main_order">

	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>
				Danh sách hóa đơn			</h6>
		 	<div class="num f12">Số lượng: <b><?php echo $total_rows?></b></div>
		</div>
		
		<table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable" id="checkAll" border="1px">
			
			<thead class="filter"><tr><td colspan="7">
				<form class="list_filter form" action="<?php echo base_url('admin/order')?>" method="get">
					<table cellpadding="0" cellspacing="0" width="80%"><tbody>
					
						<tr>
							<td class="label" style="width:40px;"><label for="filter_id">Mã số</label></td>
							<td class="item"><input name="id" value="<?php echo $this->input->get('id')?>" id="filter_id" type="text" style="width:55px;"></td>
							
							
							<td style="width:150px">
								<input type="submit" class="button blueB" value="Lọc">
								<input type="reset" class="basic" value="Reset" onclick="window.location.href = '<?php echo base_url('admin/order')?>'; ">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="<?php echo public_url('/admin/images/') ?>icons/tableArrows.png"></td>
					<td style="width:30px;">STT</td>
					<td>Mã đơn hàng</td>
					<td>Mã sản phẩm</td>
					<td>Số lượng mua</td>
					<td>Giá</td>
					<td >Hành động</td>
					
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="7">
						<div class="list_action itemActions">
								<a url="<?php echo base_url('admin/order/delete_all')?>" class="button blueB" id="submit" href="#submit">
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
					<td class="textC"><?php echo $row->transaction_id?></td>
					<td class="textC"><?php echo $row->product_id?></td>
					<td class="textC"><?php echo $row->qty?></td>
					<td>
					  <?php echo  number_format($row->amount) ?>					
					 </td>
					
					
					
					<td class="option textC">
								<a href="<?php echo base_url('product/view/'.$row->product_id)?>" target="_blank" class="tipS" title="Xem chi tiết hóa đơn">
								<img src="<?php echo public_url('/admin/images/') ?>icons/color/view.png">
						 </a>
						 
						
						<a href="<?php echo base_url('admin/order/del/'.$row->id)?>" title="Xóa" class="tipS verify_action">
						    <img src="<?php echo public_url('/admin/images/') ?>icons/color/delete.png">
						</a>
						
						
					</td>
				</tr>
		        <?php endforeach;?>			      
		   </tbody>
			
		</table>
	</div>
	
</div>