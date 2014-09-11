<?php

class PublicationTypeTableSeeder extends Seeder {

		public function run()
		{
				DB::table('publication_types')->delete();
				PublicationType::create(array('name' => 'Gratuita'));
				PublicationType::create(array('name' => 'Básica'));
				PublicationType::create(array('name' => 'Premiun'));
		}
}

?>
