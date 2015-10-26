<?php

class QueryBuilder
{
	public $sql;
	public $parameters = [];

	public function execute()
	{
		global $db;
		$stmt = $db->prepare($this->sql);
		$stmt->execute($this->parameters);
		return [];
	}
}