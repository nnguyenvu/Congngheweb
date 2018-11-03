<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php $this->load->view('site/head');?>
		
	</head>
	<body background ="<?php echo public_url('/site')?>/images/body.jpg">
	<div id="container" >
		<a href="#" id="back_to_top" style="display: block;">
		   <img src="<?php echo public_url()?>/site/images/top.png">
	  </a>
	  <div class="wraper">
	  
	  </div>
	  <div class="header">
		<?php  $this->load->view('site/header')?>
	  </div>
	  <div class="row">
	  
	 <!--menu-->
	  <div class="menu">
			<?php  $this->load->view('site/menu')?>
	  
	  </div>
	  
	  <div  style="background-color:FFE4E1 ">
			<div class="left">
				<?php $this->load->view('site/left',$this->data);?>
			</div>
			 <div class="content">
	                      <?php if(isset($message)):?>
	                      <h3 style="color:red"><?php echo $message?></h3>
	                      <?php endif;?>
	                      <?php $this->load->view($temp , $this->data);?>
	        </div>
			<div class="right">
				<?php $this->load->view('site/right',$this->data);?>
			</div>
			<div class="clear">
			
			</div>
	  </div>
	  
	  <center>
			<img src="<?php echo public_url()?>/site/images/bank.png"> 
		</center>
		</div>
		<div class="footer">
			<?php $this->load->view('site/footer');?>
		</div>
	</div>
	</body>
</html>