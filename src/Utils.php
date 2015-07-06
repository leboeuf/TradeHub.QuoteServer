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
}