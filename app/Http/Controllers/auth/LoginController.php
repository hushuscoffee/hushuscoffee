<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLndex()
    {
        return view('auth.login');
    }

    public function postLogin(Request $request){
             if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
                if(Auth::check()){
                    return redirect('/');
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'username' => 'required|string|max:255|unique:users',                    
                ]);
                if (!$validator->fails()) {
                    Session::flash('username', 'Username has not been registered yet.');
                }else{
                    Session::flash('password', 'Password is incorrect.');
                }
                // Session::flash('error', 'Username or password did not match with our records in database');
                
                return redirect()->back();
            }
        
    }
}
