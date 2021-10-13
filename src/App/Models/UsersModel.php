<?php

namespace Bondstein\App\Models;

use Bondstein\Classes\Model;
use Bondstein\Classes\DB;
use PDO;
use Bondstein\Helpers\Str;
use Bondstein\Helpers\Site;
use Bondstein\Classes\ValidationException;

class UsersModel extends Model
{

	public function readUser(int $user_id)
	{
		$sql = DB::query()
			->select('id, login_id, username, category')
			->from('users')
			->where('id = :id')
			->get();

		$data = array(
			'id' => $user_id,
		);

		$stmt = $this->db->prepare($sql);
		$this->bind($stmt, $data);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function allUsers(): array
	{
		$sql = DB::query()
			->select('id, login_id, username, category')
			->from('users')
			->orderBy('id DESC')
			->get();

		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function createUser(array $user, string $redirect_page): void
	{
		Str::validate($user['login_id'], true, 25);
		Str::validate($user['username'], true, 255);
		Str::validate($user['password'], true, 255);

		$username     = Str::clean($user['username']);
		$login_id    = Str::clean($user['login_id']);
		$user_password = password_hash($user['password'], PASSWORD_DEFAULT);
		$category     = $user['category'];

		if (!empty($login_id)) {
			$sql = DB::query()
				->select('login_id')
				->from('users')
				->where('login_id = :login_id')
				->get();

			$data = array(
				'login_id' => $login_id,
			);

			$stmt = $this->db->prepare($sql);
			$this->bind($stmt, $data);
			$stmt->execute();

			if (!empty($stmt->fetch(PDO::FETCH_ASSOC))) {
				$errors[] = 'Login id already exists.';
				throw new ValidationException($errors);
			}
		}

		$sql = DB::query()
			->insertInto('users (login_id , username, password, category)')
			->values('( :login_id, :username, :password, :category )')
			->get();

		$data = array(
			'login_id'    => $login_id,
			'username'     => $username,
			'password' => $user_password,
			'category'     => $category,
		);

		$stmt = $this->db->prepare($sql);
		$this->bind($stmt, $data);
		$stmt->execute();
		$_SESSION['notification'] = [
			'status' => 'success',
			'seen' => 0,
			'message' => [
				'User created.'
			]
		];
		Site::redirect($redirect_page);
	}

	public function signIn(array $user): void
	{
		Str::validate($user['login_id'], true, 25);
		Str::validate($user['password'], true, 255);

		$login_id     = Str::clean($user['login_id']);
		$user_password = Str::clean($user['password']);

		$sql = DB::query()
			->select('id, login_id, username, password, category')
			->from('users')
			->where('login_id = :login_id')
			->get();

		$data = array(
			'login_id' => $login_id,
		);

		$stmt = $this->db->prepare($sql);
		$this->bind($stmt, $data);
		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if (!empty($user)) {
			if (password_verify($user_password, $user['password'])) {
				$_SESSION['user']['id']    = $user['id'];
				$_SESSION['user']['login_id']  = $user['login_id'];
				$_SESSION['user']['username']  = $user['username'];
				$_SESSION['user']['category']  = $user['category'];
				$_SESSION['notification']  = [];

				Site::redirect('/users/index');
			} else {
				$errors[] = 'Invalid password';
			}
		} else {
			$errors[] = 'User does not exist';
		}

		if (!empty($errors)) {
			throw new ValidationException($errors);
		}
	}

	public function signOut($redirect = '/'): void
	{
		$_SESSION = [];
		session_unset();

		Site::redirect($redirect);
	}
}
