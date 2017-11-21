<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStudent;
use App\Model\Classes;
use App\Model\Student;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('student');
    }

    public function classes() {
        $data = Classes::latest()->paginate(5);
        return view('student.class.register_class',compact('data'));
    }

    public function listClass() {
        $student = Auth::guard('student')->user();
        $data = $student->classes;
        return view('student.class.list-class', ['data' => $data]);
    }
    public function registerClass($id) {
        $student = Auth::guard('student')->user();
        $classes = $student->classes;
        $css = Classes::find($id);
        foreach($classes as $class)
        {
            if($class->id == $id) return back()->with('danger','Class already registered!!');
            else if($class->subject_id == $css->subject_id)
            {
                return back()->with('danger', 'Subject already registered!! You can not register two class with same subject!!');
            }
        }

        $student->classes()->attach($id, ['score' => -1]);
        return redirect()->route('student.class.list-class')->with('success', 'Register Class Successfully');
    }

    public function deleteClass($id) {
        $student = Auth::guard('student')->user();
        $class = Classes::where('id','=',$id)->first();
        $student->classes()->detach($class->id);
        return back()->with('success', 'Class delete successfully');
    }

}