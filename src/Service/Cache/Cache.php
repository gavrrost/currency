<?php
namespace App\Service\Cache;

interface Cache
{
	public function get( $key );
	public function set( $key, $value, $duration );
	public function delete( $key );
}
