<?php

namespace App\Http\Controllers\Teacher\Auth;

use App\Http\Controllers\Controller;
use App\Model\Teacher;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/teacher/home';

    /**
     * Create a new controller instance.
     *
     * @return
     */
    protected function guard()
    {
        return Auth::guard('teacher');
    }

    public function showLoginForm()
    {
        return view('teacher.auth.login');
    }

    public function authenticate(Request $request)
    {
        $remember = $request->has('remember_token') ? true : false;
        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => '1'], $remember)) {
            // Authentication passed...
            return redirect()->intended(route('teacher.home'));
        }
        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => '0'], $remember)) {
            // Authentication passed...
            return redirect()->route('teacher.login')->withErrors('Account not active!!!!');
        }
        return redirect()->route('teacher.login')->withErrors('Email or password incorrect!!');
    }

    public function verify($token)
    {
        Teacher::where('email_token', '=', $token)->firstOrFail()->verified();
        return redirect()->route('teacher.login')->with('success','Your account has been activated!!');
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect('teacher/login');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
