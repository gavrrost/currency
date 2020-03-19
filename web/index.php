<?php
use App\Service\DB\MySQLConnection;
use App\Service\Cache\MemcacheCacheClient;
use App\Model\CurrencyRate;
use App\Model\Currency\Currency;

require __DIR__ . '/../vendor/autoload.php';


$currencyRate = new CurrencyRate\CurrencyRate(
	new CurrencyRate\MemcacheStorage(
		new CurrencyRate\DBStorage(
			new CurrencyRate\ExternalStorage(
				new CurrencyRate\DummyStorage()
			),
			new MySQLConnection()
		),
		new MemcacheCacheClient()
	),
	new Currency('RUB'),
	new Currency('USD')
);

var_dump($currencyRate->getCurrencyFrom());
var_dump($currencyRate->getCurrencyTo());
var_dump($currencyRate->getRate());
