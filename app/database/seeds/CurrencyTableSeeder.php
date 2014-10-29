<?php

/**
*
*/
class CurrencyTableSeeder extends Seeder
{

	function run()
	{
		DB::table('currencies')->delete();

		Currency::create(['id' => 'U$S', 'value' => 1]);
		Currency::create(['id' => '$', 'value' => 10]);
	}
}

?>