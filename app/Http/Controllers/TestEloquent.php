<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Student;
use App\Model\Teacher;
use App\Model\Subject;
use App\Model\Classes;

use DB;

class TestEloquent extends Controller
{
	public function testdb()
	{
	$teacher = Teacher::find(1);
	foreach ($teacher->classes as $class) {
		echo $class->semester;
		# code...
	}
	# code...
	}	
    //
}
