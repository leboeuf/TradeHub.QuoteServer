<?php
	require_once('db.php');

	// Check if the database structure exists, create it otherwise
	require_once('db_create_schema.php');


	// Possible GET parameters:
	// e = exchange
	// s = symbols (comma-separated)
	// t = date or number of days in the past
	// f = format (JSON or ZIP)
	// stats = returns database statistics in JSON format
	// dump = returns a ZIP file containing all of the historical data for every stock in the database
	if (isset($_GET['e']))
	{

	}
	else if (isset($_GET['s']))
	{

	}
	else if (isset($_GET['dump']))
	{
		
	}
	else if (isset($_GET['stats']))
	{
		
	}
