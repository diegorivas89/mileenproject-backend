<?php

class NeighborhoodTableSeeder extends Seeder {

    public function run()
    {
        DB::table('neighborhoods')->delete();

        $index = [
            'Saavedra',
            'Nuñez',
            'Coghlan',
            'Belgrano',
            'Colegiales',
            'Palermo',
            'Recoleta',
            'Retiro',
            'Puerto Madero',
            'San Nicolas',
            'Montserrat',
            'San Telmo',
            'Boca',
            'Constitucion',
            'San Cristobal',
            'Parque Patricios',
            'Barracas',
            'Balvanera',
            'Boedo',
            'Almagro',
            'Villa Crespo',
            'Caballito',
            'Parque Chacabuco',
            'Nueva Pompeya',
            'Villa Soldati',
            'Flores',
            'Villa Mitre',
            'La Paternal',
            'Chacarita',
            'Villa Ortuzar',
            'Villa Urquiza',
            'Villa Pueyrredon',
            'Agronomia',
            'Villa del Parque',
            'Villa Santa Rita',
            'Floresta',
            'Velez Sarsfield',
            'Villa Luro',
            'Monte Castro',
            'Villa Devoto',
            'Villa Real',
            'Versalles',
            'Liniers',
            'Mataderos',
            'Villa Lugano',
            'Parque Avellaneda',
            'Villa Lugano',
            'Villa Riachuelo'
        ];
        sort($index);

        $aux = [];
        $i = 1;
        foreach ($index as $value) {
            $aux[$value] = $i;
            //echo $value." - ".$i."\n";
            $i++;
        }
        $index = $aux;

        foreach ($index as $name => $id){
            $neighborhood = new Neighborhood();
            $neighborhood->id = $id;
            $neighborhood->name = $name;
            $neighborhood->save();
        }
    }

}

?>
