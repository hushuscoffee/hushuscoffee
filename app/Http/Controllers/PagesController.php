<?php

namespace App\Http\Controllers;

use App\Article;
use App\Profile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function getIndex(){
        $this->data['brewings'] = DB::table('articles')->where('id_category', '=', 2)->where('id_shared', '=', 1)->orderBy('id', 'desc')->limit(2)->get();		       	      
        $this->data['recipes'] = DB::table('articles')->where('id_category', '=', 1)->where('id_shared', '=', 1)->orderBy('id', 'desc')->limit(2)->get();		       	      
        $this->data['articles'] = Article::with('profile')->where('id_category','<>',1)->where('id_category','<>',2)->where('id_shared', '=', 1)->orderBy('id', 'desc')->limit(4)->get();
        $this->data['people'] = Profile::orderBy('id', 'desc')->limit(5)->get();
        
        return view('index', $this->data);
    }

    public function getAbout(){
        return view('pages.about');
    }
    
    public function getContact(){
        return view('pages.contact');   
    }

    public function search(){
        $key = Input::get('search');
        $this->data['articles'] = DB::table('articles')->where('title', 'like', '%' . $key . '%')->where('id_shared', '=', 1)->orderBy('id', 'desc')->paginate(6);
        $this->data['people'] = DB::table('user_profiles')->where('fullname', 'like', '%' . $key . '%')->orderBy('id', 'desc')->paginate(6);
        if(Auth::check()){
            $this->data['favorites'] = DB::table('favourites')->where('id_user', '=', Auth::user()->id)->get();
            }
        return view('pages.search', $this->data);
    }
}