<?php 

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
			if ($user && $user->password == Input::get('password')){
				Auth::login($user);

				return Redirect::route('properties.index');
			}
		}

		return Redirect::route('login.get')->withInput();
	}
}

?>