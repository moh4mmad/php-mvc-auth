<?php

namespace Bondstein\Helpers;


class Notifications
{

	public static function success(): void
	{
		$successMsg = isset($_SESSION['notification']) ? $_SESSION['notification'] : [];
		if (!empty($successMsg) && $successMsg['status'] == 'success') : ?>
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php foreach ($successMsg['message'] as $field => $error) : ?>
					<?= $error; ?><br>
				<?php endforeach; ?>
			</div>
		<?php endif;
	}

	public static function error($errors): void
	{
		if (!empty($errors)) : ?>
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<?php foreach ($errors as $field => $error) : ?>
					<?= $error; ?><br>
				<?php endforeach; ?>
			</div>
<?php endif;
	}
}
