<?php $this->load->view('site/slide', $this->data);?>

<!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
	
	 <link rel="stylesheet" href="style.css">
	 
	 <div class="tittle-box-center">
		        <h2>Sản phẩm mới</h2>
		      </div>


<div class="box-center" ><!-- The box-center product-->
              


<div class="product-carousel owl-carousel owl-theme owl-responsive-1000 owl-loaded">
                            
                            
                            
                   <?php foreach ($product_newest as $row):?>
                            
                 <div class="owl-item cloned" style="width: 212px; margin-right: 20px;">
				 
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
							
							</div>
							<?php endforeach;?>
							</div>
							
</div>


<div class="tittle-box-center">
		        <h2>Sản phẩm mua nhiều</h2>
		      </div>

<div class="box-center" ><!-- The box-center product-->
              


<div class="product-carousel owl-carousel owl-theme owl-responsive-1000 owl-loaded">
                            
                            
                            
                   <?php foreach ($product_buy as $row):?>
                            
                 <div class="owl-item cloned" style="width: 212px; margin-right: 20px;">
				 
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
							
							</div>
							<?php endforeach;?>
							</div>
							
</div>


