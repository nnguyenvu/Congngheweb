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
	<!--facebook rep inbox -->
	<div id="fb-root"></div>
<script src="<?php echo base_url()?>ib-facebook/ib-fb.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>ib-facebook/fb-css.css">
<script src="<?php echo base_url()?>ib-facebook/fb-jq.js"></script>
<div id="cfacebook">
<a href="javascript:;" class="chat_fb" onClick="return:false;"><i class="fa fa-facebook-square"></i> Chat với Shop Beauty</a>
<div class="fchat">
<div style="width:250px;" class="fb-page"
data-href="https://www.facebook.com/Shop-beauty-2251998445076925/?modal=admin_todo_tour"
data-tabs="messages"
data-width="260"
data-height="280"
data-small-header="true">
<div class="fb-xfbml-parse-ignore">
<blockquote></blockquote>
</div>
</div>
</div>


</div>
</div>
	
	</body>
</html>