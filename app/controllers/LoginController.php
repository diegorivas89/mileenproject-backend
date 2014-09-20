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
		return View::make('login.index');
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

				return Redirect::route('properties.index');
			}
		}

		$errors = new MessageBag();
		$errors->add('password', 'La contraseña es incorrecta');

		return Redirect::route('login.get')->withErrors($errors)->withInput();
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
}

?>