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
			Input::merge(array('key' => User::generateActivationKey(Input::get('email'))));
			Input::merge(array('password' => User::hashPassword(Input::get('password'), Input::get('email'))));

			$newUser = User::create(Input::all());

			$data = array(
				'email'		=> Input::get('email'),
				'clickUrl'	=> URL::route('signup.activation', array('code'=> urlencode($newUser->key))),
				'name' => Input::get('name')
			);

			try {
				Mail::send('signup.confirmationEmail', $data, function($message) {
					$message->to( Input::get('email') )->subject('Bienvenido a MiLEEM!');
				});

				return Redirect::route('login.get')->with('activation-message', 'Se ha enviado un email a su correo electrónico con las instrucciones para activar su cuenta');
			} catch (Exception $e) {
				$newUser->delete();

				return Redirect::route('signup.get')->with('technical-problems', 'Lo sentimos, por problemas técnicos no podemos crear su cuenta. Vuelva a intentarlo mas tarde.');
			}
		}
	}
}

?>