<?php

namespace App\Http\Controllers\Teacher;

use App\Model\Classes;
use App\Model\Student;
use App\Model\Subject;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('teacher');
    }

    public function classes() {
        $classes = Classes::with('teacher')->with('subject')->paginate(5);
        return view('teacher.class.register_class',compact('classes'));
    }

    public function listClass() {
        $teacher = Auth::guard('teacher')->user();
        $data = $teacher->classes()->with('subject')->paginate(5);
        return view('teacher.class.list-class', ['data' => $data]);
    }

    public function registerClass($id) {
        $classes = Classes::where('id','=',$id)->firstOrFail();
        $teacher_id = Auth::guard('teacher')->user()->id;
        if($classes->teacher_id != 1 || $teacher_id == 1)
            return back()->with('danger', 'Class was registered by other teacher!!!!');
        if($classes->teacher_id == $teacher_id)
            return back()->withErrors('You were registered this class!!!');
        DB::table('classes')->where('id', $id)->update(['teacher_id' => $teacher_id]);
        return redirect()->action('Teacher\TeacherController@listClass')->with('success', 'Register Class Successfully');
    }

    public function deleteClass($id)
    {
        $class = Classes::where('id',$id)->firstOrFail();
        $teacher = Auth::guard('teacher')->user();
        if($class->teacher_id != $teacher->id)
            return back()->withErrors('Permission denied!!');
        $class->teacher_id = 1;
        $class->save();
        return back()->with('success', 'Class detele successfully!!');
    }

    public function listStudent($id) {
        $class = Classes::where('id','=',$id)->firstOrFail();
        return view('teacher/class/list-student', ['class' => $class]);
    }

    public function updateScore(Request $request, $id, $classesId) {
        $validator = Validator::make($request->all(), [
            'score' => 'required|integer|between:0,10',
        ],
       [
           'score.required' => 'Score is required!!',
           'score.between' => 'Score must between 0 and 10',
       ]);
        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $student = Student::where('id','=',$id)->first();
        foreach($student->classes as $class)
        {
            if($class->pivot->class_id == $classesId){
                $class->pivot->score = $request->score;
                $class->pivot->save();
            }
        }
        return redirect()->route('teacher.class.list-student', ['id' => $classesId])
            ->with('success','Update Score Successfully!!');
    }

    public function searchClass(Request $request)
    {
        $classes = Classes::Where('id', 'like', '%'.$request->nameOrId.'%')
            ->with('teacher', 'subject')->paginate(5);
        if($classes && $classes->count() > 0){
            return view('teacher.class.register_class', ['classes' => $classes]);
        }

        $class = Classes::with([
            "subject" => function($query) {

            }
        ]);
        dd($class);
        if($class && $class->count() > 0){
            return view('teacher.class.register_class', ['classes' => $class]);
        }
        return redirect()->route('teacher.class')->withErrors('Data not exist!!!');
    }

    public function getUpdateInfo()
    {
        $teacher =  Auth::guard('teacher')->user();
        return view('teacher.update', ['teacher' => $teacher]);
    }

    public function updateInfo(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();
        $validator = Validator::make($request->all(), [
            'email' => ['required',
                Rule::unique('teachers')->ignore($teacher->id)
            ],
            'name' => 'required|max:50|min:5|max:255',
            'birthday' => 'required|date_format: "Y-m-d"',
        ],
            [
                'email.unique' => 'Duplicate Email!!',
                'required' => ':attribute required!!',
                'date_format' => 'Hay nhap dung dinh dang',
                'max' => 'Nhap it thoi',
                'min' => ':attribute too short'
            ]);
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        $teacher->birthday = $request->birthday;
        $teacher->save();
        return redirect()->route('teacher.home')->with(['success' => 'Update Info Successfully!!']);
    }
    public function changePassword()
    {
        return view('teacher.auth.change_password');
    }
    public function postChangePassword(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();
        if(!(Hash::check($request->get('current-password'), $teacher->password)))
        {
            return back()->withErrors('Current password does not match!!');
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0)
        {
            return back()->withErrors('New password can not same current password!!');
        }

        $validator = Validator::make($request->all(), [
            'current-password' => 'required|min:6',
            'new-password' => 'required|min:6|confirmed',
        ],
            [
                'required' => ':attribute required!!',
                'min' => 'Password must more than 6 letters',
                'confirmed' => 'New password must be confirmed',
            ]);
        if($validator->fails()) return back()->withErrors($validator);

        $teacher->password = bcrypt($request->get('new-password'));
        $teacher->save();
        return back()->with('success', 'Password changed successfully!!');
    }


    //
}
