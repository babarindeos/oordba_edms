<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class Staff_AuthController extends Controller
{
    //

    public function login(LoginRequest $request){

        //dd(Auth::check());
        //dd($request);

        $email = $request->input('email');
        $password = $request->input('password');
        //dd($password);
        
        if (Auth::attempt(['email'=>$email, 'password'=>$password, 'role'=>'staff' ])){
            $request->session()->regenerate();

            return redirect()->route('staff.dashboard.index');
            
        }else{
            return back()->withErrors(['email' => 'Invalid login credentials'])->withInput();
        }

        return back()->withErrors(['email' => 'Invalid login credentials'])->withInput();
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('staff.auth.login');
    }
}
