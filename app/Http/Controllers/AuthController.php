<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function register(){
        return view("auth/register");
    }
    public function registerSave(Request $request)
    {
       //dd($request->all());
       $validator=Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        //if ($validator->fails()) {
        //    return redirect()->back()
        //        ->withErrors($validator)
        //        ->withInput();
        //}
        
 
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => "0"
        ]);
 
        return redirect()->route('login');
    }
    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',

            ],
            [
                    'email.required' => 'The email field is required.',
                    'password.required' => 'The password field is required.',
                    'email.email' => 'Please enter a valid email address.',
                ]
            );
        //$validatedData = $request->validate([
        //    'email' => 'required|email',
        //    'password' => 'required',
        //], [
        //    'email.required' => 'The email field is required.',
        //    'email.email' => 'Please enter a valid email address.',
        //]);
        ////this inclued user data with user model1100..2.233
        //Validator::make($request->all(), [
        //    'email' => 'required|email',
        //    'password' => 'required']
        //    , [
        //        'email.required' => 'The email field is required.',
        //        'email.email' => 'Please enter a valid email address.',
        //])->validate();
            
        //check login or not
        //if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
        //    throw ValidationException::withMessages([
        //        'email' => trans('auth.failed')
        //    ]);
        //}
        
        //After authentication or  after user login
        $request->session()->regenerate();
        if (auth()->user()->type == 'admin') {
            return redirect()->route('admin/home');//Go to web.php to route with middleware (compact with user()->type)
        } else {
            return redirect()->route('home');//Go to web.php to route with middleware
        }
         
       // return redirect()->route('home');
    }

    public function logout(Request $request)
    {
       
        Auth::guard('web')->logout();
 
        $request->session()->invalidate();
 
        return redirect('/login');
    }












}
