<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class VerificationController extends Controller
{
    public function verify ($token) {
        $user = User::where('remember_token', $token)->first();

        if (!is_null($user)) {
            $user->status = 1;
            $user->remember_token = NULL;
            session()->flash('success', 'You are registered successfully!Login now');
            return redirect('login');
        } else {
            session()->flash('errors', 'Sorry, your token is not matched');
            return redirect('/');
        }
    }
}
