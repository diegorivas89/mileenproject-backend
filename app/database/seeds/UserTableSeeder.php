<?php

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array('name' => 'Ned Stark', 'telephone' => '42231231',
                           'email' => 'ned.stark@gmail.com', 'password' => 'chau_cabeza'));

    }

}

?>
