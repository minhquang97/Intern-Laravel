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
use Validator;
use function str_random;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;


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

    public function postEditTeacher(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $validator = Validator::make($request->all(), [
            'email' => ['required',
                Rule::unique('teachers')->ignore($teacher->id)
            ],
            'id' => ['required', 'min:3', 'numeric',
                Rule::unique('teachers')->ignore($teacher->id)
            ],
            'name' => 'required|max:50|min:5|max:255',
            'birthday' => 'required|date_format: "Y-m-d"',
            'password' => 'required|max:50|min:6',
        ],
            [
                'email.unique' => 'Duplicate Email!!',
                'id.unique' => 'Duplicate Id!!',
                'required' => ':attribute required!!',
                'date_format' => 'Hay nhap dung dinh dang',
                'max' => 'Nhap it thoi',
                'min' => ':attribute too short'
            ]);
        if($validator->fails())
        {
            return back()->withErrors($validator);
        }

        $teacher->id = $request->id;
        $teacher->name = $request->name;
        $teacher->birthday = $request->birthday;
        $teacher->password = bcrypt($request->password);
        if(strcmp($teacher->email,$request->email))
        {
            $teacher->email = $request->email;
            $teacher->status = 0;
            $teacher->email_token = str_random(15);
            $email = new TeacherVerification($teacher);
            Mail::to($teacher)->send($email);
        }
        $teacher->save();
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

    public function editStudent( $id)
    {
        $data = Student::find($id);
        return view('admin.student.edit',['data' => $data]);
    }

    public function postEditStudent(Request $request, $id)
    {

        $student = Student::find($id);
        $validator = Validator::make($request->all(), [
            'email' => ['required',
                Rule::unique('students')->ignore($student->id)
            ],
            'id' => ['required', 'min:3', 'numeric',
                Rule::unique('students')->ignore($student->id)
            ],
            'name' => 'required|max:50|min:5|max:255',
            'birthday' => 'required|date_format: "Y-m-d"',
            'class' => 'required',
            'password' => 'required|max:50|min:6',
            'address' => 'required',
        ],
            [
                'email.unique' => 'Duplicate Email!!',
                'id.unique' => 'Duplicate Id!!',
                'required' => ':attribute required!!',
                'date_format' => 'Hay nhap dung dinh dang',
                'max' => 'Nhap it thoi',
                'min' => ':attribute too short'
                ]);
        if($validator->fails())
        {
            return back()->withErrors($validator);
        }
        $student->id = $request->id;
        $student->name = $request->name;
        $student->class = $request->class;
        $student->birthday = $request->birthday;
        $student->password = bcrypt($request->password);
        $student->address = $request->address;
        if(strcmp($student->email, $request->email))
        {
            $student->email_token = str_random(15);
            $email = new StudentVerification($student);
            $student->email = $request->email;
            Mail::to($student)->send($email);
            $student->status = 0;
        }
        $student->save();

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

    public function postEditSubject(Request $request, $id)
    {
        $subject = Subject::find($id);
        $validator = Validator::make($request->all(), [
            'id' => ['min:1','required',
                Rule::unique('subjects')->ignore($subject->id)
                ],
            'name' => 'min:4|max:30|required',
            'semester' => 'numeric',
        ], [
            'unique' => 'Duplicate Id',
            'min' => 'too short!!',
            'numeric' => ':attribute must be number',
        ]);
        if($validator->fails())
            return back()->withErrors($validator);
        $subject->update($request->all());
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

    public function postEditClass(Request $request, $id)
    {
        $class = Classes::find($id);
        $validator = Validator::make($request->all(), [
            'semester' => 'numeric',
        ], [
            'numeric' => ':attribute must be number',
        ]);
        if($validator->fails())
            return back()->withErrors($validator);
        $class->semester = $request->semester;
        $class->save();
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
        $classes = $student->classes()->with('teacher')->with('subject')->orderBy('semester')->get();
        return view('admin.student.info', ['student' => $student, 'classStudents' => $classes]);
    }
    public function infoTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        $classes = DB::table('classes')->where('teacher_id', '=', $id)
            ->join('subjects','subjects.id','=','classes.subject_id')
            ->select('classes.*','subjects.name')->get();
        return view('admin.teacher.info', ['teacher' => $teacher,
                                                 'classes' => $classes,]);
    }
    public function infoSubject($id)
    {
        $subject = Subject::findOrFail($id);
        $classes =  $subject->classes()->with('students')->with('teacher')->get();
        return view('admin.subjects.info',[
            'subject' => $subject,
            'classes' => $classes,
        ]);
    }
    public function infoClass($id)
    {
        $class = Classes::findOrFail($id);
        $students = $class->students()->orderBy('students.name')->get();
        return view('admin.class.info', ['class' => $class,
            'students' => $students,
            'i' => 0,
        ]);
    }
    public function findAvg($id, Request $request)
    {
        $student = Student::where('id','=',$id)->first();
        $classes = $student->classes()->where('semester','=',$request->semester)
            ->with('teacher')->with('subject')->get();
        $i = 0;
        $avg = 0;
        foreach($classes as $class)
        {
            $i++;
            if($class->pivot->score >= 0)
                $avg += $class->pivot->score;
        }
        if($i == 0)
        {
            return back()->with('danger', 'Semester is not exist!!');
        }
        $avg = $avg/$i;
        return view('admin.student.info')->with(['classStudents' => $classes,
                             'avg' => $avg,
                             'success' => 'Successfully',
                                'student' => $student,
                            ]);
    }

    public function searchStudent(Request $request)
    {
        $student = Student::where('id', 'like', '%'.$request->nameOrId.'%')
            ->orWhere('name', 'like', '%'.$request->nameOrId.'%')->orWhere('class', 'like', '%'.$request->nameOrId.'%')
            ->select('students.*')->paginate(5);
        if($student && $student->count() >0){
            return view('admin.student.list', ['data' => $student]);
        }
        return redirect()->route('admin.student.list-student')->withErrors('Data not exist!!!');
    }

    public function searchTeacher(Request $request)
    {
        $teacher = Teacher::where('id', 'like', '%'.$request->nameOrId.'%')
            ->orWhere('name', 'like', '%'.$request->nameOrId.'%')
            ->select('teachers.*')->paginate(5);
        if($teacher && $teacher->count() >0){
            return view('admin.teacher.list', ['data' => $teacher]);
        }
        return redirect()->route('admin.teacher.list-teacher')->withErrors('Data not exist!!!');
    }

    public function searchClass(Request $request)
    {
        $class = DB::table('classes')->join('subjects','subjects.id','=','classes.subject_id')
            ->Where('classes.id', 'like', '%'.$request->nameOrId.'%')
            ->orWhere('subjects.name', 'like', '%'.$request->nameOrId.'%')->orWhere('semester', '=', $request->nameOrId)
            ->select('classes.*')->paginate(5);
        if($class && $class->count() > 0){
            return view('admin.class.list', ['data' => $class]);
        }
        return redirect()->route('admin.class.list-class')->withErrors('Data not exist!!!');
    }

    public function searchSubject(Request $request)
    {
        $subject = Subject::Where('id', 'like', '%'.$request->nameOrId.'%')
            ->orWhere('name', 'like', '%'.$request->nameOrId.'%')
            ->select('subjects.*')->paginate(5);
        if($subject && $subject->count() > 0){
            return view('admin.subjects.list', ['data' => $subject]);
        }
        return redirect()->route('admin.subject.list-subject')->withErrors('Data not exist!!!');
    }
    
}
