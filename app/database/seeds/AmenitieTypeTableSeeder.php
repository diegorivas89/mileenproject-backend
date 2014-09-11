
<?php

class AmenitieTypeTableSeeder extends Seeder {

		public function run()
		{
				DB::table('amenitie_types')->delete();
				AmenitieType::create(array('name' => 'Amoblado'));
				AmenitieType::create(array('name' => 'Estacionamiento'));
				AmenitieType::create(array('name' => 'Terraza'));
				AmenitieType::create(array('name' => 'Balcón'));
				AmenitieType::create(array('name' => 'Aire Acondicionado'));
				AmenitieType::create(array('name' => 'Calefacción'));
				AmenitieType::create(array('name' => 'Laundry'));
				AmenitieType::create(array('name' => 'Gimnasio'));
				AmenitieType::create(array('name' => 'Hidromasaje'));
				AmenitieType::create(array('name' => 'Parrilla'));
				AmenitieType::create(array('name' => 'Piscina'));
				AmenitieType::create(array('name' => 'Sala de Juegos'));
				AmenitieType::create(array('name' => 'Sauna'));
				AmenitieType::create(array('name' => 'Solarium'));
				AmenitieType::create(array('name' => 'SUM'));
				AmenitieType::create(array('name' => 'Cancha de Paddle'));
				AmenitieType::create(array('name' => 'Cancha de Tenis'));
				AmenitieType::create(array('name' => 'Grupo Electrógeno'));
				AmenitieType::create(array('name' => 'Spa'));
				AmenitieType::create(array('name' => 'Vigilancia (24hs)'));
				AmenitieType::create(array('name' => 'Cámaras de Seguridad'));
				AmenitieType::create(array('name' => 'Baulera'));
				AmenitieType::create(array('name' => 'Cocina'));
				AmenitieType::create(array('name' => 'Comedor Diario'));
				AmenitieType::create(array('name' => 'Dependencia de Servicio'));
				AmenitieType::create(array('name' => 'Dormitorios en Suite'));
				AmenitieType::create(array('name' => 'Escritorio'));
				AmenitieType::create(array('name' => 'Vestidor'));
				AmenitieType::create(array('name' => 'Hall'));
				AmenitieType::create(array('name' => 'Lavadero'));
				AmenitieType::create(array('name' => 'Living'));
				AmenitieType::create(array('name' => 'Living Comedor'));
				AmenitieType::create(array('name' => 'Toilette'));
				AmenitieType::create(array('name' => 'Comedor'));
				AmenitieType::create(array('name' => 'Palier (Privado)'));
				AmenitieType::create(array('name' => 'Agua Corriente'));
				AmenitieType::create(array('name' => 'Luz'));
				AmenitieType::create(array('name' => 'Gas Natural'));
				AmenitieType::create(array('name' => 'Internet'));
				AmenitieType::create(array('name' => 'Desagüe Cloacal'));
				AmenitieType::create(array('name' => 'Pavimento'));
				AmenitieType::create(array('name' => 'Teléfono'));
				AmenitieType::create(array('name' => 'Video Cable'));
		}
	}
?>
