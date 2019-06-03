<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	public function login_view()
	{
		return view('authentication.login');
	}

	public function login(Request $request)
	{

	}
}
