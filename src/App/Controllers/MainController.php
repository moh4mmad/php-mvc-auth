<?php

namespace Bondstein\App\Controllers;

use Bondstein\Classes\Controller;
use Bondstein\Helpers\Site;

class MainController extends Controller
{

	public function index()
	{
		Site::redirect('/users/sign_in');
	}
}
