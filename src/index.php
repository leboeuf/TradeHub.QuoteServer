<?php
	require_once('db/db.php');
	require_once('Utils.php');

	// Check if the database structure exists, create it otherwise
	require_once('db/db_create_schema.php');

	// Possible GET parameters:
	// e = exchange
	// s = symbols (comma-separated)
	// t = date or date range or number of days in the past
	// f = format (JSON or ZIP)
	// stats = returns database statistics in JSON format
	// dump = returns a ZIP file containing all of the historical data for every stock in the database
	if (Utils::IsGetVariableNotEmpty('e'))
	{
		// Exchange
		$e = $_GET['e'];

		if (Utils::IsGetVariableNotEmpty('t'))
		{
			// Parse time frame
			$t = $_GET['t'];

		}

		// Get all stocks data for this exchange (if t is not set, only fetch active stocks)
		// 'SELECT h.*, s.name FROM historical h 
		// 		INNER JOIN symbols s ON (h.symbol = s.symbol AND h.exchange = s.exchange) 
		//		WHERE exchange = ?'
		// 'AND quote_date = ?' // t or date('Y-m-d');
		// 'AND quote_date BETWEEN ? AND ?'

		// Format it

		if (Utils::IsGetVariableNotEmpty('f'))
		{
			// Format output
			$f = $_GET['f'];
		}
	}
	else if (Utils::IsGetVariableNotEmpty('s'))
	{
		// Split
		$s = $_GET['s'];

		// Select data
		$sql = Utils::GetBaseSQL();
		$sql .= ' WHERE h.symbol in (?)';
		$sql = HandleTimeframe($sql);
		$sql .= ' ORDER BY h.symbol, h.quote_date desc';
		//print_r($sql);

		// Format it

		if (Utils::IsGetVariableNotEmpty('f'))
		{
			// Format output
			$f = $_GET['f'];
		}

	}
	else if (Utils::IsGetVariableNotEmpty('dump'))
	{
		// Get all stock info

		// Format it

		// ZIP it

	}
	else if (Utils::IsGetVariableNotEmpty('stats'))
	{
		// Get number of active stocks (rowcount of symbols table) grouped by exchange

		// Get rowcount of historical table

		// Get number of delisted stocks (symbols that are present in historical but not in symbols)

		// Format it
		
	}

function HandleTimeframe($sql)
{
	if (!Utils::IsGetVariableNotEmpty('t'))
	{
		return $sql;
	}

	// Parse time frame
	$t = $_GET['t'];

	if (is_numeric($t))
	{
		// t is number of days in the past (days of data, exclude days when market is closed, 1 = last day of data available)
		// SELECT top t
		$sql = str_replace('SELECT', "SELECT TOP $t", $sql);
		return $sql;
	}
	
	if (Utils::IsDateValid($t))
	{
		// t is single date
		// quote_date = ?
		$sql = Utils::WhereOrAnd($sql, 'quote_date = ?');
	}

	// t is date range 'quote_date between ? and ?'
	
	// otherwise: t is invalid

	// if sql contains 'WHERE' add 'AND' else add 'WHERE'

	return $sql;
}