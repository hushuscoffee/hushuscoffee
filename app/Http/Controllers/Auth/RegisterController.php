<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;


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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request){
        // Username validation
        $validator1 = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',           
        ]);
        // Email Validation
        $validator2 = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        // Validation Process
        if ($validator1->fails()) {
            Session::flash('username', 'Username has been registered. Please choose another username');
            return redirect()->back();
        }elseif($validator2->fails()){
            Session::flash('email', 'Email has been registered. Please choose another email');
            return redirect()->back();
        }elseif($request->password!=$request->password_confirmation){
            Session::flash('password', 'Password and confirm password did not match. Please enter your password carefully');
            return redirect()->back();
        }
        else{
            // Create User
            $user = new User;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = 1;
            $user->save();
            // End of Create User

            // Create Profile
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->photo = 'images/avatar/unknown.png';
            $profile->save();
            // End of Create Profile
            
            Session::flash('success', 'Account has been registered. You can now sign in with your registered account here');
            return redirect(route('getLogin'));
        }              
        // End of Validation Process   
    }
}
