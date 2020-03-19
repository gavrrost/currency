<?php
namespace App\Model\CurrencyRate;

use App\Model\CurrencyRate;
use App\Service\DB\DBConnection;
use App\Model\Currency\Currency;

class DBStorage implements CurrencyRate\Storage
{
	private $currencyRateStorage;
	private $dbConnection;
	function __construct( CurrencyRate\Storage $currencyRateStorage, DBConnection $dbConnection )
	{
		$this->currencyRateStorage = $currencyRateStorage;
		$this->dbConnection = $dbConnection;
	}
	public function get( Currency $currencyFrom, Currency $currencyTo )
	{
		$rate = $this->dbConnection->selectFirst(
			'currencyRate',
			[
				[ 'code_from', $currencyFrom->getCode() ],
				[ 'code_to', $currencyTo->getCode() ],
			],
			['rate']
		);
		if( $rate === false ) {
			$rate = $this->currencyRateStorage->get( $currencyFrom, $currencyTo );
			if( $rate !== false ) {
				$this->save( $currencyFrom, $currencyTo, $rate );
			}
		} else {
			$rate = (float)$rate['rate'];
		}
		return $rate;
	}
	public function save( Currency $currencyFrom, Currency $currencyTo, float $rate )
	{
		$this->dbConnection->insert(
			'currencyRate', [
			'code' => $currencyFrom->getCode(),
			'code' => $currencyTo->getCode(),
			'rate' => $rate,
		]);
	}
}
