<?php

class Utils
{
	/**
	 * Returns true if $_GET[$key] is set and not empty.
	 */
	public static function IsGetVariableNotEmpty($key)
	{
		return isset($_GET[$key]) && !empty($_GET[$key]);
	}

	/**
	 * Returns the base SELECT statement used by all queries.
	 */
	public static function GetBaseSQL()
	{
		return 'SELECT h.*, s.name FROM historical h INNER JOIN symbols s ON (h.symbol = s.symbol AND h.exchange = s.exchange)';
	}

	/**
	 * Returns whether the date is valid (yyyy-mm-dd format and converts to DateTime).
	 */
	public static function IsDateValid($input)
	{
		if (strlen($input) == 10 && substr_count($input, '-') == 2)
		{
			$d = DateTime::createFromFormat('Y-m-d', $input);
			if ($d && $d->format('Y-m-d') == $input)
				return true;
		}

		return false;
	}

	/**
	 * Appends a condition to a SQL statement using WHERE if not already present or AND otherwise.
	 */
	public static function WhereOrAnd($sql, $condition)
	{
		if (strpos($sql, 'WHERE') === false)
		{
			$sql .= " WHERE $condition";
		}
		else
		{
			$sql .= " AND $condition";
		}

		return $sql;
	}
}