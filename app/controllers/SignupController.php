<?php 

/**
*
*/
class SignupController extends BaseController
{
	function __construct()
	{
		# code...
	}

	public function getSignup()
	{
		return View::make('signup.index');
	}

	public function postSignup()
	{

	}

}

?>