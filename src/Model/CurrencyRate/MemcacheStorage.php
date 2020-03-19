<?php
namespace App\Model\CurrencyRate;

use App\Model\CurrencyRate;
use App\Service\Cache\Cache;
use App\Model\Currency\Currency;

class MemcacheStorage implements CurrencyRate\Storage
{
	private $currencyRateStorage;
	private $cache;
	function __construct( CurrencyRate\Storage $currencyRateStorage, Cache $cache )
	{
		$this->currencyRateStorage = $currencyRateStorage;
		$this->cache = $cache;
	}
	public function get( Currency $currencyFrom, Currency $currencyTo )
	{
		$rate = $this->cache->get( $this->buildKey( $currencyFrom, $currencyTo ) );
		if( $rate === false ) {
			$rate = $this->currencyRateStorage->get( $currencyFrom, $currencyTo );
			if( $rate !== false ) {
				$this->save( $currencyFrom, $currencyTo, $rate );
			}
		}
		return $rate;
	}
	public function save( Currency $currencyFrom, Currency $currencyTo, float $rate )
	{
		$this->cache->set( $this->buildKey( $currencyFrom, $currencyTo ), $rate, 10 );
	}
	private function buildKey( Currency $currencyFrom, Currency $currencyTo )
	{
		return 'currencyRate:' . $currencyFrom->getCode() . ':' . $currencyTo->getCode();
	}
}
