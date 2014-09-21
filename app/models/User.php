<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;
	protected $fillable = array(
		'name',
		'email',
		'telephone',
		'password',
		'key'
	);
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public static function getValidationRules()
	{
		return [
			'email' => 'required|email|max:50',
			'password' => 'required|min:3',
		];
	}

	public static function getValidationRulesSignup()
	{
		return [
			'name' => 'required|max:50',
			'email' => 'required|email|max:50|unique:users',
			'telephone' => 'max:25',
			'password' => 'required|min:3|confirmed',
			
		];
	}

	public static function findByEmail($email)
	{
		return User::where("email", $email)->first();
	}

	public function checkPassword($password)
	{
		return $this->password == $password;
	}

	public function isActive()
	{
		return $this->active == 1;
	}

}
