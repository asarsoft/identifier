<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	protected $success = false;

	function check_if_email($email)
	{
		$find1 = strpos($email, '@');
		$find2 = strpos($email, '.');
		return ($find1 !== false && $find2 !== false && $find2 > $find1);
	}

	public function view_login()
	{
		return view('authentication.login');
	}

	public function attempt_login(LoginRequest $request)
	{
		$validated = $request->validated();

		if ($this->check_if_email($validated['username_or_email']))
		{
			if (Auth::attempt(['email' => $validated['username_or_email'], 'password' => $validated['password']]))
			{
				$this->success = true;
			}
		}

		elseif (Auth::attempt(['username' => $validated['username_or_email'], 'password' => $validated['password']]))
		{
			$this->success = true;
		}

		//todo return the required response
		return $this->success;
	}
}
