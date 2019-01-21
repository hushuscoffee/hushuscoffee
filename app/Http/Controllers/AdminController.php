<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use App\Profile;



class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function user()
    {
        $this->data['users'] = DB::table('user_auths')->where('id_role', '!=', 1)->where('active', '!=', 0)->orderBy('id','desc')->get();

        return view('admin.users',$this->data);
    }

    public function activate($id){
        $user = User::findOrFail($id);
        $user->active = 10;
        $user->save();
        Session::flash('success', 'The user was successfully activated');

        return redirect()->back();
    }

    public function deactivate($id){
        $user = User::findOrFail($id);
        $user->active = 1;
        $user->save();
        Session::flash('success', 'The user was successfully deactivated');

        return redirect()->back();

    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->active = 0;
        $user->save();
        Session::flash('success', 'The user was successfully deleted');
        return redirect()->back();        
    }
}
