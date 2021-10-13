<?php

namespace Bondstein;

use Bondstein\App\Controllers\UsersController;
use PDO;
use PDOException;

class AppLoader
{
	private $config = [];
	public $db;

	function __construct()
	{
		define('URI', $_SERVER['REQUEST_URI']);
		define('ROOT', $_SERVER['DOCUMENT_ROOT']);
		$this->config();
	}

	/**
	 * Config
	 */
	public function config(): void
	{
		require_once(ROOT . '/src/config/database.php');
		require_once(ROOT . '/src/config/session.php');

		try {
			$this->db = new PDO(
				$this->config['db']['driver'] . ':host=' . $this->config['db']['host'] . ';dbname=' . $this->config['db']['name'],
				$this->config['db']['username'],
				$this->config['db']['password']
			);

			$this->db->query('SET NAMES utf8');
			$this->db->query('SET CHARACTER_SET utf8_unicode_ci');

			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	/**
	 * Start
	 */
	public function start(): void
	{
		session_name($this->config['session-name']);
		session_start();
		$user = new UsersController();

		$route    = explode('/', URI);
		$method = $route[2] ?? '';

		if (!empty($method) && $route[1] == "users") {
			if ((int)method_exists($user, $method)) {
				$user->$method();
			} else {
				$user->sign_in();
			}
		} else {
			$user->sign_in();
		}
	}
}
