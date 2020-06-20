<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Notification;
use App\Notifications\VerifyEmail;

use Auth;
use App\User;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => ['required', 'email', 'max:30'],
            'password' => ['required'],
        ]);
        // Find User by this email

        $user = User::where('email', $request->email)->first();
        if (!is_null($user)){
            if ($user->status == 1) {
            
                if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                    //Log in now
                    return redirect()->intended(route('index'));
                } else {
                    session()->flash('sticky_error', 'Invalid Login');
                    return back();
                }
            } else {
                // Send him a token again
                if (!is_null($user)) {
                    $user->notify(new VerifyEmail($user));

                    session()->flash('success', 'A new confirmation email has been sent to you. Please check your email and verify');
                    return redirect()->route('login');
                }
            }
        } else {
            session()->flash('sticky_error', 'Invalid Login');
            return back();
        }
    }
}
