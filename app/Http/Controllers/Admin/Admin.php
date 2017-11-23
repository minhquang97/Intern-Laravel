<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestClass;
use App\Http\Requests\RequestTeacher;
use App\Mail\StudentVerification;
use App\Mail\TeacherVerification;
use App\Model\Classes;
use App\Model\Teacher;
use function bcrypt;
use function count;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStudent;
use App\Model\Student;
use App\Model\Subject;
use App\Http\Requests\RequestSubject;
use DB;
use function str_random;
use Illuminate\Support\Facades\Mail;


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
        $teacher->id = $data['id'];
        $teacher->name = $data['name'];
        $teacher->birthday = $data['birthday'];
        $teacher->password = bcrypt($data['password']);
        $teacher->email = $data['email'];
        $teacher->email_token = str_random(15);
        $email = new TeacherVerification($teacher);
        Mail::to($teacher)->send($email);
        $teacher->save();
        return redirect()->route('admin.teacher.list-teacher')->with('success','Create Teacher Successfully');
    }

    public function editTeacher($id)
    {
        $data = Teacher::find($id);
        return view('admin.teacher.edit',['data' => $data]);
    }

    public function postEditTeacher($request, $id)
    {
        Teacher::find($id)->update($request->all());
        return redirect()->route('admin.teacher.list-teacher')
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
        $data = $request->all();
        $student = new Student();
        $student->id = $data['id'];
        $student->name = $data['name'];
        $student->birthday = $data['birthday'];
        $student->password = bcrypt($data['password']);
        $student->email = $data['email'];
        $student->address = $data['address'];
        $student->class = $data['class'];
        $student->email_token = str_random(15);
        $email = new StudentVerification($student);
        Mail::to($student)->send($email);
        $student->save();
        return redirect()->route('admin.student.list-student')->with('success','Create Student Successfully');
    }

    public function editStudent($id)
    {
        $data = Student::find($id);
        return view('admin.student.edit',['data' => $data]);
    }

    public function postEditStudent(Request $request, $id)
    {
        Student::find($id)->update($request->all());
        return redirect()->route('admin.student.list-student')
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
        return redirect()->route('admin.subject.list-subject')->with('success','Create Subject Successfully');
    }

    public function editSubject($id)
    {
        $data = Subject::find($id);
        return view('admin.subjects.edit',['data' => $data]);
    }

    public function postEditSubject(RequestSubject $request, $id)
    {
        Subject::find($id)->update($request->all());
        return redirect()->route('admin.subject.list-subject')
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
        return redirect()->route('admin.class.list-class')->with('success','Create Class Successfully');
    }

    public function editClass($id)
    {
        $data = Classes::find($id);
        return view('admin.class.edit',['data' => $data]);
    }

    public function postEditClass(RequestClass $request, $id)
    {
        Classes::find($id)->update($request->all());
        return redirect()->route('admin.class.list-class')
            ->with('success','Class updated successfully');
    }

    public function deleteClass($id)
    {
        Classes::find($id)->delete();
        return back()->with('success','Delete Successfully');
    }

    public function infoStudent($id)
    {
        $student = Student::where('id','=',$id)->first();
        $classStudent = DB::table('student_class')->join('classes', 'student_class.class_id', '=', 'classes.id')
           ->where('student_id', '=', $id)->orderBy('semester')->get();
        return view('admin.student.info', ['student' => $student, 'classStudents' => $classStudent]);
    }
    public function infoTeacher($id)
    {
        $teacher = Teacher::find($id);
        $classes = DB::table('classes')->where('teacher_id', '=', $id)->get();
        return view('admin.teacher.info', ['teacher' => $teacher,
                                                 'classes' => $classes,]);
    }

    public function findAvg($id, Request $request)
    {
        $student = Student::where('id','=',$id)->first();
        $classStudent = DB::table('student_class')->join('classes', 'student_class.class_id', '=', 'classes.id')
            ->where('student_id', '=', $id)->where('semester', '=', $request->semester)->get();
        $i = 0;
        $avg = 0;
        foreach($classStudent as $class)
        {
            $i++;
            if($class->score >= 0)
                $avg += $class->score;
        }
        if($i == 0)
        {
            return back()->with('danger', 'Semester is not exist!!');
        }
        $avg = $avg/$i;
        return view('admin.student.info')->with(['classStudents' => $classStudent,
                             'avg' => $avg,
                             'success' => 'Successfully',
                                'student' => $student,
                            ]);
    }
    //
}
