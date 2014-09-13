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
				PropertyType::create(array('name' => 'Quinta'));
				PropertyType::create(array('name' => 'Terreno'));
				PropertyType::create(array('name' => 'Consultorio'));
				PropertyType::create(array('name' => 'Campo'));
				PropertyType::create(array('name' => 'Galpón'));
				PropertyType::create(array('name' => 'Hotel'));
				PropertyType::create(array('name' => 'Edificio'));
				PropertyType::create(array('name' => 'Otro'));
				PropertyType::create(array('name' => 'Departamento Compartido'));
		}

}

?>
