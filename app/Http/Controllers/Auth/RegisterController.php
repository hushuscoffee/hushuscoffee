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

    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request){
        $validator1 = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:user_auths',           
        ]);
        $validator2 = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:user_auths',
        ]);
        $input = $request->all();
        if ($validator1->fails()) {
            Session::flash('username', 'Username has been registered. Please choose another username');
            return redirect()->back();
        }elseif($validator2->fails()){
            Session::flash('email', 'Email has been registered. Please choose another email');
            return redirect()->back();
        }elseif($input['password']!=$input['password_confirmation']){
            Session::flash('password', 'Password and confirm password did not match. Please enter your password carefully');
            return redirect()->back();
        }
        else{
            $id_user = User::create(['username' => $input['username'],'email' => $input['email'],'password' => bcrypt($input['password']),'active' => 10,'id_role' => 2])->id;
            Profile::create(['id_user'=> $id_user, 'username' => $input['username'],'fullname' => $input['username'], 'profession' => '','gender'=>'Male']);
            Session::flash('success', 'Account has been registered. You can now sign in with your registered account here');
            return redirect(route('login'));
        }                 
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
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
