<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestClass;
use App\Http\Requests\RequestTeacher;
use App\Model\Classes;
use App\Model\Teacher;
use function bcrypt;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStudent;
use App\Model\Student;
use App\Model\Subject;
use App\Http\Requests\RequestSubject;
use DB;
class Admin extends Controller
{
    public function listTeacher()
    {
        $data = Teacher::latest()->paginate(5);
        return view('admin.teacher.list',compact('data'));
    }

    public function addTeacher(RequestTeacher $request)
    {
        $data = $request->all();
        $teacher = new Teacher();
        $data->id => $data['id']
        $data->name => $data['name'],
        $data->birthday => $data['birthday'],
        $data->password => bcrypt($data['password']),
        'email' => $data['email'],
        $teacher->save();

        return redirect('admin/teacher/list-teacher')->with('success','Create Teacher Successfully');
    }

    public function editTeacher($id)
    {
        $data = Teacher::find($id);
        return view('admin.teacher.edit',['data' => $data]);
    }

    public function postEditTeacher($request, $id)
    {
        Teacher::find($id)->update($request->all());
        return redirect('admin/teacher/list-teacher')
            ->with('success','Teacher updated successfully');
    }

    public function deleteTeacher($id)
    {
        Teacher::find($id)->delete();
        return back()->with('success','Delete Successfully');
    }


    public function listStudent()
    {
        $data = Student::latest()->paginate(5);
        return view('admin.student.list',compact('data'));
    }

    public function addStudent(RequestStudent $request)
    {
        $teacher = Student::create($request->all());
        return redirect('admin/student/list-student')->with('success','Create Student Successfully');
    }

    public function editStudent($id)
    {
        $data = Student::find($id);
        return view('admin.student.edit',['data' => $data]);
    }

    public function postEditStudent(Request $request, $id)
    {
        Student::find($id)->update($request->all());
        return redirect('admin/student/list-student')
            ->with('success','Student updated successfully');
    }

    public function deleteStudent($id)
    {
        Student::find($id)->delete();
        return back()->with('success','Delete Successfully');
    }


    public function listSubject()
    {
        $data = Subject::latest()->paginate(5);
        return view('admin.subjects.list',compact('data'));
    }

    public function addSubject(RequestSubject $request)
    {
        $teacher = Subject::create($request->all());
        return redirect('admin/subject/list-subject')->with('success','Create Subject Successfully');
    }

    public function editSubject($id)
    {
        $data = Subject::find($id);
        return view('admin.subjects.edit',['data' => $data]);
    }

    public function postEditSubject(RequestSubject $request, $id)
    {
        Subject::find($id)->update($request->all());
        return redirect('admin/subject/list-subject')
            ->with('success','Subject updated successfully');
    }

    public function deleteSubject($id)
    {
        Subject::find($id)->delete();
        return back()->with('success','Delete Successfully');
    }


    public function listClass()
    {
        $data = Classes::latest()->paginate(5);
        return view('admin.class.list',compact('data'));
    }

    public function addClass(RequestClass $request)
    {
        DB::table('classes')->insert([
            'id' => $request->id,
            'subject_id' => $request->subject_id,
            'semester' => $request->semester,
            'teacher_id' => '1',
        ]);
        return redirect('admin/class/list-class')->with('success','Create Class Successfully');
    }

    public function editClass($id)
    {
        $data = Classes::find($id);
        return view('admin.class.edit',['data' => $data]);
    }

    public function postEditClass(RequestClass $request, $id)
    {
        Classes::find($id)->update($request->all());
        return redirect('admin/class/list-class')
            ->with('success','Class updated successfully');
    }

    public function deleteClass($id)
    {
        Classes::find($id)->delete();
        return back()->with('success','Delete Successfully');
    }
    //
}
