<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Model\Teacher;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Student;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/student/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('student');
    }

    public function showLoginForm()
    {
        if(Auth::guard('student')->check())
            return redirect()->route('student.home');
        return view('student.auth.login');
    }
    public function authenticate(Request $request)
    {
        $remember_token = $request->has('remember_token') ? true : false;
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => '1'])) {
            // Authentication passed...
            return redirect()->intended(route('student.home'));
        }
        return redirect()->route('student.login')->withErrors('Email or password incorrect!!');
    }

    public function verify($token)
    {
        Student::where('email_token', '=', $token)->firstOrFail()->verified();
        return redirect()->route('teacher.login')->with('success','Your account has been activated!!');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect()->route('student.login');
    }


}
