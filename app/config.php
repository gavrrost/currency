<?php
use App\Model\CurrencyRate;
use App\Service\Cache;
use App\Service\DB;
use function DI\create;

return [
	Cache\Cache::class => DI\get(Cache\MemcacheCacheClient::class),

	DB\DBConnection::class => DI\get(DB\MySQLConnection::class),

	CurrencyRate\Storage::class => function ($container) {
		$dummyStorage = new CurrencyRate\DummyStorage();
		$externalStorage = $container->make(CurrencyRate\ExternalStorage::class, [
			'currencyRateStorage' => $dummyStorage,
		]);
		$dbStorage = $container->make(CurrencyRate\DBStorage::class, [
			'currencyRateStorage' => $externalStorage,
		]);
		$memcacheStorage = $container->make(CurrencyRate\MemcacheStorage::class, [
			'currencyRateStorage' => $dbStorage,
		]);
		return $memcacheStorage;
	},
];
