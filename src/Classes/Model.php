<?php

namespace Bondstein\Classes;


abstract class Model
{

	protected $db;

	function __construct()
	{
		global $app;
		$this->db = $app->db;
	}

	public function bind(object $stmt, array $data): void
	{
		foreach ($data as $key => $value) {
			$stmt->bindValue(':' . $key, $value);
		}
	}
}
