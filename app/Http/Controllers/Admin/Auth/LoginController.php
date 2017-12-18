<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\ValidationException;
use function redirect;

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
    protected $redirectTo = '/admin/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    /**
     * Create a new controller instance.
     *
     * @return
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {

        $remember = $request->has('remember_token') ? true : false;
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            // Authentication passed...
            return redirect()->intended('admin/home');
        }
        return back()->withErrors('Login Failed!!');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect()->route('admin.login');
    }


}
