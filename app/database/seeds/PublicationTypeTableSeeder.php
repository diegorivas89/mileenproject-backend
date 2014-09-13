<?php

class PublicationTypeTableSeeder extends Seeder {

		public function run()
		{
			DB::table('publication_types')->delete();
			PublicationType::create(array('name' => 'Premium', 'images' => 10, 'video' => 1));
			PublicationType::create(array('name' => 'Básica', 'images' => 5, 'video' => 1));
			PublicationType::create(array('name' => 'Gratuita', 'images' => 3, 'video' => 0));
		}
}

?>
