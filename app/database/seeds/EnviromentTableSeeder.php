<?php

class EnviromentTableSeeder extends Seeder {

    public function run()
    {
        DB::table('environments')->delete();

        Environment::create(array('name' => '1 Amb'));
        Environment::create(array('name' => '1 y 1/2 Amb'));
        Environment::create(array('name' => '2 Amb'));
        Environment::create(array('name' => '2 y 1/2 Amb'));
        Environment::create(array('name' => '3 Amb'));
        Environment::create(array('name' => '4 Amb'));
        Environment::create(array('name' => '5 o más Amb'));

    }

}

?>
