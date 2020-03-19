<?php
namespace App\Service\DB;

interface DBConnection
{
	public function insert(string $tableName, array $values);
	public function selectFirst(string $tableName, array $where, array $columns);
}
