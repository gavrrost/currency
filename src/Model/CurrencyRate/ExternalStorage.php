<?php
namespace App\Model\CurrencyRate;

use App\Model\CurrencyRate;
use App\Model\Currency\Currency;

class ExternalStorage implements CurrencyRate\Storage
{
	private $currencyRateStorage;
	function __construct( CurrencyRate\Storage $currencyRateStorage )
	{
		$this->currencyRateStorage = $currencyRateStorage;
	}
	public function get( Currency $currencyFrom, Currency $currencyTo )
	{
		return 0.5;
	}
	public function save( Currency $currencyFrom, Currency $currencyTo, float $rate )
	{

	}
}
