<section class="card mt-3 mb-3">

    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <?php if (Bondstein\Helpers\User::role(array('admin'))) : ?>
                    <a href="/users" class="btn btn-success btn-block">Home</a>
                    <a href="/users/all" class="btn btn-primary btn-block">All users</a>
                <?php endif; ?>
                <?php if (Bondstein\Helpers\User::author($user['id'])) : ?>
                    <a href="/users/sign_out" class="btn btn-outline-danger btn-block">Sing Out</a>
                <?php endif; ?>
            </div>

            <div class="col-lg-9 col-sm-12">
                <?= Bondstein\Helpers\Notifications::success(); ?>
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

                    <div class="form-group">
                        <label for="category">Select category</label>
                        <select class="form-control" id="category" name="category" required>
                            <option selected disabled>Select category</option>
                            <option value="customer">Customer</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <button type="submit" name="new_user" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>