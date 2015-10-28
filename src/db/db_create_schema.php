<?php
	require_once('db.php');

	// Note: text datatype is used instead of varchar. See these links for arguments in favor of this decision:
	// http://www.postgresql.org/docs/9.1/static/datatype-character.html
	// http://programmers.stackexchange.com/questions/156181/is-there-any-reason-to-use-varchar-over-text-columns-in-a-database
	// http://www.depesz.com/2010/03/02/charx-vs-varcharx-vs-varchar-vs-text/
	// http://stackoverflow.com/questions/8295131/best-practices-for-sql-varchar-column-length

	// In postgres, primary keys are indexed (no need to explicitly create index)
	// http://www.postgresql.org/docs/9.1/static/sql-createtable.html#SQL-CREATETABLE-NOTES
	// "PostgreSQL automatically creates an index for each unique constraint and primary key constraint to enforce uniqueness.
	// Thus, it is not necessary to create an index explicitly for primary key columns."

	try
	{
		$sql = "CREATE TABLE IF NOT EXISTS symbols (
			symbol TEXT,
			exchange TEXT NOT NULL,
			name TEXT NOT NULL,
			PRIMARY KEY (exchange, symbol))";
		$db->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS historical (
			symbol TEXT,
			exchange TEXT NOT NULL,
			quote_date DATE NOT NULL,
			open DECIMAL(10,4) NOT NULL,
			high DECIMAL(10,4) NOT NULL,
			low DECIMAL(10,4) NOT NULL,
			close DECIMAL(10,4) NOT NULL,
			volume INT NOT NULL,
			adjusted_close DECIMAL(10,4) NOT NULL,
			PRIMARY KEY (exchange, symbol, quote_date))";
		$db->exec($sql);
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
