<?php

class EnviromentTableSeeder extends Seeder {

    public function run()
    {
        DB::table('environments')->delete();

        Environment::create(array('name' => '1 Ambiente'));
        Environment::create(array('name' => '1 y 1/2 Ambientes'));
        Environment::create(array('name' => '2 Ambientes'));
        Environment::create(array('name' => '2 y 1/2 Ambientes'));
        Environment::create(array('name' => '3 Ambientes'));
        Environment::create(array('name' => '4 Ambientes'));
        Environment::create(array('name' => '5 o más Ambientes'));

    }

}

?>
