<section class="card mt-3 mb-3">

    <div class="card-body">
        <div class="row">
            <div class="col-lg-3 col-sm-12">
                <?php if (Bondstein\Helpers\User::role(array('admin'))) : ?>
                    <a href="/users/create" class="btn btn-success btn-block">New user</a>
                    <a href="/users" class="btn btn-primary btn-block">Home</a>
                <?php endif; ?>
                <?php if (Bondstein\Helpers\User::author($user['id'])) : ?>
                    <a href="/users/sign_out" class="btn btn-outline-danger btn-block">Sing Out</a>
                <?php endif; ?>
            </div>

            <div class="col-lg-9 col-sm-12">

                <?php if (!empty($users)) : ?>
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Sl.</a></th>
                                <th>Login Id</a></th>
                                <th>Name</th>
                                <th>Category</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($users as $key => $user) : ?>
                                <tr>
                                    <td> <?= $key + 1 ?> </td>
                                    <td><?= $user['login_id'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['category'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else : ?>
                    <div class="alert alert-warning mb-0">Empty.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>