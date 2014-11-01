<?php

class AdjacentsTableSeeder extends Seeder {

    public function run() {
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
            'Velez Sarfield',
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
            'Villa Riachuelo',
            'Parque Chas'
        ];
        sort($index);

        $aux = [];
        $i = 1;
        foreach ($index as $value) {
            $aux[$value] = $i;
            // echo $value." - ".$i."\n";
            $i++;
        }
        $index = $aux;

        $nighborhoodsAdjacents = [
            'Saavedra'          => ['Saavedra', 'Nuñez', 'Coghlan', 'Villa Urquiza'],
            'Nuñez'             => ['Nuñez', 'Saavedra', 'Coghlan', 'Belgrano'],
            'Coghlan'           => ['Coghlan', 'Nuñez', 'Saavedra', 'Belgrano', 'Villa Urquiza'],
            'Belgrano'          => ['Belgrano', 'Nuñez', 'Coghlan', 'Villa Urquiza', 'Villa Ortuzar', 'Colegiales', 'Palermo'],
            'Colegiales'        => ['Colegiales', 'Belgrano', 'Villa Ortuzar', 'Chacarita', 'Palermo'],
            'Palermo'           => ['Palermo', 'Belgrano', 'Colegiales', 'Chacarita', 'Villa Crespo', 'Almagro', 'Recoleta'],
            'Recoleta'          => ['Recoleta', 'Palermo', 'Almagro', 'Balvanera', 'San Nicolas', 'Retiro', 'Puerto Madero'],
            'Retiro'            => ['Retiro', 'Recoleta', 'Puerto Madero', 'San Nicolas'],
            'Puerto Madero'     => ['Puerto Madero', 'Recoleta', 'Retiro', 'San Nicolas', 'Montserrat', 'San Telmo', 'Boca'],
            'San Nicolas'       => ['San Nicolas', 'Recoleta', 'Retiro', 'Balvanera', 'Montserrat', 'Puerto Madero'],
            'Montserrat'        => ['Montserrat', 'San Nicolas', 'Puerto Madero', 'San Telmo', 'Constitucion', 'Balvanera', 'San Cristobal'],
            'San Telmo'         => ['San Telmo', 'Montserrat', 'Constitucion', 'Barracas', 'Boca', 'Puerto Madero'],
            'Boca'              => ['Boca', 'Puerto Madero', 'Barracas', 'San Telmo'],
            'Constitucion'      => ['Constitucion', 'Balvanera', 'San Cristobal', 'Parque Patricios', 'Barracas', 'San Telmo', 'Montserrat'],
            'San Cristobal'     => ['San Cristobal', 'Almagro', 'Boedo', 'Parque Patricios', 'Constitucion', 'Montserrat', 'Balvanera'],
            'Parque Patricios'  => ['Parque Patricios', 'Barracas', 'Constitucion', 'San Cristobal', 'Boedo', 'Nueva Pompeya'],
            'Barracas'          => ['Barracas', 'Nueva Pompeya', 'Parque Patricios', 'Constitucion', 'San Telmo', 'Boca'],
            'Balvanera'         => ['Balvanera', 'San Nicolas', 'Montserrat', 'Constitucion', 'San Cristobal', 'Boedo', 'Almagro', 'Recoleta'],
            'Boedo'             => ['Boedo', 'Balvanera', 'San Cristobal', 'Parque Patricios', 'Nueva Pompeya', 'Parque Chacabuco', 'Caballito', 'Almagro'],
            'Almagro'           => ['Almagro', 'Recoleta', 'Balvanera', 'San Cristobal', 'Boedo', 'Caballito', 'Villa Crespo', 'Palermo'],
            'Villa Crespo'      => ['Villa Crespo', 'Chacarita', 'Colegiales', 'Palermo', 'Almagro', 'Caballito', 'Villa Mitre', 'La Paternal'],
            'Caballito'         => ['Caballito', 'Villa Crespo', 'Almagro', 'Boedo', 'Parque Chacabuco', 'Flores', 'Villa Mitre', 'La Paternal'],
            'Parque Chacabuco'  => ['Parque Chacabuco', 'Caballito', 'Boedo', 'Nueva Pompeya', 'Flores'],
            'Nueva Pompeya'     => ['Nueva Pompeya', 'Boedo', 'Parque Patricios', 'Barracas', 'Villa Soldati', 'Flores', 'Parque Chacabuco'],
            'Villa Soldati'     => ['Villa Soldati', 'Parque Avellaneda', 'Flores', 'Nueva Pompeya', 'Villa Riachuelo', 'Villa Lugano'],
            'Flores'            => ['Flores', 'Villa Mitre', 'Caballito', 'Parque Chacabuco', 'Nueva Pompeya', 'Villa Soldati', 'Parque Avellaneda', 'Floresta', 'Villa Santa Rita'],
            'Villa Mitre'       => ['Villa Mitre', 'Villa del Parque', 'La Paternal', 'Villa Crespo', 'Caballito', 'Flores', 'Villa Santa Rita'],
            'La Paternal'       => ['La Paternal', 'Parque Chas', 'Villa Ortuzar', 'Chacarita', 'Villa Crespo', 'Caballito', 'Villa Mitre', 'Villa del Parque', 'Agronomia'],
            'Chacarita'         => ['Chacarita', 'Colegiales', 'Palermo', 'Villa Crespo', 'La Paternal', 'Villa Ortuzar'],
            'Villa Ortuzar'     => ['Villa Ortuzar', 'Villa Urquiza', 'Belgrano', 'Colegiales', 'Chacarita', 'La Paternal', 'Parque Chas'],
            'Villa Urquiza'     => ['Villa Urquiza', 'Saavedra', 'Coghlan', 'Villa Ortuzar', 'Parque Chas', 'Agronomia', 'Villa Pueyrredon'],
            'Villa Pueyrredon'  => ['Villa Pueyrredon', 'Villa Urquiza', 'Parque Chas', 'Agronomia', 'Villa Devoto'],
            'Agronomia'         => ['Agronomia', 'Villa Pueyrredon', 'Villa Urquiza', 'Parque Chas', 'La Paternal', 'Villa del Parque', 'Villa Devoto'],
            'Parque Chas'       => ['Parque Chas', 'Agronomia', 'Villa Pueyrredon', 'Villa Urquiza', 'La Paternal', 'Villa Ortuzar'],
            'Villa del Parque'  => ['Villa del Parque', 'Agronomia', 'La Paternal', 'Villa Mitre', 'Villa Santa Rita', 'Monte Castro', 'Villa Devoto'],
            'Villa Santa Rita'  => ['Villa Santa Rita', 'Villa del Parque', 'Villa Mitre', 'Flores', 'Floresta', 'Monte Castro'],
            'Floresta'          => ['Floresta', 'Monte Castro', 'Villa Santa Rita', 'Flores', 'Parque Avellaneda', 'Velez Sarfield'],
            'Velez Sarfield'    => ['Velez Sarfield', 'Monte Castro', 'Floresta', 'Parque Avellaneda', 'Villa Luro'],
            'Villa Luro'        => ['Villa Luro', 'Velez Sarfield', 'Monte Castro', 'Parque Avellaneda', 'Mataderos', 'Liniers', 'Versalles'],
            'Monte Castro'      => ['Monte Castro', 'Villa Devoto', 'Villa del Parque', 'Villa Santa Rita', 'Floresta', 'Velez Sarfield', 'Villa Luro', 'Versalles', 'Villa Real'],
            'Villa Devoto'      => ['Villa Devoto', 'Villa Pueyrredon', 'Agronomia', 'Villa del Parque', 'Monte Castro', 'Villa Real'],
            'Villa Real'        => ['Villa Real', 'Villa Devoto', 'Monte Castro', 'Versalles'],
            'Versalles'         => ['Versalles', 'Villa Real', 'Monte Castro', 'Versalles'],
            'Liniers'           => ['Liniers', 'Versalles', 'Villa Luro', 'Mataderos'],
            'Mataderos'         => ['Mataderos', 'Liniers', 'Villa Luro', 'Parque Avellaneda', 'Villa Lugano'],
            'Villa Lugano'      => ['Villa Lugano', 'Mataderos', 'Parque Avellaneda', 'Villa Soldati', 'Villa Riachuelo'],
            'Parque Avellaneda' => ['Parque Avellaneda', 'Villa Luro', 'Velez Sarfield', 'Floresta', 'Flores', 'Villa Soldati', 'Villa Lugano', 'Mataderos'],
            'Villa Lugano'      => ['Villa Lugano', 'Mataderos', 'Parque Avellaneda', 'Villa Soldati', 'Villa Riachuelo'],
            'Villa Riachuelo'   => ['Villa Riachuelo', 'Villa Lugano', 'Villa Soldati']
        ];

        foreach ($nighborhoodsAdjacents as $neighborhood => $adjacents){
            if (!$neighborhood) continue;
            $id = $index[$neighborhood];

            if (!$id) throw new Exception("Indice incorrecto: ".$neighborhood, 1);

            foreach ($adjacents as $adjacent) {
                if (!$adjacent) continue;
                $adjacentId = $index[$adjacent];

                if (!$adjacentId) throw new Exception("Indice adyacente incorrecto: ".$adjacent, 1);
                // echo "$id - $adjacentId\n";
                $a = new Adjacent();
                $a->neighborhood_id = $id;
                $a->adjacent_neighborhood_id = $adjacentId;
                $a->save();
            }
        }
    }
}

?>
