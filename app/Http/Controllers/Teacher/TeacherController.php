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

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('teacher');
    }

    public function classes() {
        $data = Classes::with('teacher')->with('subject')->paginate(5);
        return view('teacher.class.register_class',compact('data'));
    }

    public function listClass() {
        $teacher = Auth::guard('teacher')->user();
        $data = $teacher->classes()->with('subject')->paginate(5);
        return view('teacher.class.list-class', ['data' => $data]);
    }

    public function registerClass($id) {
        $classes = Classes::where('id','=',$id)->first();
        $teacher_id = Auth::guard('teacher')->user()->id;
        if($classes->teacher_id != 1 || $teacher_id == 1 || $classes->teacher_id == $teacher_id)
            return back()->with('danger', 'Class was registered by other teacher!!!!');
        DB::table('classes')->where('id', $id)->update(['teacher_id' => $teacher_id]);
        return redirect()->action('Teacher\TeacherController@listClass')->with('success', 'Register Class Successfully');
    }

    public function deleteClass($id)
    {
        DB::table('classes')->where('id', $id)->update(['teacher_id' => '1']);
        return back()->with('success', 'Class detele successfully!!');
    }

    public function listStudent($id) {
        $classes = Classes::where('id','=',$id)->first();
        $data = $classes->students;
        $classes_id = $id;
        return view('teacher/class/list-student', ['data' => $data, 'classes_id' => $classes_id]);
    }

    public function updateScore(Request $request, $id, $classes_id) {
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
        foreach($student->classes as $css)
        {
            if($css->pivot->class_id == $classes_id){
                $css->pivot->score = $request->score;
                $css->pivot->save();
            }
        }
        return redirect()->route('teacher.class.list-student', ['id' => $classes_id])
            ->with('success','Update Score Successfully!!');
    }

    public function searchClass(Request $request)
    {
        $class = Classes::Where('id', 'like', '%'.$request->nameOrId.'%')
            ->with('teacher')->with('subject')->paginate(5);
        if($class && $class->count() > 0){
            return view('teacher.class.register_class', ['data' => $class]);
        }

        $classByName = Subject::where('name', '=' , $request->nameOrId)->first();
        $class = Classes::Where('subject_id', '=', $classByName->id)
            ->with('teacher')->with('subject')->paginate(5);
        if($class && $class->count() > 0){
            return view('teacher.class.register_class', ['data' => $class]);
        }
        return redirect()->route('teacher.class')->withErrors('Data not exist!!!');
    }

    public function getUpdateInfo()
    {
        $teacher =  Auth::guard('teacher')->user();
        return view('teacher.update', ['data' => $teacher]);
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
        return back()->with('success', 'Password changed successfully!1');
    }


    //
}
