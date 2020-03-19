<?php
namespace App\Service\DB;

use App\Service\DB\DBConnection;

class MySQLConnection implements DBConnection
{
	private $connection;
	function __construct()
	{
		$this->connection = [
			'currencyRate' => [
				[
					'code_from' => 'USD',
					'code_to' => 'RUB',
					'rate' => 78,
				],
				[
					'code_from' => 'USD',
					'code_to' => 'BYN',
					'rate' => 20,
				],
			],
		];
	}

	public function insert(string $tableName, array $values)
	{
		if( !isset( $this->connection[ $tableName ] ) ) {
			$this->connection[ $tableName ] = [];
		}
		$this->connection[ $tableName ][] = $values;
	}

	public function selectFirst(string $tableName, array $whereArg, array $columns)
	{
		if( isset( $this->connection[ $tableName ] ) ) {
			$rows = $this->connection[ $tableName ];
			foreach ($rows as $row) {
				if(
					$row[ $whereArg[0][0] ] == $whereArg[0][1] &&
					$row[ $whereArg[1][0] ] == $whereArg[1][1]
				) {
					return array_intersect_key($row, array_flip($columns));
				}
			}
		}
		return false;
	}

}
