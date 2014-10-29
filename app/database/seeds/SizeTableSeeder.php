<?php

/**
*
*/
class SizeTableSeeder extends Seeder
{

	function run()
	{
		DB::table('sizes')->delete();

		Size::create(['name' => '0 a 25', 'min' => 0, 'max' => 25]);
		Size::create(['name' => '26 a 50', 'min' => 26, 'max' => 50]);
		Size::create(['name' => '51 a 75', 'min' => 51, 'max' => 75]);
		Size::create(['name' => '76 a 100', 'min' => 76, 'max' => 100]);
		Size::create(['name' => 'mas de 100', 'min' => 101, 'max' => 10000000]);
	}
}

?>