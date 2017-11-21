<?php

use Illuminate\Database\Seeder;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->insert([
            'name' => 'Minh Quang Student',
            'email' => 'quanghm@haposoft.com',
            'birthday' => '1997-04-03',
            'class' => 'K60C',
            'address' => 'HN VN',
            'id' => '20152945',
            'password' => bcrypt('123456'),
            'status' => '0',
        ]);
        //
    }
}
