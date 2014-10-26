<?php

class NeighborhoodTableSeeder extends Seeder {

    public function run()
    {
        DB::table('neighborhoods')->delete();

        Neighborhood::create(array('id' => 1,'name' => 'Agronomía'));
        Neighborhood::create(array('id' => 2, 'name' => 'Almagro'));
        Neighborhood::create(array('id' => 3, 'name' => 'Balvanera'));
        Neighborhood::create(array('id' => 4, 'name' => 'Barracas'));
        Neighborhood::create(array('id' => 5, 'name' => 'Belgrano'));
        Neighborhood::create(array('id' => 6, 'name' => 'Boedo'));
        Neighborhood::create(array('id' => 7, 'name' => 'Caballito'));
        Neighborhood::create(array('id' => 8, 'name' => 'Chacarita'));
        Neighborhood::create(array('id' => 9, 'name' => 'Coghlan'));
        Neighborhood::create(array('id' => 10, 'name' => 'Colegiales'));
        Neighborhood::create(array('id' => 11, 'name' => 'Constitución'));
        Neighborhood::create(array('id' => 12, 'name' => 'Flores'));
        Neighborhood::create(array('id' => 13, 'name' => 'Floresta'));
        Neighborhood::create(array('id' => 14, 'name' => 'La Boca'));
        Neighborhood::create(array('id' => 15, 'name' => 'La Paternal'));
        Neighborhood::create(array('id' => 16, 'name' => 'Liniers'));
        Neighborhood::create(array('id' => 17, 'name' => 'Mataderos'));
        Neighborhood::create(array('id' => 18, 'name' => 'Monte Castro'));
        Neighborhood::create(array('id' => 19, 'name' => 'Monserrat'));
        Neighborhood::create(array('id' => 20, 'name' => 'Nueva Pompeya'));
        Neighborhood::create(array('id' => 21, 'name' => 'Núñez'));
        Neighborhood::create(array('id' => 22, 'name' => 'Palermo'));
        Neighborhood::create(array('id' => 23, 'name' => 'Parque Avellaneda'));
        Neighborhood::create(array('id' => 24, 'name' => 'Parque Chacabuco'));
        Neighborhood::create(array('id' => 25, 'name' => 'Parque Chas'));
        Neighborhood::create(array('id' => 26, 'name' => 'Parque Patricios'));
        Neighborhood::create(array('id' => 27, 'name' => 'Puerto Madero'));
        Neighborhood::create(array('id' => 28, 'name' => 'Recoleta'));
        Neighborhood::create(array('id' => 29, 'name' => 'Retiro'));
        Neighborhood::create(array('id' => 30, 'name' => 'Saavedra'));
        Neighborhood::create(array('id' => 31, 'name' => 'San Cristóbal'));
        Neighborhood::create(array('id' => 32, 'name' => 'San Nicolás'));
        Neighborhood::create(array('id' => 33, 'name' => 'San Telmo'));
        Neighborhood::create(array('id' => 34, 'name' => 'Vélez Sársfield'));
        Neighborhood::create(array('id' => 35, 'name' => 'Versalles'));
        Neighborhood::create(array('id' => 36, 'name' => 'Villa Crespo'));
        Neighborhood::create(array('id' => 37, 'name' => 'Villa del Parque'));
        Neighborhood::create(array('id' => 38, 'name' => 'Villa Devoto'));
        Neighborhood::create(array('id' => 39, 'name' => 'Villa General Mitre'));
        Neighborhood::create(array('id' => 40, 'name' => 'Villa Lugano'));
        Neighborhood::create(array('id' => 41, 'name' => 'Villa Luro'));
        Neighborhood::create(array('id' => 42, 'name' => 'Villa Ortúzar'));
        Neighborhood::create(array('id' => 43, 'name' => 'Villa Pueyrredón'));
        Neighborhood::create(array('id' => 44, 'name' => 'Villa Real'));
        Neighborhood::create(array('id' => 45, 'name' => 'Villa Riachuelo'));
        Neighborhood::create(array('id' => 46, 'name' => 'Villa Santa Rita'));
        Neighborhood::create(array('id' => 47, 'name' => 'Villa Soldati'));
        Neighborhood::create(array('id' => 48, 'name' => 'Villa Urquiza'));


    }

}

?>
