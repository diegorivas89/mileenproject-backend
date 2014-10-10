<?php

class PublicationTypeTableSeeder extends Seeder {

		public function run()
		{
			DB::table('publication_types')->delete();
			PublicationType::create(array('name' => 'Premium', 'value' => 1, 'images' => 10, 'video' => 1, 'validity_period' => 60));
			PublicationType::create(array('name' => 'Básica', 'value' => 2, 'images' => 5, 'video' => 1, 'validity_period' => 30));
			PublicationType::create(array('name' => 'Gratuita', 'value' => 3, 'images' => 3, 'video' => 0, 'validity_period' => 15));
		}
}

?>
