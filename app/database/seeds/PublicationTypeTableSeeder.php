<?php

class PublicationTypeTableSeeder extends Seeder {

		public function run()
		{
				DB::table('publication_types')->delete();
				PublicationType::create(array('name' => 'Premiun', 'images' => 10));
				PublicationType::create(array('name' => 'Básica', 'images' => 5));
				PublicationType::create(array('name' => 'Gratuita', 'images' => 3));
		}
}

?>
