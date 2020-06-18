<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\Divisions;
use App\Models\District;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }
    /**
     * @override
     * showRegistrationForm
     * 
     * Display the registration form
     * @return void view
     */

    public function showRegistrationForm () {
        $divisions = Divisions::orderBy('priority', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();

        return view('auth.register', compact('divisions', 'districts'));
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name'    => ['required', 'string', 'max:30'],
            'last_name'     => ['required', 'string', 'max:15'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'division_id'   => ['required', 'numeric'],
            'district_id'   => ['required', 'numeric'],
            'phone_no'      => ['required', 'max:25'],
            'street_adress' => ['required', 'max:100'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => Str::slug($data['first_name'].$data['last_name']),
            'division_id' => $data['division_id'],
            'district_id' => $data['district_id'],
            'phone_no' => $data['phone_no'],
            'street_adress' => $data['street_adress'],
            'ip_address' => request()->ip(),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'remember_token' => Str::random(50),
            'status' => 0,
        ]);
        
        // session()->flash('success', 'A confirmed email has been sent to you. Please check your email and verify');
        // return route('index');
    }
}
