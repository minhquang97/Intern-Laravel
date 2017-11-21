<?php

use Illuminate\Database\Seeder;

class TeacherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teachers')->insert([
            'name' => 'Hoang Minh Quang Teacher',
            'email' => 'quanghm@haposoft.com',
            'id' => '1',
            'birthday' => '1990-02-02',
            'password' => bcrypt('123456'),
            'status' => '0',
        ]);
        //
    }
}
