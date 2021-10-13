<?php

namespace Bondstein\Helpers;

class User
{

	public static function author(int $author_id): bool
	{
		return $_SESSION['user']['id'] == $author_id ? true : false;
	}

	public static function login(): bool
	{
		return isset($_SESSION['user']) ? true : false;
	}

	public static function role(array $roles): bool
	{
		return in_array($_SESSION['user']['category'], $roles) ? true : false;
	}
}
