<?php

class PropertyTableSeeder extends Seeder {

		public function run()
		{
			DB::table('properties')->delete();

			Property::create(
				array(
					'user_id' => User::all()->first()->id,
					'property_type_id' => PropertyType::all()->first()->id,
					'publication_type_id' => PublicationType::all()->first()->id,
					'environment_id' => Environment::all()->first()->id,
					'operation_type_id' => OperationType::all()->first()->id,
					'neighborhood_id' => Neighborhood::all()->first()->id,
					'covered_size' => 39,
					'size' => 120,
					'title' => 'Oficina',
					'description' => 'Una descripción',
					'address' => 'Paseo colon 1000',
					'currency' => 'U$S',
					'price' => 1234,
					'expenses' => 500,
					'age' => 30,
					'state' => 'active'
				)
			);

			Property::create(
				array(
					'user_id' => User::all()->first()->id,
					'property_type_id' => PropertyType::all()->first()->id,
					'publication_type_id' => PublicationType::all()->first()->id,
					'environment_id' => Environment::all()->first()->id,
					'operation_type_id' => OperationType::all()->first()->id,
					'neighborhood_id' => Neighborhood::all()->first()->id,
					'covered_size' => 39,
					'size' => 55,
					'title' => 'Departamento inhabitable',
					'description' => 'Una descripción',
					'address' => 'Paseo colon 1000',
					'currency' => 'U$S',
					'price' => 1234,
					'expenses' => 500,
					'age' => 30,
					'state' => 'active'
				)
			);
		}
}

?>
