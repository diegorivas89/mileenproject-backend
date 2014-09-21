<?php 

use Illuminate\Mail\Mailer;

class SignupController extends BaseController {

	function __construct() {
		# code...
	}

	public function activation($code){
		if ( $user = User::where('key', '=', $code)->first()) {
			$user->active = 1;
			$user->save();
			Auth::login( $user );
			
			return Redirect::route('properties.index');
		
		} else {
			return Redirect::route('login.get');		
		}
	}

	public function getSignup() {
		return View::make('signup.index');
	}

	public function postSignup() {
		$validator = Validator::make(Input::all(), User::getValidationRulesSignup());
		if ($validator->fails()) {
			return Redirect::route('signup.get')->withInput()->withErrors($validator);
		}else{
			$email = Input::get('email');
			$newcode = md5( time()+ Input::get('email') + rand(48, 57));
			Input::merge(array('key' => $newcode));
			$newUser = User::create(Input::all());
			$data = array(
				'email'		=> $email,
				'clickUrl'	=> URL::route('signup.activation', array('code'=> urlencode($newcode))),
				'name' => Input::get('name')
			);
			Mail::send('signup.confirmationEmail', $data, function($message) {
				$message->to( Input::get('email') )->subject('Bienvenido a MiLEEM!');
			});

			return Redirect::route('login.get');
		}
	}

}

?>