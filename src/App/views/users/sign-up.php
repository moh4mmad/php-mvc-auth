<section class="card mt-3 mb-3">
	<div class="card-body">
		<h1 class="card-title">Sign Up</h1>

		<?= Bondstein\Helpers\Notifications::error($errors); ?>

		<form action="" method="POST">
			<div class="form-group">
				<label for="login_id">Login Id</label>
				<input type="text" name="login_id" id="login_id" class="form-control" max="25" required>
			</div>

			<div class="form-group">
				<label for="username">Name</label>
				<input type="text" name="username" id="username" class="form-control" max="255" required>
			</div>

			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password" class="form-control" max="255" required>
			</div>

			<button type="submit" name="sign-up" class="btn btn-success">Sign Up</button>
			<a href="/users/sign_in" class="btn btn-info">Sign In</a>
		</form>
	</div>
</section>