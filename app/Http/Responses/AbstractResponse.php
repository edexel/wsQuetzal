<?php

/**
 * Created by Jesus sanchez
 * Date: 08 May 2018
 */

namespace App\Http\Responses;

class AbstractResponse
{
	public $status;
	public $data;
	public $message;

	public function __construct()
	{
		$this->status = true;
	}
}
