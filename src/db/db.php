<?php
	$db = new PDO('pgsql:host=localhost;dbname=tradehub_quoteserver', 'th_qs_user', 'th_qs_password');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);