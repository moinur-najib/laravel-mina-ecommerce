<?php

namespace App\Http\Controllers\Auth\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct() 
    {
        $this->middleware('guest:admin');
    }

    public function showLinkRequestForm () {
        return view('auth.admin.password.email');
    }

    /**
     * Get the broker to be used during password reset
     * 
     * @return \Illuminate\Contracts\Auth\PassswordBroker
     */

     public function broker() {
         return Password::broker('admins');
     }
}
