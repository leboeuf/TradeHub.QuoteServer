<?php
	require_once('db.php');

	try
	{
		$sql = ""; // Create schema here
		$db->exec($sql);

		echo "Database structure successfully created.";

	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}
