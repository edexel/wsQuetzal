<?php

/**
 * Created by Jesus sanchez
 * Date: 08 May 2018
 */

namespace App\Http\Responses;

class Response
{
	private $oResult;

	public function __construct()
	{
		$this->oResult = new AbstractResponse();
	}

	public function fnResult($bStatus = null, $dcData = null, $sMessage = null)
	{
		$this->oResult->status = $bStatus;
		$this->oResult->data = $dcData;
		$this->oResult->message = $sMessage;

		return $this->oResult;
	}
}
