<?php
namespace Mileen\Api;

use \Mileen\Api\Exceptions\MissingParamentersException;
/**
*
*/
class SendMessageService extends MileenApi
{

	function __construct()
	{
		# code...
	}

	public function getRequiredParameters()
	{
		return Array(
			'property_id',
			'name',
			'email',
			'subject',
			'message'
		);
	}

	public function execute($parameters = Array())
	{
		try {
			$this->assertParameters($parameters);

			$this->sendMessage($parameters);
		} catch (MissingParamentersException $e) {
			return $this->buildErrorResponse($e->getMessage());
		} catch (\Exception $e) {
			return $this->buildErrorResponse($e->getMessage());
		}

		return $this->buildResponse(Array());
	}

	public function sendMessage($parameters = Array())
	{
		$property = \Property::find($parameters['property_id']);
		$user = \User::find($property->user_id);

		$emailData = $parameters;
		$emailData['_message'] = $parameters['message'];
		$emailData['user'] = $user;
		$emailData['property'] = $property;

		\Mail::send('emails.user.message', $emailData, function($message) use ($user, $emailData) {
			$message->to($user->email)
					->subject('Tienes un nuevo mensaje!')
					->replyTo($emailData['email'], $emailData['name']);
		});
	}
}

?>