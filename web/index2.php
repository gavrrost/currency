<?php
use App\Model\CurrencyRate;
use App\Model\Currency\Currency;

$container = require __DIR__ . '/../app/bootstrap.php';

$currencyRate = $container->make(CurrencyRate\CurrencyRate::class, [
	'currencyFrom' => new Currency('USD'),
	'currencyTo' => new Currency('USD'),
	]);
var_dump($currencyRate->getCurrencyFrom());
var_dump($currencyRate->getCurrencyTo());
var_dump($currencyRate->getRate());
