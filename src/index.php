<?php
	require_once('db/db.php');
	require_once('Utils.php');

	// Check if the database structure exists, create it otherwise
	require_once('db/db_create_schema.php');

	// Possible GET parameters:
	// e = exchange
	// s = symbols (comma-separated)
	// t = date or number of days in the past
	// f = format (JSON or ZIP)
	// stats = returns database statistics in JSON format
	// dump = returns a ZIP file containing all of the historical data for every stock in the database
	if (Utils::IsGetVariableNotEmpty('e'))
	{
		if (Utils::IsGetVariableNotEmpty('t'))
		{
			// Parse time frame
			
		}

		// Get all stocks data for this exchange (if t is not set, only fetch active stocks)

		// Format it

		if (Utils::IsGetVariableNotEmpty('f'))
		{
			// Format output
			
		}
	}
	else if (Utils::IsGetVariableNotEmpty('s'))
	{
		// Split

		if (Utils::IsGetVariableNotEmpty('t'))
		{
			// Parse time frame

		}

		// Select data

		// Format it

		if (Utils::IsGetVariableNotEmpty('f'))
		{
			// Format output
			
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
