<?php

/**
*
*/
class CurrencyTableSeeder extends Seeder
{

	function run()
	{
		Currency::create(['id' => 'U$D', 'value' => 1]);
		Currency::create(['id' => '$', 'value' => 10]);
	}
}

?>