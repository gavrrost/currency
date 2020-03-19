<?php
namespace App\Model\CurrencyRate;

use App\Model\CurrencyRate;
use App\Model\Currency\Currency;

class DummyStorage implements CurrencyRate\Storage
{
	public function __construct()
	{
	}
	public function get( Currency $currencyFrom, Currency $currencyTo )
	{
		return false;
	}
	public function save( Currency $currencyFrom, Currency $currencyTo, float $rate )
	{
	}
}
