<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Brewing;
use App\Article;
use App\Recipe;
use App\Favourite;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['brewings'] = Brewing::where('shared_id', '=', 1)->where('user_id', '=', 1)->orderBy('id', 'desc')->limit(2)->get();		       	      
        $this->data['recipes'] = Recipe::where('shared_id', '=', 1)->where('user_id', '=', 1)->orderBy('id', 'desc')->limit(2)->get();		       	      
        $this->data['articles'] = Article::where('shared_id', '=', 1)->orderBy('id', 'desc')->limit(4)->get();
        $this->data['people'] = Profile::orderBy('id', 'desc')->inRandomOrder()->limit(5)->get();
        return view('index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function search(){
        $key = Input::get('search');
        $this->data['articles'] = Article::where('title', 'like', '%' . $key . '%')->where('shared_id', '=', 1)->orderBy('id', 'desc')->get();
        $this->data['brewings'] = Brewing::where('title', 'like', '%' . $key . '%')->where('shared_id', '=', 1)->orderBy('id', 'desc')->get();
        $this->data['recipes'] = Recipe::where('title', 'like', '%' . $key . '%')->where('shared_id', '=', 1)->orderBy('id', 'desc')->get();
        $this->data['people'] = Profile::where('fullname', 'like', '%' . $key . '%')->orderBy('id', 'desc')->get();
        $this->data['favourites'] = null;
        if(Auth::check()){
            $this->data['favourites'] = Favourite::where('user_id', '=', Auth::user()->id)->get();
        }
        return view('search', $this->data);
    }
}
