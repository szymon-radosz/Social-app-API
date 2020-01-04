<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create(); will save data to db
        //make(); will create data without saving
        factory(App\User::class, 10)->create();
    }
}
