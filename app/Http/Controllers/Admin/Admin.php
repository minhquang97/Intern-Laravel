<?php

namespace App\Http\Controllers\Admin;

use App\Model\Teacher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStudent;
use function view;

class Admin extends Controller
{
    public function listTeacher()
    {
        $data = Teacher::latest()->paginate(10);
        return view('admin.teacher.list',compact('data'));
    }

    public function addTeacher(RequestStudent $request)
    {
        $teacher = Teacher::create($request->all());
        return redirect()->route('teacher')->with('success','Create Teacher Successfully');
    }

    public function editTeacher($id)
    {
        $data = Teacher::find($id);
        return view('admin.teacher.edit',['data' => $data]);
    }

    public function postEditTeacher(RequestStudent $request)
    {
        Teacher::find($request->id)->update($request->all());
        return redirect()->route('teacher')
            ->with('success','Student updated successfully');
    }
    //
}
