<?php

class OperationTypeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('operation_types')->delete();

        OperationType::create(array('name' => 'Venta'));
        OperationType::create(array('name' => 'Alquiler Temporal'));
        OperationType::create(array('name' => 'Alquiler'));

    }

}

?>
