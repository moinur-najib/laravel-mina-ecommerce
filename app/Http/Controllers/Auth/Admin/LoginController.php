<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\Notification;
use App\Notifications\VerifyEmail;

use Authenticatesadmins;
use Auth;
use App\Models\Admin;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating admins for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    /**
     * Where to redirect admins after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm () {
        // dd("testtttt");
        return view('auth.admin.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email', 'max:30'],
            'password' => ['required'],
        ]);

        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            //Log him in now
            return redirect()->intended(route('admin.index'));
        } else {
            session()->flash('sticky_error', 'Invalid Login');
            return back();
        }
    }

    public function logout(Request $request)
    {
        // $this->guard()->logout();
        Auth::logout();
        // dd('eyweeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee');
        $request->session()->invalidate();

        return redirect()->route('admin.index');
    }
}
