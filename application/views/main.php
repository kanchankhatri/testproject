<?php 
$this->load->library('session');
$this->load->helper('url');
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Semantic - Minimal portfolio template</title>

	<!-- Bootstrap core CSS -->
	<link href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">


	<!-- Plugins -->

	<link href="<?php echo base_url('/assets/css/style.css');?>" rel="stylesheet">


	<!-- Custom css -->

	<link href="<?php echo base_url('/assets/css/custom.css');?>" rel="stylesheet">
</head>
<body>



	<!-- NAVIGATION -->

	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">

		
		<div class="container">

			
			<div class="navbar-header">				
				
				<a class="navbar-brand" href="<?php echo base_url('/home');?>">TestProject</a>

			</div>			
			<div class="collapse navbar-collapse" id="custom-collapse">
				
				<ul class="nav navbar-nav navbar-right">
					
					<li class="dropdown">						
						<a href="<?php echo base_url('/home');?>" >Home</a>											
					</li>
					
					<?php if(isset($_SESSION['userid'])) {?>
						<li class="dropdown">						
							<a href="<?php echo base_url('/profile');?>" >Profile</a>
						</li>
						<li class="dropdown">						
							<a href="<?php echo base_url('/auth/logout');?>" >Logout</a>
						</li>
					<?php } else {?>
					<li class="dropdown">						
						<a href="<?php echo base_url('/auth/login');?>" >Login</a>											
					</li>
					<?php }?>
				</ul>
			</div>
		</div>
	</nav>

	<!-- /NAVIGATION -->


	<!-- WRAPPER -->

	<div class="wrapper">

		<?php foreach($sections as $section){
			echo $section;

		} ?>

		<!-- DIVIDER -->

		<hr class="divider-w">

		<!-- FOOTER -->
		<footer class="footer">


			<div class="container">


				<div class="row">


					<div class="col-sm-12 text-center">

						<p class="copyright font-inc m-b-0">© 2016 <a href="index.html">TestProject</a>, All Rights Reserved.</p>
						<p class="copyright font-inc m-b-0">Developer: <a href="http://kanchan-khatri.strikingly.com">Kanchan Khatri</a></p>

					</div>


				</div>


			</div>


		</footer>

		<!-- /FOOTER -->


	</div>

	<!-- /WRAPPER -->


	<!-- Scroll-up -->

	<div class="scroll-up">

		<a href="#totop"><i class="fa fa-angle-double-up"></i></a>
	</div>


	<!-- Javascript files -->

	<script src="<?php echo base_url('/assets/js/jquery-2.1.3.min.js');?>"></script>

	<script src="<?php echo base_url('/assets/bootstrap/js/bootstrap.min.js');?>"></script>

	<script src="<?php echo base_url('/assets/js/jqBootstrapValidation.js');?>"></script>

	<script src="<?php echo base_url('/assets/js/contact.js');?>"></script>

	<script src="<?php echo base_url('/assets/js/custom.js');?>"></script>

</body>
</html>