<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStudent;
use App\Model\Student;
use Illuminate\Http\Request;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
      /*  $students = Student::latest()->paginate(10);
        return view('student.index', ['students' => $students]);*/

         $students = Student::latest()->paginate(5);
        return view('student.index',compact('students'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudent  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStudent $request)
    {
        Student::create($request->all());
        return redirect()->route('student.index')
                        ->with('success','Student created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('student.show',compact('student'));
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        return view('student.edit',compact('student'));
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStudent $request, $id)
    {
        Student::find($id)->update($request->all());
        return redirect()->route('student.index')
         ->with('success','Student updated successfully');
        //
    }

    public function search(Request $request)
    {
        $search = $request->id;
        $student = Student::find($search);
        if(empty($search))
            return redirect()->route('student.index')->with('danger','Please input for search student!!');
        else if(empty($student)) return  redirect()->route('student.index')->with('danger','Student does not exist!!');
        return view('student.show',compact('student'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

  /*  public function search($name) 
    {

    }*/
    public function destroy($id)
    {
         Student::find($id)->delete();
        return redirect()->route('student.index')
                ->with('success','Student deleted successfully');
        //
    }
}