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
			'user_id',
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
		}
	}

	public function sendMessage($parameters = Array())
	{
		echo "Name: {$parameters['name']}
Email: {$parameters['email']}
Subject: {$parameters['subject']}
Message: {$parameters['message']}";
	}
}

?>