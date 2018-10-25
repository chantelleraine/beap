<?php

namespace App\Http\Controllers\DirectorAuth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class DirectorLoginController extends Controller
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:director',['except' => ['directorLogout']]);
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('directorsauth.directorsLogin');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::guard('director')->attempt(['username' => $request->username,
            'password' => $request->password], $request->remember))
        {
            return redirect()->intended(route('director.dashboard'));
        }
        session()->flash('alert','Incorrect username/password!');
        return redirect()->back()->withInput($request->only('username','remember'));
    }

    public function directorLogout()
    {
        Auth::guard('director')->logout();
        //return redirect('/');
        return redirect(\URL::previous());
    }
}
