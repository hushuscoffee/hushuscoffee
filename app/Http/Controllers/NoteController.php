<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Brewing;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notes.index');
    }

    public function articleAll()
    {
        $articles = Article::where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('notes.myarticle')->withArticles($articles);
    }

    public function articleEvents()
    {
        $articles = Article::where('category_id','=',1)->where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('notes.myarticle')->withArticles($articles);
    }
    public function articleNews()
    {
        $articles = Article::where('category_id','=',2)->where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('notes.myarticle')->withArticles($articles);
    }
    public function articleTips()
    {
        $articles = Article::where('category_id','=',3)->where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('notes.myarticle')->withArticles($articles);
    }
    public function showArticle($slug){
        $article =  Article::where('slug', '=', $slug)->first();
        return view('articles.show')->withArticle($article);
    }
    public function showBrewing($slug){
        $brewing =  Brewing::where('slug', '=', $slug)->first();
        return view('brewings.show')->withBrewing($brewing);
    }
}
