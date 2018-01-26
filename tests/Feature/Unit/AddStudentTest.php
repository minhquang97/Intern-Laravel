<?php

namespace Tests\Feature\Unit;

use App\Model\Student;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddStudentTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testAddStudent()
    {
        $student = new Student(['name' => 'Super Man']);
        $this->assertEquals('Super Man', $student['name']);
    }


    
}
