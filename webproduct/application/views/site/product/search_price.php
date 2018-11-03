
	<!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
	
	 <link rel="stylesheet" href="style.css">
	 
	 <div class="box-center" ><!-- The box-center product-->
	 
	<div class="tittle-box-center">
		        <h2>Kết quả tìm kiếm với giá từ "<?php echo number_format($price_from)?>đ" tới "<?php echo number_format($price_to)?>đ"</h2>
		      </div>

				<br>
				<br>

              



                            
                            
                            
                   <?php foreach ($list as $row):?>
                            
                
				 
				 <div class="single-product" style ="width:218px;height: 320px;float:left;padding-left:20px;">
                                <div class="product-f-image">
								<span style="float:left;margin-left:10px; color: green">Lượt xem: <b><?php echo $row->view?></b></span>
								<br>
                                    <img alt="<?php echo $row->name?>" src="<?php echo base_url('upload/product/'.$row->image_link)?>">
                                    <div class="product-hover">
                                        <a title="Mua ngay" href="<?php echo base_url('cart/add/'.$row->id)?>" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i> Mua ngay</a>
                                        <a title="<?php echo $row->name?>" href="<?php echo base_url('product/view/'.$row->id)?>" class="view-details-link"><i class="fa fa-link"></i> Chi tiết</a>
                                    </div>
                                </div>
                                
                                <h2><a title="<?php echo $row->name?>" href="<?php echo base_url('product/view/'.$row->id)?>">
                              <?php echo $row->name?>	                    
                          </a></h2>

                                 <p class="price">
                              <?php if($row->discount > 0):?>
                              <?php $price_new = $row->price - $row->discount;?>
                              <?php echo number_format($price_new)?> đ &nbsp &nbsp <del><span class="price_old"><?php echo number_format($row->price)?> đ</span></del>
				              <?php else:?>
				                <?php echo number_format($row->price)?> đ
				              <?php endif;?>
		                 </p>                                
                            
							
							
							
						
							</div>
							<?php endforeach;?>
</div>