<?php

namespace Bondstein\Helpers;

class Site
{


	public static function redirect(string $location): void
	{
		header('Location: ' . $location);
	}

	public static function title($title, string $separator = '#'): string
	{
		$name = 'Bondstein';

		if (!empty($title)) {
			$title = $title . ' ' . $separator . ' ' . $name;
		} else {
			$title = $name;
		}

		return $title;
	}

	public static function version(): string
	{
		$version = '0.0.0';

		if (file_exists('version.json')) {
			$json    = file_get_contents('version.json');
			$obj     = json_decode($json);
			$version = $obj->version;
		}

		return $version;
	}
}
