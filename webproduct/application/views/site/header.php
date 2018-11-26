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

<!-- Include jQuery. -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>

        <!-- Include Cloud Zoom CSS. -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>cloudzoom/cloudzoom.css" />

        <!-- Include Cloud Zoom script. -->
        <script type="text/javascript" src="<?php echo base_url()?>cloudzoom/cloudzoom.js"></script>

        <!-- Call quick start function. -->
        <script type="text/javascript">
            CloudZoom.quickStart();
        </script>    
  <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
<!-- Bootstrap -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url()?>style.css">
    <link rel="stylesheet" href="<?php echo base_url()?>css/responsive.css">
	
	 <link rel="stylesheet" href="<?php echo base_url()?>style.css">



	 
      <!-- The top -->
     <div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="user-menu">
                        <ul>
                            <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>
                            <!-- <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li> -->
                            <li><a href="<?php echo base_url('cart')?>"><i class="fa fa-user"></i> My Cart</a></li>
                            <li><a href="checkout.html"><i class="fa fa-user"></i> Checkout</a></li>
                            <li><a href="#"><i class="fa fa-user"></i> Login</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- <div class="col-md-4">
                    <div class="header-right">
                        <ul class="list-unstyled list-inline">
                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">currency :</span><span class="value">USD </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USD</a></li>
                                    <li><a href="#">INR</a></li>
                                    <li><a href="#">GBP</a></li>
                                </ul> 
                            </li>

                            <li class="dropdown dropdown-small">
                                <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#"><span class="key">language :</span><span class="value">English </span><b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">English</a></li>
                                    <li><a href="#">French</a></li>
                                    <li><a href="#">German</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </div> <!-- End header area -->
	<br>
	<br>
	<div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="index.html"><span>Shop Beauty</span></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="<?php echo base_url('cart')?>">Cart - <span class="cart-amunt"><?php echo number_format($total_amount)?>đ</span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo $total_items?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
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
	 
 
      
    <div class="clear"></div><!-- clear float --> 
	<br>
	
<!-- End top -->			   <!-- End box-header  -->

	
	
 