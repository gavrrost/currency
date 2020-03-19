<?php
namespace App\Model\CurrencyRate;

use App\Model\CurrencyRate\Storage;
use App\Model\CurrencyRate\NotFoundException;
use App\Model\Currency\Currency;

class CurrencyRate
{
	private $currencyFrom;
	private $currencyTo;
	private $rate;
	public function __construct( Storage $storage, Currency $currencyFrom, Currency $currencyTo )
	{
		$this->currencyFrom = $currencyFrom;
		$this->currencyTo = $currencyTo;
		$rate = $storage->get($currencyFrom, $currencyTo);
		if( $rate === false ) {
			throw new NotFoundException("Курс для валют {$currencyFrom->getCode()}->{$currencyTo->getCode()} не найдена", 1);
		}
		$this->rate = $rate;
	}

	public function getCurrencyFrom()
	{
		return $this->currencyFrom;
	}

	public function getCurrencyTo()
	{
		return $this->currencyTo;
	}

	public function getRate()
	{
		return $this->rate;
	}

}
