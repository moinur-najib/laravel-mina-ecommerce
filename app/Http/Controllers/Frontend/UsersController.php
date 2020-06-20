<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\divisions;
use App\Models\district;
use App\User;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard () {
        $user = Auth::user();
        return view('frontend.pages.users.dashboard', compact('user'));
    }

    public function profile () {
        $user = Auth::user();

        $divisions = Divisions::orderBy('priority', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();

        return view('frontend.pages.users.profile', compact('user', 'divisions', 'districts'));
    }

    public function profileUpdate (Request $request) {
        $user = Auth::user();

        $this->validate($request, [
            'first_name'    => ['required', 'string', 'max:30'],
            'last_name'     => ['required', 'string', 'max:15'],
            'username'         => ['required', 'alpha_dash', 'max:100', 'unique:users,username,'.$user->id],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'division_id'   => ['required', 'numeric'],
            'district_id'   => ['required', 'numeric'],
            'phone_no'      => ['required', 'max:25', 'unique:users,phone_no,'.$user->id],
            'street_adress' => ['required', 'max:100'],
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->phone_no = $request->phone_no;
        $user->street_adress = $request->street_adress;
        $user->shipping_adress = $request->shipping_adress;
        if($request->password != NULL || $request->password != "") {
            $user->password = Hash::make($request->password);
        }
        $user->ip_adress = request()->ip();
        
        $user->save();
        session()->flash('sucess', 'User profile has been updated successfully!');
        return redirect('/user/dashboard');
    }
}
