<section class="module">
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
				<?phpif(isset($_SESSION['userid'])) {?>
					<!-- CONTENT BOXES -->
				<h4 class="font-alt m-t-0 m-b-0">User Info</h4>
				<hr class="divider-w m-t-10 m-b-20">
				<?} else {?>
				Please Login to view your info.
				<?}?>				
			</div>

		</div>

	</div>

</section>