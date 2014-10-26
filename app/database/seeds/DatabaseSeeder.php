<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('OperationTypeTableSeeder');
		$this->call('EnviromentTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('PropertyTypeTableSeeder');
		$this->call('NeighborhoodTableSeeder');
		$this->call('PublicationTypeTableSeeder');
		$this->call('AmenitieTypeTableSeeder');
		$this->call('PropertyTableSeeder');
		$this->call('DateRangesTableSeeder');
		$this->call('AdjacentsTableSeeder');
	}

}
