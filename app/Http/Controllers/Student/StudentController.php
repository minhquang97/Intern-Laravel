<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestStudent;
use App\Http\Requests\RequestUpdateStudent;
use App\Model\Classes;
use App\Model\Student;
use App\Model\Subject;
use function bcrypt;
use Hash;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Validator;

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
        $data = Classes::with('teacher')->with('subject')->paginate(5);
        return view('student.class.register_class',compact('data'));
    }

    public function listClass() {
        $student = Auth::guard('student')->user();
        $data = $student->classes()->with('subject')->with('teacher')->get();
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
        if($student->classes()->where('class_id','=',$id)->first()->score == -1)
        {
            return back()->withErrors('You can\'t delete this class. Over time!!');
        }
        $student->classes()->detach($class->id);
        return back()->with('success', 'Class delete successfully');
    }

    public function searchClass(Request $request)
    {
        $class = Classes::Where('id', 'like', '%'.$request->nameOrId.'%')
            ->with('teacher')->with('subject')->paginate(5);
        if($class && $class->count() > 0){
            return view('student.class.register_class', ['data' => $class]);
        }

        $classByName = Subject::where('name', '=' , $request->nameOrId)->first();
        $class = Classes::Where('subject_id', '=', $classByName->id)
            ->with('teacher')->with('subject')->paginate(5);
        if($class && $class->count() > 0){
            return view('student.class.register_class', ['data' => $class]);
        }
        return redirect()->route('student.class')->withErrors('Data not exist!!!');
    }

    public function getUpdateInfo()
    {
        $student =  Auth::guard('student')->user();
        return view('student.update', ['data' => $student]);
    }

    public function updateInfo(Request $request)
    {
        $student = Auth::guard('student')->user();
        $validator = Validator::make($request->all(), [
            'email' => ['required',
                Rule::unique('students')->ignore($student->id)
                ],
            'name' => 'required|max:50|min:5|max:255',
            'birthday' => 'required|date_format: "Y-m-d"',
            'class' => 'required',
            'address' => 'required',
        ],
            [
                'email.unique' => 'Duplicate Email!!',
                'required' => ':attribute required!!',
                'date_format' => 'Hay nhap dung dinh dang',
                'max' => 'Nhap it thoi',
                'min' => ':attribute too short'
            ]);
        $student->name = $request->name;
        $student->email = $request->email;
        $student->birthday = $request->birthday;
        $student->address = $request->address;
        $student->class = $request->class;
        $student->save();
        return redirect()->route('student.home')->with(['success' => 'Update Info Successfully!!']);
    }

    public function changePassword()
    {
        return view('student.auth.change_password');
    }
    public function postChangePassword(Request $request)
    {
        $student = Auth::guard('student')->user();
        if(!(Hash::check($request->get('current-password'), $student->password)))
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

        $student->password = bcrypt($request->get('new-password'));
        $student->save();
        return back()->with('success', 'Password changed successfully!1');
    }

}