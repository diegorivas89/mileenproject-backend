<?php

class PropertyTableSeeder extends Seeder {

    public function run()
    {
        DB::table('properties')->delete();

        Property::create(array('user_id' => User::all()->first()->id,
                               'property_type_id' => PropertyType::all()->first()->id,
                               'environment_id' => Environment::all()->first()->id,
                               'operation_type_id' => OperationType::all()->first()->id,
                               'neighborhood_id' => Neighborhood::all()->first()->id,
                               'covered_size' => 39, 'size' => 120, 'size_discovered' => 40,
                               'title' => 'Oficina', 'description' => 'Una descripción',
                               'address' => 'Paseo colon 1000', 'currency' => 'U$S',
                               'price' => 1234, 'expenses' => 500, 'age' => 30));


        Property::create(array('user_id' => User::all()->first()->id,
                               'property_type_id' => PropertyType::all()->first()->id,
                               'environment_id' => Environment::all()->first()->id,
                               'operation_type_id' => OperationType::all()->first()->id,
                               'neighborhood_id' => Neighborhood::all()->first()->id,
                               'covered_size' => 39, 'size' => 55,'size_discovered' => 4,
                               'title' => 'Departamento inhabitable',
                               'description' => 'Una descripción',
                               'address' => 'Paseo colon 1000', 'currency' => 'U$S',
                               'price' => 1234, 'expenses' => 500, 'age' => 30));

    }

}

?>
