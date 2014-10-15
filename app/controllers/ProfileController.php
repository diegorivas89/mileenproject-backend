<?php

class ProfileController extends BaseController{

	public function show()
	{
		return View::make('profile.show')->with('user', App::make('logged-user'));
	}

	public function edit()
	{
		return View::make('profile.edit')->with('user', App::make('logged-user'));
	}

	public function update()
	{
		$validator = Validator::make(Input::all(), User::getValidationRulesEditProfile());

		if ($validator->fails())
		{
			return Redirect::route('profile.edit')->withInput()->withErrors($validator);
		}else{
			$user = app::make('logged-user');

			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->telephone = Input::get('telephone');
			$user->password = User::hashPassword(Input::get('password'), Input::get('email'));
			$user->save();

			Auth::login($user);

			return Redirect::route('properties.index');
		}
	}

	public function delete()
	{
		$user = App::make('logged-user');
		foreach ($user->getProperties() as $property) {
			$property->deleteImages();
			$property->delete();
		}

		$user->delete();

		return Redirect::route('login.get');
	}
}

?>