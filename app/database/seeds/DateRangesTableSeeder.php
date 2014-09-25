<?php

/**
*
*/
class DateRangesTableSeeder extends Seeder
{

	public function run()
	{
		DB::table('date_ranges')->delete();

        DateRange::create(array('name' => 'hoy', 'positive_offset' => 0, 'negative_offset' => 1));
        DateRange::create(array('name' => '1 semana', 'positive_offset' => 0, 'negative_offset' => 7));
        DateRange::create(array('name' => '2 semanas', 'positive_offset' => 0, 'negative_offset' => 14));
        DateRange::create(array('name' => '1 mes', 'positive_offset' => 0, 'negative_offset' => 30));
        DateRange::create(array('name' => '3 meses', 'positive_offset' => 0, 'negative_offset' => 90));
	}
}

?>