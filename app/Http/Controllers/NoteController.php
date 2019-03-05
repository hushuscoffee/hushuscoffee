<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Article;
use App\Brewing;
use App\Recipe;
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

    public function brewingAll()
    {
        $brewings = Brewing::where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('notes.mybrewing')->withBrewings($brewings);
    }

    public function recipeAll()
    {
        $recipes = Recipe::where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('notes.myrecipe')->withRecipes($recipes);
    }

    public function showArticle($slug){
        $article =  Article::where('slug', '=', $slug)->first();
        $articles = Article::where('shared_id','=',1)->where('id','!=',$article->id)->where('category_id','=',$article->category_id)->inRandomOrder()->limit(8)->get();
        return view('articles.show')->withArticle($article)->withArticles($articles);
    }
    public function showBrewing($slug){
        $brewing =  Brewing::where('slug', '=', $slug)->first();
        $brewings = Brewing::where('shared_id','=',1)->where('id','!=',$brewing->id)->inRandomOrder()->limit(8)->get();
        return view('brewings.show')->withBrewing($brewing)->withBrewings($brewings);
    }
    public function showRecipe($slug){
        $recipe =  Recipe::where('slug', '=', $slug)->first();
        $recipes = Recipe::where('shared_id','=',1)->where('id','!=',$recipe->id)->inRandomOrder()->limit(8)->get();
        return view('recipes.show')->withRecipe($recipe)->withRecipes($recipes);
    }
}
