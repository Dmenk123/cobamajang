<!-- Header Starts -->
<header id="header" class="header">
	<div class="header-inner">
		<!-- Navbar Starts -->
		<nav class="navbar navbar-expand-lg p-0" id="singlepage-nav">
			<!-- Logo Starts -->
			<div class="logo">
				<a data-toggle="collapse" data-target=".navbar-collapse.show" class="navbar-brand link-menu scroll-to-target" href="#mainslider">
					<!-- Logo White Starts -->
					<!--<img id="logo-light" class="logo-light" src="<?php echo base_url('assets/images/saras.png');?>" alt="logo-light" />-->
					<!-- Logo White Ends -->
					<!-- Logo Black Starts -->
					<!--<img id="logo-dark" class="logo-dark" src="<?php echo base_url('assets/images/saras.png');?>" alt="logo-dark" />-->
					<!-- Logo Black Ends -->
				</a>
			</div>
			<!-- Logo Ends -->
			<!-- Hamburger Icon Starts -->
			<button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span id="icon-toggler">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>
			<!-- Hamburger Icon Ends -->
			<!-- Navigation Menu Starts -->
			<div class="collapse navbar-collapse nav-menu" id="navbarSupportedContent">
				<ul class="nav-menu-inner ml-auto">
					<li style="cursor: pointer;"><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu" onclick="location.href = '<?=base_url('home');?>';"><i class="fa fa-home"></i> Home</a></li>
					<li style="cursor: pointer;"><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu" onclick="location.href = '<?=base_url('profile');?>';"><i class="fa fa-user"></i> Member Area</a></li>
					<?php 
					$sess = $this->session->all_userdata();
					if($sess['logged_in'] == true && $sess['is_agen'] == true) { 
					?>
						<li style="cursor: pointer;"><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu" onclick="location.href = '<?=base_url('home/logout');?>';"><i class="fa fa-user"></i> Log Out</a></li>
					<?php } ?>
					<!-- <li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu" href="#services"><i class="fa fa-cog"></i> services</a></li>
					<li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu" href="#portfolio"><i class="fa fa-image"></i> portfolio</a></li>
					<li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu" href="#team"><i class="fa fa-user"></i> team</a></li>
					<li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu" href="#blog"><i class="fa fa-comments"></i> blog</a></li>
					<li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu" href="#contact"><i class="fa fa-envelope"></i> contact</a></li> -->
				</ul>
			</div>
			<!-- Navigation Menu Ends -->
		</nav>
		<!-- Navbar Ends -->
	</div>
</header>
<!-- Header Ends -->