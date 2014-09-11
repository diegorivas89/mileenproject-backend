<?php

class PropertyTypeTableSeeder extends Seeder {

		public function run()
		{
				DB::table('property_types')->delete();

				PropertyType::create(array('name' => 'Oficina'));
				PropertyType::create(array('name' => 'Cochera'));
				PropertyType::create(array('name' => 'Departamentos'));
				PropertyType::create(array('name' => 'Barrio Cerrado / Countries'));
				PropertyType::create(array('name' => 'Casa'));
				PropertyType::create(array('name' => 'Local Comercial'));
				PropertyType::create(array('name' => 'Duplex'));
				PropertyType::create(array('name' => 'PH'));

		}

}

?>
