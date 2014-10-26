<?php

class AdjacentsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('adjacents')->delete();

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

        $nighborhoodsAdjacents = [
            'Saavedra'          => ['Nuñez', 'Coghlan', 'Villa Urquiza'],
            'Nuñez'             => ['Saavedra', 'Coghlan', 'Belgrano'],
            'Coghlan'           => ['Nuñez', 'Saavedra', 'Belgrano', 'Villa Urquiza'],
            'Belgrano'          => ['Nuñez', 'Coghlan', 'Villa Urquiza', 'Villa Ortuzar', 'Colegiales', 'Palermo'],
            'Colegiales'        => ['Belgrano', 'Villa Ortuzar', 'Chacarita', 'Palermo'],
            'Palermo'           => ['Belgrano', 'Colegiales', 'Villa Crespo', 'Almagro', 'Recoleta'],
            'Recoleta'          => ['Palermo', 'Almagro', 'Balvanera', 'San Nicolas', 'Retiro', 'Puerto Madero'],
            'Retiro'            => ['Recoleta', 'Puerto Madero', 'San Nicolas'],
            'Puerto Madero'     => ['Recoleta', 'Retiro', 'San Nicolas', 'Montserrat', 'San Telmo', 'Boca'],
            'San Nicolas'       => ['Recoleta', 'Retiro', 'Balvanera', 'Montserrat', 'Puerto Madero', '', '', '', ],
            'Montserrat'        => ['San Nicolas', 'Puerto Madero', 'San Telmo', 'Constitucion', 'Balvanera', '', '', '', ],
            'San Telmo'         => ['Montserrat', 'Constitucion', 'Barracas', 'Boca', 'Puerto Madero', '', '', '', ],
            'Boca'              => ['Puerto Madero', 'Barracas', 'San Telmo', '', '', '', '', '', ],
            'Constitucion'      => ['', '', 'Balvanera', 'San Cristobal', 'Parque Patricios', 'Barracas', 'San Telmo', 'Montserrat', ],
            'San Cristobal'     => ['', '', 'Almagro', 'Boedo', 'Parque Patricios', 'Constitucion', 'Montserrat', 'Balvanera', ],
            'Parque Patricios'  => ['', '', '', 'Barracas', 'Constitucion', 'San Cristobal', 'Boedo', 'Nueva Pompeya', ],
            'Barracas'          => ['', '', '', 'Nueva Pompeya', 'Parque Patricios', 'Constitucion', 'San Telmo', 'Boca', ],
            'Balvanera'         => ['', 'San Nicolas', 'Montserrat', 'Constitucion', 'San Cristobal', 'Boedo', 'Almagro', 'Recoleta', ],
            'Boedo'             => ['', 'Balvanera', 'San Cristobal', 'Parque Patricios', 'Nueva Pompeya', 'Parque Chacabuco', 'Caballito', 'Almagro', ],
            'Almagro'           => ['', 'Recoleta', 'Balvanera', 'San Cristobal', 'Boedo', 'Caballito', 'Villa Crespo', 'Palermo', ],
            'Villa Crespo'      => ['', '', '', '', '', '', '', '', ],
            'Caballito'         => ['', '', '', '', '', '', '', '', ],
            'Parque Chacabuco'  => ['', '', '', '', '', '', '', '', ],
            'Nueva Pompeya'     => ['', '', '', '', '', '', '', '', ],
            'Villa Soldati'     => ['', '', '', '', '', '', '', '', ],
            'Flores'            => ['', '', '', '', '', '', '', '', ],
            'Villa Mitre'       => ['', '', '', '', '', '', '', '', ],
            'La Paternal'       => ['', '', '', '', '', '', '', '', ],
            'Chacarita'         => ['', '', '', '', '', '', '', '', ],
            'Villa Ortuzar'     => ['', '', '', '', '', '', '', '', ],
            'Villa Urquiza'     => ['', '', '', '', '', '', '', '', ],
            'Villa Pueyrredon'  => ['', '', '', '', '', '', '', '', ],
            'Agronomia'         => ['', '', '', '', '', '', '', '', ],
            'Villa del Parque'  => ['', '', '', '', '', '', '', '', ],
            'Villa Santa Rita'  => ['', '', '', '', '', '', '', '', ],
            'Floresta'          => ['', '', '', '', '', '', '', '', ],
            'Velez Sarsfield'   => ['', '', '', '', '', '', '', '', ],
            'Villa Luro'        => ['', '', '', '', '', '', '', '', ],
            'Monte Castro'      => ['', '', '', '', '', '', '', '', ],
            'Villa Devoto'      => ['', '', '', '', '', '', '', '', ],
            'Villa Real'        => ['', '', '', '', '', '', '', '', ],
            'Versalles'         => ['', '', '', '', '', '', '', '', ],
            'Liniers'           => ['', '', '', '', '', '', '', '', ],
            'Mataderos'         => ['', '', '', '', '', '', '', '', ],
            'Villa Lugano'      => ['', '', '', '', '', '', '', '', ],
            'Parque Avellaneda' => ['', '', '', '', '', '', '', '', ],
            'Villa Lugano'      => ['', '', '', '', '', '', '', '', ],
            'Villa Riachuelo'   => ['', '', '', '', '', '', '', '', ],
        ];

        foreach ($nighborhoodsAdjacents as $neighborhood => $adjacents){
            if (!$neighborhood) continue;
            $id = $index[$neighborhood];

            if (!$id) throw new Exception("Indice incorrecto: ".$neighborhood, 1);

            foreach ($adjacents as $adjacent) {
                if (!$adjacent) continue;
                $adjacentId = $index[$adjacent];

                if (!$adjacentId) throw new Exception("Indice adyacente incorrecto: ".$adjacent, 1);
                //echo "$id - $adjacentId\n";
                $a = new Adjacent();
                $a->neighborhood_id = $id;
                $a->adjacent_neighborhood_id = $adjacentId;
                $a->save();
            }
        }
    }
}

?>
