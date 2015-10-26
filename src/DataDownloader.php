<?php

class DataDownloader
{
	/**
	 * Returns the list of symbols for a given exchange.
	 */
	public static function GetSymbolListing($exchange)
	{
		if ($exchange == "NASDAQ" ||
			$exchange == "NYSE" ||
			$exchange == "AMEX")
		{
			$csv = self::DownloadFromNasdaq($exchange);
			$lines = explode(PHP_EOL, $csv);

			$result = [];
			foreach ($lines as $line)
			{
				$f = str_getcsv($line);

				if (count($f) < 2)
				{
					continue;
				}

				$data = [];
				$data['symbol'] = $f[0];
				$data['name'] = $f[1];
				$result[] = $data;
			}
			
			array_shift($result); // Remove header row
			return $result;
		}
	}

	/**
	 * Downloads a CSV file from nasdaq.com companies listing.
	 * $exchange can be NASDAQ, NYSE, AMEX.
	 */
	private static function DownloadFromNasdaq($exchange)
	{
		$url = "http://www.nasdaq.com/screening/companies-by-name.aspx?letter=0&exchange=$exchange&render=download";
		$csv = file_get_contents($url);
		return $csv;
	}
}