<?php

namespace Bondstein\Helpers;

use Bondstein\Classes\ValidationException;

class Str
{
	public static function clean(string $value, bool $tags = true): string
	{
		$value = trim($value);
		$value = stripslashes($value);

		if ($tags === true) {
			$value = strip_tags($value);
			$value = htmlspecialchars($value);
		}

		return $value;
	}

	public static function validate(string $value, bool $required = false, int $length = 0): void
	{
		if ($required === true) {
			if (empty($value)) {
				$errors[] = 'Required field is empty.';
			}
		}

		if ($length !== 0) {
			if (mb_strlen($value, 'utf-8') > $length) {
				$errors[] = 'String is too large.';
			}
		}

		if (!empty($errors)) {
			throw new ValidationException($errors);
		}
	}
}
