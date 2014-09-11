<?php

class NeighborhoodTableSeeder extends Seeder {

    public function run()
    {
        DB::table('neighborhoods')->delete();

        Neighborhood::create(array('name' => 'Agronomía'));
        Neighborhood::create(array('name' => 'Almagro'));
        Neighborhood::create(array('name' => 'Balvanera'));
        Neighborhood::create(array('name' => 'Barracas'));
        Neighborhood::create(array('name' => 'Belgrano'));
        Neighborhood::create(array('name' => 'Boedo'));
        Neighborhood::create(array('name' => 'Caballito'));
        Neighborhood::create(array('name' => 'Chacarita'));
        Neighborhood::create(array('name' => 'Coghlan'));
        Neighborhood::create(array('name' => 'Colegiales'));
        Neighborhood::create(array('name' => 'Constitución'));
        Neighborhood::create(array('name' => 'Flores'));
        Neighborhood::create(array('name' => 'Floresta'));
        Neighborhood::create(array('name' => 'La Boca'));
        Neighborhood::create(array('name' => 'La Paternal'));
        Neighborhood::create(array('name' => 'Liniers'));
        Neighborhood::create(array('name' => 'Mataderos'));
        Neighborhood::create(array('name' => 'Monte Castro'));
        Neighborhood::create(array('name' => 'Monserrat'));
        Neighborhood::create(array('name' => 'Nueva Pompeya'));
        Neighborhood::create(array('name' => 'Núñez'));
        Neighborhood::create(array('name' => 'Palermo'));
        Neighborhood::create(array('name' => 'Parque Avellaneda'));
        Neighborhood::create(array('name' => 'Parque Chacabuco'));
        Neighborhood::create(array('name' => 'Parque Chas'));
        Neighborhood::create(array('name' => 'Parque Patricios'));
        Neighborhood::create(array('name' => 'Puerto Madero'));
        Neighborhood::create(array('name' => 'Recoleta'));
        Neighborhood::create(array('name' => 'Retiro'));
        Neighborhood::create(array('name' => 'Saavedra'));
        Neighborhood::create(array('name' => 'San Cristóbal'));
        Neighborhood::create(array('name' => 'San Nicolás'));
        Neighborhood::create(array('name' => 'San Telmo'));
        Neighborhood::create(array('name' => 'Vélez Sársfield'));
        Neighborhood::create(array('name' => 'Versalles'));
        Neighborhood::create(array('name' => 'Villa Crespo'));
        Neighborhood::create(array('name' => 'Villa del Parque'));
        Neighborhood::create(array('name' => 'Villa Devoto'));
        Neighborhood::create(array('name' => 'Villa General Mitre'));
        Neighborhood::create(array('name' => 'Villa Lugano'));
        Neighborhood::create(array('name' => 'Villa Luro'));
        Neighborhood::create(array('name' => 'Villa Ortúzar'));
        Neighborhood::create(array('name' => 'Villa Pueyrredón'));
        Neighborhood::create(array('name' => 'Villa Real'));
        Neighborhood::create(array('name' => 'Villa Riachuelo'));
        Neighborhood::create(array('name' => 'Villa Santa Rita'));
        Neighborhood::create(array('name' => 'Villa Soldati'));
        Neighborhood::create(array('name' => 'Villa Urquiza'));


    }

}

?>
