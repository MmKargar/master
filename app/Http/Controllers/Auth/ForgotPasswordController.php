<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Ipecompany\Smsirlaravel\Smsirlaravel;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function mobexist(Request $request){
        $mobile = $request->value;
        $user = User::where('mobile' , $mobile)->get();
        if(count($user) > 0){
            return 'true';
        }
        return 'false';
    }

    public function sendcode(Request $request){
        $user = User::where('mobile' , $request->mobile)->first();
        if($user){
            $code = explode('-',  Str::uuid());
            $code = $code[0];
            $user->sms_code = $code; 
            $user->save();
            Smsirlaravel::send(["کد امنیتی بومان : $code \n booman.ir"] , ["$user->mobile"]);
            return 'true';
        }
        return 'user not found';
    }

    public function confirm_code(Request $request){
        $mobile = $request->mobile;
        $code = $request->code;
        $user= User::where('mobile' , $mobile)->first();
        if($user){
            if($user->sms_code == $code){
                //validated
                $pass = explode('-' , (string)Str::uuid() );
                $pass = $pass[0];
                $user->password =  Hash::make($pass);
                $user->save();
                Smsirlaravel::send(["کلمه عبور با موفقیت تغییر کرد \n نام کاربری: $user->mobile \n کلمه عبور: $pass \n Booman.ir"] , ["$user->mobile"]);
                return 'true';                
            }else{
                return 'false';
            }
        }
        return 'user not found';
    }
}
