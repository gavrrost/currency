<?php
namespace App\Model\CurrencyRate;

use App\Model\Currency\Currency;

interface Storage
{
	public function get( Currency $currencyFrom, Currency $currencyTo );
	public function save( Currency $currencyFrom, Currency $currencyTo, float $rate );
}
