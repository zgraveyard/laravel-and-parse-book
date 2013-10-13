<?php

class UsersTableSeeder extends Seeder{

    public function run()
    {
        User::create(array(
            'email' => 'test@localhost.com',
            'password' => Hash::make('123456789')
        ));
    }

}