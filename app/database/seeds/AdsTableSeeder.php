<?php

/**
*
*/
class AdsTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('ads')->delete();

        Ad::create(array(
        	'title' => 'Caniche Toy',
        	'description' => 'Caniche Toy',
        	'target_url' => '',
        	'banner' => ''
        ));

        Ad::create(array(
        	'title' => 'Paugeot 307 - Nunca Taxi',
        	'description' => 'Paugeot 307 - Nunca Taxi',
        	'target_url' => '',
        	'banner' => ''
        ));

        Ad::create(array(
        	'title' => 'Heladera 3 Frios',
        	'description' => 'Heladera 3 Frios',
        	'target_url' => '',
        	'banner' => ''
        ));

        Ad::create(array(
        	'title' => 'Zapatillas Adidas Nuevas',
        	'description' => 'Zapatillas Adidas Nuevas',
        	'target_url' => '',
        	'banner' => ''
        ));
	}
}

?>