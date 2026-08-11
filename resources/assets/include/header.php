<?php
define('base_url', 'http://www.outpost-interactive.com/prototype/ee072a01604cc3bb78312dedb1a41b0f84ecab8d/'); 
?>
<script type="text/javascript">
$(document).ready(function() {
$(".open-search").click(function () {
		$("#<?php echo $_SERVER['REQUEST_URI'] === '/prototype/ee072a01604cc3bb78312dedb1a41b0f84ecab8d/' ? 'form-search-head-absolute' : 'form-search'?>").stop().slideToggle(200);
		$("#<?php echo $_SERVER['REQUEST_URI'] === '/prototype/ee072a01604cc3bb78312dedb1a41b0f84ecab8d/' ? 'form-search-head-absolute' : 'form-search'?>").css('z-index','999');
		$("i", this).toggleClass("fa-search fa-times");
	});
});
</script>

<header class="<?php echo $_SERVER['REQUEST_URI'] === '/prototype/ee072a01604cc3bb78312dedb1a41b0f84ecab8d/' ? 'absolute-header' : ''?>">
	<div class="container custom-container-md">
		<div class="row">
			<div class="col-lg-2 col-md-2 col-xs-3 img-logo">
				<a href="<?php echo base_url; ?>index.php">
					<img src="images/logo.jpg" class="img-responsive">
				</a>
			</div>
			<div class="col-md-8 col-xs-12">
				<nav class="nav-header">
					<ul class="nav-menu-list" id="nav-toggle-open">
						<li><a id="home" href="index.php">Home</a></li>
						<li class="dropdown">
							<a id="product" href="<?php echo base_url; ?>product.php">Products</a>
							<div class="nav-open-icon">
								<i class="fa fa-angle-right"></i>
							</div>
							<ul class="dropdown-content">
								<li>
									<a href="<?php echo base_url; ?>product.php">Products A
										<i class="fa fa-long-arrow-right"></i>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url; ?>product.php">Products B
										<i class="fa fa-long-arrow-right"></i>
									</a>
								</li>
								<li>
									<a href="<?php echo base_url; ?>product.php">Products C
										<i class="fa fa-long-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>
						<li><a id="project" href="<?php echo base_url; ?>project.php">Projects</a></li>
						<li><a id="news" href="<?php echo base_url; ?>news.php">News & Events</a></li>
						<li><a id="testimonial" href="<?php echo base_url; ?>testimonial.php">Testimonials</a></li>
						<li><a id="stores" href="<?php echo base_url; ?>stores.php">Stores</a></li>
						<li><a id="about" href="<?php echo base_url; ?>about.php">About</a></li>
						<li><a id="contact" href="<?php echo base_url; ?>contact.php">Contact</a></li>
					</ul>
				</nav>
			</div>
			<div class="col-lg-2 col-md-2 menu-right">
				<div id="toggle-menu">
					<a class="nav-toggle" href="javascript:void(0)">
						<span></span>
					</a>
				</div>

				<form action="#" method="#" class="form-search">
					<input type="" name="" class="search-input">
					<a href="javascript:void(0)" class="open-search">
						<i class="fa fa-search"></i>
					</a>
				</form>
			</div>
		</div>
	</div>
</header>

<form id="<?php echo $_SERVER['REQUEST_URI'] === '/prototype/ee072a01604cc3bb78312dedb1a41b0f84ecab8d/' ? 'form-search-head-absolute' : 'form-search'?>" method="get" action="{{url('search')}}" style="z-index:0">
	<div class="container">
		<div class="col-md-12">
			<i class="fa fa-search"></i>
			<input type="text" class="form-control" name="q" placeholder="Search Input">
		</div>
	</div>
</form>