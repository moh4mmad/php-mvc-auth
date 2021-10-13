<?php

namespace Bondstein\Classes;

abstract class Controller
{

	private $route  = [];
	private $args   = 0;
	private $params = [];

	function __construct()
	{
		$this->route = explode('/', URI);
		$this->args  = count($this->route);
		$this->router();
	}

	/**
	 * Index
	 */
	abstract function index();

	/**
	 * Router
	 */
	private function router(): void
	{
		if (class_exists($this->route[1])) {
			if ($this->args >= 3) {
				if (method_exists($this, $this->route[2])) {
					$this->uriCaller(2, 3);
				} else {
					$this->uriCaller(0, 2);
				}
			} else {
				$this->uriCaller(0, 2);
			}
		} else {
			if ($this->args >= 2) {
				if (method_exists($this, $this->route[1])) {
					$this->uriCaller(1, 2);
				} else {
					$this->uriCaller(0, 1);
				}
			} else {
				$this->uriCaller(0, 1);
			}
		}
	}

	/**
	 * UriCaller
	 */
	private function uriCaller(int $method, int $param): void
	{
		for ($i = $param; $i < $this->args; $i++) {
			$this->params[$i] = $this->route[$i];
		}

		if ($method === 0) {
			call_user_func_array(array($this, 'index'), $this->params);
		} else {
			call_user_func_array(array($this, $this->route[$method]), $this->params);
		}
	}

	/**
	 * View
	 */
	public function view(string $path, array $data = []): void
	{
		if (is_array($data)) {
			extract($data);
		}

		require(ROOT . '/src/App/views/header.php');
		require(ROOT . '/src/App/views/' . $path . '.php');
		require(ROOT . '/src/App/views/footer.php');
	}
}
