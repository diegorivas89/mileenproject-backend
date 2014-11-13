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
                  'id' => 1,
            	'title' => 'Ropa Adidas',
            	'description' => 'Ropa Adidas',
            	'target_url' => 'http://www.adidas.com.ar/',
            	'banner' => '/store/banners/adidas.jpg'
            ));

            Ad::create(array(
                  'id' => 2,
            	'title' => 'Paugeot 307 - Nunca Taxi',
            	'description' => 'Paugeot 307 - Nunca Taxi',
            	'target_url' => 'http://www.volkswagen.com.ar',
            	'banner' => '/store/banners/auto.jpg'
            ));

            Ad::create(array(
                  'id' => 3,
            	'title' => 'Cursos a distancia',
            	'description' => 'Cursos a distancia',
            	'target_url' => 'http://www.cui.edu.ar',
            	'banner' => '/store/banners/curso.jpg'
            ));

            Ad::create(array(
                  'id' => 4,
            	'title' => 'Todas las marcas de ropa',
            	'description' => 'Todas las marcas de ropa',
            	'target_url' => 'www.falabella.com.ar',
            	'banner' => '/store/banners/ropa.jpg'
            ));
	}
}

?>