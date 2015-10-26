<?php

class SymbolListingDownloadJob
{
	private $supportedExchanges = ['NASDAQ']; //, 'NYSE', AMEX'];

	public function run()
	{
		foreach ($this->supportedExchanges as $exchange)
		{
			// Get listing
			$stocks = DataDownloader::GetSymbolListing($exchange);

			// Upsert data
			$this->upsertStocks($exchange, $stocks);
		}
	}

	private function upsertStocks($exchange, $stocks)
	{
		// http://stackoverflow.com/questions/1109061
		global $db;
		$update = $db->prepare('UPDATE symbols SET name = ? WHERE symbol = ? AND exchange = ?');
		$insert = $db->prepare('INSERT INTO symbols (symbol, exchange, name)
								SELECT ?, ?, ?
								WHERE NOT EXISTS (SELECT 1 FROM symbols WHERE symbol = ? AND exchange = ?)');

		foreach ($stocks as $stock)
		{
			$update->execute([$stock['name'], $stock['symbol'], $exchange]);
			$insert->execute([$stock['symbol'], $exchange, $stock['name'], 
							  $stock['symbol'], $exchange]);
		}
	}
}