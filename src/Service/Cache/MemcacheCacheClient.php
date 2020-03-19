<?php
namespace App\Service\Cache;

use App\Service\Cache\Cache;

class MemcacheCacheClient implements Cache
{
	private $storage;
	public function __construct()
	{
		$this->storage = [];
		// $this->storage = new Memcache(...);
	}

	public function get( $key )
	{
		return array_key_exists($key, $this->storage) ? $this->storage[ $key ] : false ;
		// return $this->storage->get( $key );
	}

	public function set( $key, $value, $duration )
	{
		$this->storage[$key] = $value;
		// $this->storage->set( $key, $value, false, $duration );
	}

	public function delete( $key )
	{
		unset($this->storage[$key]);
		// $this->storage->delete( $key );
	}

}
