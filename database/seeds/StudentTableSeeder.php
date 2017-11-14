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
            'name' => 'Minh Quang',
            'email' => 'minhquang4334@gmail.com',
            'birthday' => '1997-04-03',
            'class' => 'K60C',
            'address' => 'HN VN',
            'id' => '20152945',
            'password' => bcrypt('123456'),
        ]);
        //
    }
}
