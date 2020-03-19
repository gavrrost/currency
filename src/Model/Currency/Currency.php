<?php
namespace App\Model\Currency;

class Currency {
	private $code;
	public function __construct( string $code )
	{
		$this->code = $code;
	}
	public function getCode()
	{
		return $this->code;
	}
}