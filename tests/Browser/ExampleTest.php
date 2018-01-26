<?php

namespace Tests\Browser;

use App\Model\Student;
use function bcrypt;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $student = Student::create([
            'id' => '1232123',
            'name' => 'Super Man',
            'birthday' => '1992-01-01',
            'email' => 'haivkl1@gmail.com',
            'address' => 'Ha Noi - Viet Nam',
            'class' => '10A1',
            'password' => bcrypt('123456'),
            'status' => '1'
    ]);

        $this->browse(function ($browser) {
            $browser->visit('/admin/student/list-student')
                ->assertSee('Super Man');
        });
    }
}
