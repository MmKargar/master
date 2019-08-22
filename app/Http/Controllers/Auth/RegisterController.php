<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'n_code' => ['required', 'digits:10'],
            'mobile' => ['required', 'digits:11'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    // protected function register(Request $request){
    //  return request();
    //     $this->validate(request() , [
    //     'first_name' => 'required|string|max:191',
    //     'last_name' => ['required', 'string', 'max:191'],
    //     'n_code' => ['required', 'digits:10'],
    //     'mobile' => ['required', 'digits:11'],
    //     'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
    //     'password' => ['required', 'string', 'min:8', 'confirmed'],

    //  ]); 
    //  return User::create([
    //     'first_name' => $data['first_name'],
    //     'last_name' => $data['last_name'],
    //     'mobile' => $data['mobile'],
    //     'n_code' => $data['n_code'],
    //     'email' => $data['email'],
    //     'password' => Hash::make($data['password']),
    // ]);
    // }

    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile' => $data['mobile'],
            'n_code' => $data['n_code'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    
    protected function register(Request $request){
        $this->validator($request->all());
        $user = $this->create($request->all());
        $user->assignRole('reg_user');
        // Auth::logout();
        return 'user created';
    }

    protected function check_signup(){
        $field = request()->field;
        if($field=='email'){
            $user = User::where('email' , request()->value )->get();
            if(count($user) > 0){
                return 'false';
            }
        }
        if($field=='n_code'){
            $user = User::where('n_code' , request()->value )->get();
            if(count($user) > 0){
                return 'false';
            }
        }        
        if($field=='mobile'){
            $user = User::where('mobile' , request()->value )->get();
            if(count($user) > 0){
                return 'false';
            }
        }
        return 'true';
    }

}