<?php

namespace Bondstein\App\Controllers;

use Bondstein\Classes\Controller;
use Bondstein\Classes\ValidationException;
use Bondstein\Helpers\Site;
use Bondstein\Helpers\User;
use Bondstein\App\Models\UsersModel;

class UsersController extends Controller
{

	private $model;

	public function __construct()
	{
		$this->model = new UsersModel();
	}


	public function index(): void
	{
		if (!User::login()) {
			Site::redirect('/users/sign_in');
		}
		$user = $this->model->readUser($_SESSION['user']['id']);
		$data = array(
			'title' => '@' . $user['username'],
			'user'  => $user,
		);

		$this->view('users/home', $data);
	}


	public function create(): void
	{
		if (!User::login()) {
			Site::redirect('/users/sign_in');
		}

		if (User::role(array('admin'))) {

			$errors = '';




			if (isset($_POST['new_user'])) {
				try {
					$this->model->createUser(array(
						'login_id' => $_POST['login_id'],
						'username' => $_POST['username'],
						'password' => $_POST['password'],
						'category' => $_POST['category'],
					), '/users/create');
				} catch (ValidationException $e) {
					$errors = $e->getError();
				}
			}

			$user = $this->model->readUser($_SESSION['user']['id']);

			$data = array(
				'title'  => 'Create new user',
				'errors' => $errors,
				'user'  => $user,
			);

			$_SESSION['notification'] = [
				'status' => false,
				'message' => []
			];

			$this->view('users/create', $data);
		} else {
			die("No access");
		}
	}


	public function all(): void
	{
		if (!User::login()) {
			Site::redirect('/users/sign_in');
		}

		if (User::role(array('admin'))) {



			$users = $this->model->allUsers();
			$user = $this->model->readUser($_SESSION['user']['id']);

			$data = array(
				'title'      => 'Users',
				'users'      => $users,
				'user'      => $user
			);

			$this->view('users/all', $data);
		} else {
			die("No access");
		}
	}

	public function sign_up(): void
	{

		$errors = '';

		if (User::login()) {
			Site::redirect('/users');
		}

		if (isset($_POST['sign-up'])) {
			try {
				$this->model->createUser(array(
					'login_id' => $_POST['login_id'],
					'username' => $_POST['username'],
					'password' => $_POST['password'],
					'category' => 'customer',
				), '/users/sign_in');
			} catch (ValidationException $e) {
				$errors = $e->getError();
			}
		}

		$data = array(
			'title'  => 'Sign Up',
			'errors' => $errors,
		);

		$this->view('users/sign-up', $data);
	}

	public function sign_in(): void
	{
		$errors = '';

		if (User::login()) {
			Site::redirect('/users/index');
		}

		if (isset($_POST['sign-in'])) {
			try {
				$this->model->signIn([
					'login_id'     => $_POST['login_id'],
					'password' => $_POST['password'],
				]);
			} catch (ValidationException $e) {
				$errors = $e->getError();
			}
		}

		$data = array(
			'title'  => 'Sign In',
			'errors' => $errors,
		);

		$this->view('users/sign-in', $data);
	}


	public function sign_out(): void
	{
		if (User::login()) {
			$this->model->signOut();
		}
	}
}
