<?php
	require_once('db/db.php');
	require_once('Utils.php');
	require_once('QueryBuilder.php');

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

		// Select data
		$query = new QueryBuilder();
		$query->sql = Utils::GetBaseSQL();
		$query->sql .= ' WHERE h.exchange = ?';
		$query->parameters[] = $e;
		$query->execute();

		// Format it
		HandleFormat();
	}
	else if (Utils::IsGetVariableNotEmpty('s'))
	{
		// Symbol(s)
		$s = $_GET['s'];

		// Select data
		$query = new QueryBuilder();
		$query->sql = Utils::GetBaseSQL();
		$query->sql .= ' WHERE h.symbol in (?)';
		$query->parameters[] = $s;

		// Timeframe
		HandleTimeframe($query);
		$query->sql .= ' ORDER BY h.symbol, h.quote_date desc';

		$query->execute();

		// Format it
		HandleFormat();
	}
	else if (Utils::IsGetVariableNotEmpty('dump'))
	{
		// Get all stock info
		$query = new QueryBuilder();
		$query->sql = Utils::GetBaseSQL();
		// run 2 queries, 1 per table and return an arrays

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

function HandleTimeframe(QueryBuilder $query)
{
	if (!Utils::IsGetVariableNotEmpty('t'))
	{
		return;
	}

	// Parse time frame
	$t = $_GET['t'];

	if (is_numeric($t))
	{
		// t is number of days in the past (days of data, exclude days when market is closed, 1 = last day of data available)
		$query->sql = str_replace('SELECT', "SELECT TOP $t", $query->sql);
		return;
	}
	
	if (Utils::IsDateValid($t))
	{
		// t is single date
		$query->sql = Utils::WhereOrAnd($query->sql, 'quote_date = ?');
		$query->parameters[] = $t;
		return;
	}

	if (strpos($t, ',') !== false)
	{
		$t = explode(',', $t);
		if (count($t) != 2 || !Utils::IsDateValid($t[0]) || !Utils::IsDateValid($t[1]))
		{
			// t has invalid components
			return;
		}

		// t is comma-separated date range
		$query->sql = Utils::WhereOrAnd($query->sql, 'quote_date between ? and ?');
		$query->parameters[] = $t[0];
		$query->parameters[] = $t[1];
		return;
	}
	
	// t is invalid
	return;
}

function HandleFormat()
{
	if (!Utils::IsGetVariableNotEmpty('f'))
	{
		return;
	}

	// Format output
	$f = strtolower($_GET['f']);
	if ($f == 'json')
	{

	}
	else if ($f == 'zip')
	{

	}

	// invalid format
}