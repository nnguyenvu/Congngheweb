
<div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?php echo base_url()?>">Trang chủ</a></li>
                        <li><a href="<?php echo site_url('home/introduce')?>" >Giới thiệu</a></li>
                        <li><a href="<?php echo site_url('home/help')?>" >Hướng dẫn</a></li>
                        <li><a href="<?php echo site_url('product/index')?>">Sản phẩm </a></li>
                        
                        <li><a href="<?php echo site_url('home/maps')?>" >Địa chỉ</a></li>
                        <li><a href="https://www.facebook.com/profile.php?id=100008876621202" target="_blank">Liên hệ</a></li>
                        <?php if(isset($user_info)):?>
							<li class=""><a href="<?php echo site_url('user')?>"><img width="19px" height="19px" src="<?php echo public_url('/site')?>/images/boyicon.png"><?php echo ' : '.$user_info->name?></a></li>
							<li class=""><a href="<?php echo site_url('user/logout')?>">Đăng xuất</a></li>
							<?php else:?>
							<li  class=""><a href="<?php echo site_url('user/register')?>">Đăng ký</a></li>
							<li  class=""><a href="<?php echo site_url('user/login')?>">Đăng nhập</a></li>
						<?php endif;?>
                    </ul>
                </div>  
            </div>
        </div>
    </div>