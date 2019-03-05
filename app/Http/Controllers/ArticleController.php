<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Shared;
use App\Article;
use App\Favourite;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use Session;
use Purifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ArticleController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $shareds = Shared::all();
        $articles = Article::where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->limit(5)->get();
        return view('articles.create')->withCategories($categories)->withShareds($shareds)->withArticles($articles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        
        $filename = 'unknowncover.jpg';
        if ($request->hasFile('file')) {
            $hashed = md5(uniqid(Auth::user()->id, true));
            $image = Input::file('file');
			$filename  = $hashed.'_'.time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('uploads/articles/' . $filename);
			Image::make($image->getRealPath())->save($path);
        }
        $article = new Article;
        $article->status_id = $request->status;
        $article->shared_id = $request->shared;
        $article->category_id = $request->category;
        $article->user_id = Auth::user()->id;
        $article->title = $request->title;
        $article->description = $request->description;
        $article->image = $filename;
        
        $article->save();
        Session::flash('success', 'This article was successfully saved');
        return redirect(route('myArticle.show',$article->slug));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $article= Article::where('slug', '=', $slug)->first();
        $shareds = Shared::all();
        $categories = Category::all();
        return view('articles.edit')->withArticle($article)->withShareds($shareds)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->description = $request->description;
        $article->shared_id = $request->shared;
        $article->category_id = $request->category;

        if ($request->hasFile('file')) {
            $hashed = md5(uniqid(Auth::user()->id, true));
            $image = Input::file('file');
			$filename  = $hashed.'_'.time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('uploads/articles/' . $filename);
            Image::make($image->getRealPath())->save($path);
            if($article!='unknowncover.jpg'){
                $file_to_delete = public_path('uploads/articles/' . $article->image);
                File::delete($file_to_delete);
            }
            $article->image = $filename;
        }
        $article->slug = null;
        $article->save();

        Session::flash('success','This article was successfully updated');

        return redirect(route('myArticle.show',$article->slug));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
        $article->delete();
        return redirect(route('article.all'))->with('info','Success! Article has been deleted');
    }

    public function indexEvents(){
        $key = Input::get('search');
        if (isset($key)) {
            $articles = Article::where('category_id','=',1)->where('shared_id','=',1)->where('title', 'like', '%' . $key . '%')->orderBy('id', 'desc')->paginate(6);
        } else {
            $articles = Article::where('category_id','=',1)->where('shared_id','=',1)->orderBy('id', 'desc')->paginate(6);
        }
        $favourites = null;
        if(Auth::check()){
            $favourites = Favourite::where('user_id', '=', Auth::user()->id)->get();
        }
        return view('articles.index')->withArticles($articles)->withCategory(1)->withFavourites($favourites);
    }

    public function indexNews(){
        $key = Input::get('search');
        if (isset($key)) {
            $articles = Article::where('category_id','=',2)->where('shared_id','=',1)->where('title', 'like', '%' . $key . '%')->orderBy('id', 'desc')->paginate(6);
        } else {
            $articles = Article::where('category_id','=',2)->where('shared_id','=',1)->orderBy('id', 'desc')->paginate(6);
        }
        $favourites = null;
        if(Auth::check()){
            $favourites = Favourite::where('user_id', '=', Auth::user()->id)->get();
        }
        return view('articles.index')->withArticles($articles)->withCategory(2)->withFavourites($favourites);
    }

    public function indexTips(){
        $key = Input::get('search');
        if (isset($key)) {
            $articles = Article::where('category_id','=',3)->where('shared_id','=',1)->where('title', 'like', '%' . $key . '%')->orderBy('id', 'desc')->paginate(6);
        } else {
            $articles = Article::where('category_id','=',3)->where('shared_id','=',1)->orderBy('id', 'desc')->paginate(6);
        }
        $favourites = null;
        if(Auth::check()){
            $favourites = Favourite::where('user_id', '=', Auth::user()->id)->get();
        }
        return view('articles.index')->withArticles($articles)->withCategory(3)->withFavourites($favourites);
    }
}