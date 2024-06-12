<?php

namespace App\Exceptions;

class CouldNotGetResultFromApiException extends \Exception
{
    public static function create(int $invalidResponseStatus, string $message): self
	{
		return new static("A call to the external exchange rates API was unsuccessful. Status: " . $invalidResponseStatus . ". Message: " . $message . ".");
	}
}