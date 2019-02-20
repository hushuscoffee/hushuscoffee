<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Shared;
use App\Article;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use Session;
use Purifier;
use Illuminate\Support\Facades\Auth;

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
        return view('articles.create')->withCategories($categories)->withShareds($shareds);
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
            $image = Input::file('file');
			$filename  = time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('uploads/articles/' . $filename);
			Image::make($image->getRealPath())->save($path);
        }
        $article = new Article;
        $article->status_id = $request->status;
        $article->shared_id = $request->shared;
        $article->category_id = $request->category;
        $article->user_id = Auth::user()->id;
        $article->title = $request->title;
        $article->description = Purifier::clean($request->description);
        $article->image = 'uploads/articles/'.$filename;
        
        $article->save();
        Session::flash('success', 'This article was successfully saved');
        
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
        $article->description = $request->input('description');

        if ($request->hasFile('image')) {
            $image = Input::file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/articles/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $article->image='uploads/articles/'.$filename;
        }
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
        //
    }

    public function indexEvents(){
        $key = Input::get('search');
        if (isset($key)) {
            $articles = Article::where('category_id','=',1)->where('title', 'like', '%' . $key . '%')->orderBy('id', 'desc')->paginate(6);
        } else {
            $articles = Article::where('category_id','=',1)->orderBy('id', 'desc')->paginate(6);
        }
        return view('articles.index')->withArticles($articles)->withCategory(1);
    }

    public function indexNews(){
        $key = Input::get('search');
        if (isset($key)) {
            $articles = Article::where('category_id','=',2)->where('title', 'like', '%' . $key . '%')->orderBy('id', 'desc')->paginate(6);
        } else {
            $articles = Article::where('category_id','=',2)->orderBy('id', 'desc')->paginate(6);
        }
        return view('articles.index')->withArticles($articles)->withCategory(2);
    }

    public function indexTips(){
        $key = Input::get('search');
        if (isset($key)) {
            $articles = Article::where('category_id','=',3)->where('title', 'like', '%' . $key . '%')->orderBy('id', 'desc')->paginate(6);
        } else {
            $articles = Article::where('category_id','=',3)->orderBy('id', 'desc')->paginate(6);
        }
        return view('articles.index')->withArticles($articles)->withCategory(3);
    }
}