<?php
$this->load->library('session');
$this->load->helper('url');
?>
<section class="module">

	<div class="container">

		<div class="row">
		<form id="login-form" role="form" novalidate="" method="POST" action="<?php echo base_url('/profile');?>">

			<div class="col-sm-8 col-sm-offset-2">

				<h4 class="font-alt m-t-0 m-b-0">User Profile</h4>
				<hr class="divider-w m-t-10 m-b-20">
				<div class="form-group">
				<label class="sr-only" for="email">Email</label>
					<input style='text-transform:none;' class="form-control input-lg" type="text" placeholder="Email" required="" data-validation-required-message="Please enter your Email." aria-invalid="false" name='email' value="<?php echo  $profile[0]->email?>">
								<p class="help-block text-danger"></p>
				</div>
				<div class="form-group">
				<label class="sr-only" for="full_name">Full Name</label>
					<input value="<?php echo $profile[0]->full_name?>" style='text-transform:none;' class="form-control input-lg" type="text" placeholder="Full Name" required="" data-validation-required-message="Please enter your full name." aria-invalid="false" name='full_name'>
								<p class="help-block text-danger"></p>
					<select class='status' name='status' value="<?php echo $profile[0]->status?>">
						<?php foreach($statuses as $value) {
							echo "<option value=".$value->status.">".$value->status."</option>";
						}?>
					</select>								
				</div>
				<p class="help-block text-danger"><?php if (isset($save_error)) echo $save_error;?></p>
	<button type="submit" class="btn btn-round btn-g">Submit</button>
			</div>
</form>
		</div>

	</div>

</section>
		<!-- / COMPONENTS  -->