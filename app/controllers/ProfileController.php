<?php

class ProfileController extends BaseController{

	public function edit()
	{
		return View::make('profile.edit')->with('user', App::make('logged-user'));
	}

	public function update()
	{

	}
}

?>