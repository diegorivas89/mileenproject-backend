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

	public static function getValidationRulesEditProfile()
	{
		return [
			'name' => 'required|max:50',
			/*'email' => 'required|email|max:50',*/
			'telephone' => 'max:25',
			/*'password' => 'required|min:3',*/
		];
	}

	public static function findByEmail($email)
	{
		return User::where("email", $email)->first();
	}

	public function checkPassword($password)
	{
		return $this->password == self::hashPassword($password, $this->email);
	}

	public function isActive()
	{
		return $this->active == 1;
	}

	public function getSchema()
	{
		return Array(
			'id' => 'int',
			'name' => 'string',
			'email' => 'string',
			'telephone' => 'string',
		);
	}

	public function getProperties()
	{
		return Property::where('user_id', $this->id)->get();
	}

	public static function hashPassword($password, $email)
	{
		return md5($password . $email . "awesome salt string");
	}

	public static function generateActivationKey($email = '')
	{
		return md5(microtime() + $email + rand(0, 999));
	}

}
