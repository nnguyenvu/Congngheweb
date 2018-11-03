<!-- The box-header-->			        
<link rel="stylesheet" href="<?php echo public_url()?>/js/jquery/autocomplete/css/smoothness/jquery-ui-1.8.16.custom.css" type="text/css">	
<script src="<?php echo public_url()?>/js/jquery/autocomplete/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function() {
    $( "#text-search" ).autocomplete({
        source: "<?php echo site_url('product/search/1')?>",
    });
});
</script>

<!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!-- Custom CSS -->
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
	
	 <link rel="stylesheet" href="style.css">



      <!-- The top -->
     
       <!-- End logo -->
       
       <!--  load gio hàng -->
	   <br><br>
	<div class="col-9">
       <div class="search" ><!-- the search -->
			<form action="<?php echo site_url('product/search')?>" method="get">
			     <div class="search-text"><input type="text" aria-haspopup="true" aria-autocomplete="list" role="textbox" autocomplete="off" class="ui-autocomplete-input" placeholder="Tìm kiếm sản phẩm..." value="<?php echo isset($key) ? $key : ''?>" name="key-search" id="text-search"></div>
				 <div class="sub-search"><input type="submit" value="" name="but" id="but"></div>
			</form>
       </div><!-- End search -->
       
     </div>    
	 
  <div class="col-3">   
  <div class="cart">
	<div class="shopping-item" >
							<a href="<?php echo base_url('cart')?>">Cart - <span class="cart-amunt"><?php echo number_format($total_amount)?>đ</span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo $total_items?></span></a>
	 </div>  
	</div>
 </div>
      
    <div class="clear"></div><!-- clear float --> 
	<br>
	
<!-- End top -->			   <!-- End box-header  -->

	
	
 