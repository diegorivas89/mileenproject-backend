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
		var_dump(Input::all());
	}
}

?>