<?php

namespace App\Http\Controllers;

use App\Models\GuestLogin;
use App\Models\GuestPassReset;
use App\Notifications\GuestPassResetNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Notification;

class GuestController extends Controller
{
    //
    function guest_register(){
        return view('Frontend.guest_register');
    }
    function guest_store(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:guest_logins',
            'password'=>'required|min:8',
        ],
        [   'name'=>'ভাই ক্যাটাগরি দেন',
         'email.required'=>'email is required',
         'email.unique'=>'Email should Be Unique',
         'password.required'=>'Password Required',
         'password.min'=>'password must Be 8 characters',

        ]);
        GuestLogin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/homepage');
        }

    }
    function guest_login(){
       return view('Frontend.guest_login');
    }
    function guest_login_confirm(Request $request){
        $request->validate([

            'email'=>'required',
            'password'=>'required|min:8',
        ],
        [
         'email.required'=>'email is required',

         'password.required'=>'Password Required',
         'password.min'=>'password must Be 8 characters',

        ]);
        if(Auth::guard('guestlogin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('/homepage');
        }else{
            return back()->with('success','Username Or Password Is Not Correct');
        }
    }
    function logout_guest(){
        Session::flush();

        Auth::logout();

        return redirect('/homepage');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback(){

        $user = Socialite::driver('google')->user();
        print_r($user);
    }
    function redirect_provider(){
        return Socialite::driver('google')->redirect();
    }
    function provider_to_application(){
                $user = Socialite::driver('google')->user();

                if(GuestLogin::where('email',$user->getEmail())->exists()){
                    if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(),'password'=>'abc@123'])){
                        return redirect()->route('homepage');
                    }
                }else{
                    GuestLogin::create([
                     'name'=>$user->getName(),
                     'email'=>$user->getEmail(),
                     'password'=>bcrypt('abc@123'),

                    ]);
                    if(Auth::guard('guestlogin')->attempt(['email'=>$user->getEmail(),'password'=>'abc@123'])){
                        return redirect()->route('homepage');
                    }
                }
    }
    public function guest_pass_reset_req(){
        return view('Frontend.guest_pass_reset_form');
    }
    public function guest_pass_req_send(Request $request){
        $guest_info = GuestLogin::where('email',$request->email)->firstOrFail();
        GuestPassReset::where('guest_id',$guest_info->id)->delete();

        $guest_inserted = GuestPassReset::create([
            'guest_id'=>$guest_info->id,
            'token'=>uniqid(),

        ]);

        Notification::send($guest_info, new GuestPassResetNotification($guest_inserted));
        return back();
    }
    public function guest_pass_reset_form($token){
        return view('Frontend.pass_reset_form',[
            'token'=>$token,
        ]);
    }
    function guest_pass_reset_confirm(Request $request){
       $guest_token =  GuestPassReset::where('token',$request->token)->firstOrFail();
       GuestLogin::findOrFail($guest_token->guest_id)->update([
        'password'=>bcrypt($request->password)
       ]);
       $guest_token->delete();
       return back();
    }

}
