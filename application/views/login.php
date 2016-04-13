<?php
$this->load->library('session');
$this->load->helper('url');
?>
<section class="module">

	<div class="container">

		<div class="row">
		<form id="login-form" role="form" novalidate="" method="POST" action="<?php echo base_url('/auth/login');?>">

			<div class="col-sm-8 col-sm-offset-2">

				<h4 class="font-alt m-t-0 m-b-0">Admin Login</h4>
				<hr class="divider-w m-t-10 m-b-20">
				<div class="form-group">
				<label class="sr-only" for="email">Email</label>
					<input style='text-transform:none;' class="form-control input-lg" type="text" placeholder="Email" required="" data-validation-required-message="Please enter your Email." aria-invalid="false" name='email'>
								<p class="help-block text-danger"></p>
				</div>
				<div class="form-group">
				<label class="sr-only" for="password">Password</label>
					<input style='text-transform:none;' class="form-control input-lg" type="password" placeholder="Password" required="" data-validation-required-message="Please enter your password." aria-invalid="false" name='password'>
								<p class="help-block text-danger"></p>
				</div>
				<p class="help-block text-danger"><?php if (isset($login_error)) echo $login_error;?></p>
	<button type="submit" class="btn btn-round btn-g">Submit</button>
			</div>
</form>
		</div>

	</div>

</section>
		<!-- / COMPONENTS  -->