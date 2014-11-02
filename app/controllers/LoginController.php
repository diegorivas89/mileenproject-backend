<?php 

use Illuminate\Support\MessageBag;

/**
*
*/
class LoginController extends BaseController
{
	function __construct()
	{
		# code...
	}

	public function getLogin()
	{
		if (Auth::guest()){
			return View::make('login.index');
		}

		return Redirect::route('properties.index');
	}

	public function postLogin()
	{
		$validator = Validator::make(Input::all(), User::getValidationRules());

		if ($validator->fails())
		{
			return Redirect::route('login.get')->withInput()->withErrors($validator);
		}else{
			$user = User::findByEmail(Input::get('email'));
			if ($user && $user->checkPassword(Input::get('password')) && $user->isActive()){
				Auth::login($user);

				if (Input::has('uri')){
					return Redirect::to(urldecode(Input::get('uri')));
				}else{
					return Redirect::route('properties.index');
				}
			}
		}

		$errors = new MessageBag();
		$errors->add('password', 'La contraseña o el usuario es incorrecto');

		return Redirect::route('login.get')->withErrors($errors)->withInput();
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}

?>