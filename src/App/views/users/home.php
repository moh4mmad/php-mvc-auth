<section class="card mt-3 mb-3">

	<div class="card-body">
		<?php if (!empty($user)) : ?>
			<div class="row">
				<div class="col-lg-3 col-sm-12">
					<?php if (Bondstein\Helpers\User::role(array('admin'))) : ?>
						<a href="/users/create" class="btn btn-success btn-block">New user</a>
						<a href="/users/all" class="btn btn-primary btn-block">All users</a>
					<?php endif; ?>
					<?php if (Bondstein\Helpers\User::author($user['id'])) : ?>
						<a href="/users/sign_out" class="btn btn-outline-danger btn-block">Sing Out</a>
					<?php endif; ?>
				</div>

				<div class="col-lg-9 col-sm-12">
					<h1 class="card-title">Welcome <?= $user['username']; ?>,</h1>

					<p class="card-text">Your role is <?= $user['category']; ?></p>
				</div>
			</div>
		<?php else : ?>
			<div class="alert alert-warning mb-0">User does not exist.</div>
		<?php endif; ?>
	</div>
</section>