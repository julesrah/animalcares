<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Customer;
use App\Models\Employee;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Events\SendMail;
use Event;
use App\Listeners\SendMailFired;

// use Illuminate\Http\Request;


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

    /*
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /*
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /*
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'addressline' => ['required', 'string', 'max:255'],
            'town' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /*
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $request = request();
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $destinationPath = public_path().'/images' ;
        // $input['img_path'] = 'images/'.$fileName; 
        $path = 'images/'.$fileName;   
        $file->move($destinationPath,$fileName);

        if ($data['P_Role'] == "Customer") {
        $user = User::create([
            'name' => $data['fname'].' '.$data['lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roles' => $data['P_Role'],
        ]);

        Customer::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'lname' => $data['lname'],
            'fname' => $data['fname'],
            'addressline' => $data['addressline'],
            'town' => $data['town'],
            'zipcode' => $data['zipcode'],
            'phone' => $data['phone'],
            'img_path' => $path,
        ]);

        Event::dispatch(new SendMail($user));

        }elseif ($data['P_Role'] == "Employee") {
        $user = User::create([
            'name' => $data['fname'].' '.$data['lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'roles' => $data['roles'],
            'roles' => $data['P_Role'],
        ]);

        Employee::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'lname' => $data['lname'],
            'fname' => $data['fname'],
            'addressline' => $data['addressline'],
            'town' => $data['town'],
            'zipcode' => $data['zipcode'],
            'phone' => $data['phone'],
            'role' => $data['P_Role'],
            'img_path' => $path,
        ]);

        }elseif ($data['P_Role'] == "Administrator") {

        $user = User::create([
            'name' => $data['fname'].' '.$data['lname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'roles' => $data['roles'],
            'roles' => $data['P_Role'],
        ]);

        Employee::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'lname' => $data['lname'],
            'fname' => $data['fname'],
            'addressline' => $data['addressline'],
            'town' => $data['town'],
            'zipcode' => $data['zipcode'],
            'phone' => $data['phone'],
            'role' => $data['P_Role'],
            'img_path' => $path,

        ]);

        }

        else{

        }
        return $user;
    }
}