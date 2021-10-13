<section class="card mt-3 mb-3">
	<div class="card-body">
		<h1 class="card-title">Sign In</h1>

		<?= Bondstein\Helpers\Notifications::success(); ?>
		<?= Bondstein\Helpers\Notifications::error($errors); ?>

		<form action="" method="POST">
			<div class="form-group">
				<label for="login_id">Login Id</label>
				<input type="text" name="login_id" id="login_id" class="form-control" max="25" required>
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control" max="255" required>
			</div>

			<button type="submit" name="sign-in" class="btn btn-primary">Sign In</button>
			<a href="/users/sign_up" class="btn btn-info">Sign Up</a>
		</form>
	</div>
</section>