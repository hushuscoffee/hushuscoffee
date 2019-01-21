<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use App\MasterCategory;
use App\MasterShared;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function index()
    {
        $articles = Article::orderBy('id','desc')->paginate(6);
        return view('article.index')->withArticles($articles);
    }

    public function create()
    {
        $this->data['shared'] = MasterShared::all();
        $this->data['categorys'] = DB::table('master_categorys')->where('id', '<>', 1)->where('id', '<>', 2)->get();
        return view('article.create',$this->data);
    }

    public function show($slug)
    {
        $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
        return view('article.show',$this->data);
    }

    public function edit($slug)
    {
        $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
        $this->data['shared'] = MasterShared::all();
        $this->data['categorys'] = DB::table('master_categorys')->where('id', '<>', 1)->where('id', '<>', 2)->get();
        return view('article.edit',$this->data);
    }

    public function update(Request $request, $id)
    {
        $articles = Article::findOrFail($id);
        $articles->title = $request->input('title');
        $articles->description = $request->input('description');

        if ($request->hasFile('file')) {
            $image = Input::file('file');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/articles/' . $filename);
            Image::make($image->getRealPath())->save($path);
            $articles->file='uploads/articles/'.$filename;
        }
        $articles->save();

        Session::flash('success','This article was successfully updated');

        return redirect(route('personalize.showarticle',$articles->slug));
    }

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
        $article = new Article([
            'id_status' => 1,
            'id_shared' => $request->input('shared'),
            'id_category' => $request->input('category'),
            'id_user' => Auth::user()->id,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'file' => 'uploads/articles/'.$filename
        ]);
        $article->save();
        Session::flash('success', 'This article was successfully saved');
        return redirect(route('personalize.showarticle',$article->slug));
    }

    public function destroy($id)
    {
        $articles = Article::findOrFail($id);
        $articles->delete();

        // Session::flash('success', 'Deleted!');
        Session::flash('success', 'The article was successfully deleted');
        return redirect()->route('personalize.myarticle');
    }

    public function recipe(){
        $key = Input::get('search');
        if (isset($key)) {
            $this->data['articles'] = DB::table('articles')->where('title', 'like', '%' . $key . '%')->where('id_category', '=', 1)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);
        } else {
            $this->data['articles'] = DB::table('articles')->where('id_category', '=', 1)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);

        }        
        $this->data['category'] = 1;
        if(Auth::check()){
        $this->data['favorites'] = DB::table('favourites')->where('id_user', '=', Auth::user()->id)->get();
        }
        return view('article.index',$this->data);
    }

    public function recipeShow($slug){
        $this->data['article'] = Article::where('slug', '=', $slug)->first();

        $article = DB::table('articles')->where('slug', '=', $slug)->first();		       	      
        $id_article=$article->id;
        $this->data['ingredients'] = DB::table('ingredients')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['tools'] = DB::table('tools')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['steps'] = DB::table('steps')->where('id_article', '=', $id_article)->orderBy('id')->get();
        return view('article.recipe',$this->data);
    } 

    public function brewing(){
        $key = Input::get('search');
if (isset($key)) {
    $this->data['articles'] = DB::table('articles')->where('title', 'like', '%' . $key . '%')->where('id_category', '=', 2)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);
} else {
    $this->data['articles'] = DB::table('articles')->where('id_category', '=', 2)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);

}
        $this->data['category'] = 2;
        if(Auth::check()){
        $this->data['favorites'] = DB::table('favourites')->where('id_user', '=', Auth::user()->id)->get();
        }
        return view('article.index',$this->data);
    }

    public function brewingShow($slug){
        $this->data['article'] = Article::where('slug', '=', $slug)->first();
        $article = DB::table('articles')->where('slug', '=', $slug)->first();		       	      
        $id_article=$article->id;
        $this->data['ingredients'] = DB::table('ingredients')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['tools'] = DB::table('tools')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['steps'] = DB::table('steps')->where('id_article', '=', $id_article)->orderBy('id')->get();
        return view('article.brewing',$this->data);
    }
    // public function story(){
    //     $this->data['articles'] = DB::table('articles')->where('id_category', '=', 3)->orderBy('id')->paginate(8);
    //     $this->data['category'] = 3;
    //     return view('article.index',$this->data);
    // }

    // public function storyShow($slug){
    //     $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
    //     return view('article.show',$this->data);
    // }
 
    public function tips(){
        $key = Input::get('search');                    
        if(isset($key)){
            $this->data['articles'] = DB::table('articles')->where('title','like','%'.$key.'%')->where('id_category', '=', 4)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);
        }else{
        $this->data['articles'] = DB::table('articles')->where('id_category', '=', 4)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);
        }
        $this->data['category'] = 4;
        if(Auth::check()){
        $this->data['favorites'] = DB::table('favourites')->where('id_user', '=', Auth::user()->id)->get();
        }

        return view('article.index',$this->data);
    }

    public function tipsShow($slug){
        $this->data['article'] = Article::where('slug', '=', $slug)->first();

        return view('article.show',$this->data);
    }
    // public function info(){
    //     $this->data['articles'] = DB::table('articles')->where('id_category', '=', 5)->orderBy('id')->paginate(8);
    //     $this->data['category'] = 5;
    //     return view('article.index',$this->data);
    // }

    // public function infoShow($slug){
    //     $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
    //     return view('article.show',$this->data);
    // }
    public function news(){
        $key = Input::get('search');
        if(isset($key)){
            $this->data['articles'] = DB::table('articles')->where('title','like','%'.$key.'%')->where('id_category', '=', 3)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);
        }else{
            $this->data['articles'] = DB::table('articles')->where('id_category', '=', 3)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);
        }
        $this->data['category'] = 3;
        if(Auth::check()){
        $this->data['favorites'] = DB::table('favourites')->where('id_user', '=', Auth::user()->id)->get();
        }

        return view('article.index',$this->data);
    }

    public function newsShow($slug){
        $this->data['article'] = Article::where('slug', '=', $slug)->first();

        return view('article.show',$this->data);
    }
    // public function trend(){
    //     $this->data['articles'] = DB::table('articles')->where('id_category', '=', 7)->orderBy('id')->paginate(8);
    //     $this->data['category'] = 7;
    //     return view('article.index',$this->data);
    // }

    // public function trendShow($slug){
    //     $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
    //     return view('article.show',$this->data);
    // }
    // public function people(){
    //     $this->data['articles'] = DB::table('articles')->where('id_category', '=', 8)->orderBy('id')->paginate(8);
    //     $this->data['category'] = 8;
    //     return view('article.index',$this->data);
    // }

    // public function peopleShow($slug){
    //     $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
    //     return view('article.show',$this->data);
    // }
    public function event(){
        $key = Input::get('search');                    
        if(isset($key)){
            $this->data['articles'] = DB::table('articles')->where('title','like','%'.$key.'%')->where('id_category', '=', 5)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);
        }else{
        $this->data['articles'] = DB::table('articles')->where('id_category', '=', 5)->where('id_shared', '=', 1)->orderBy('id','desc')->paginate(6);
        }
        $this->data['category'] = 5;
        if(Auth::check()){
        $this->data['favorites'] = DB::table('favourites')->where('id_user', '=', Auth::user()->id)->get();
        }
        return view('article.index',$this->data);
    }

    public function eventShow($slug){
        $this->data['article'] = Article::where('slug', '=', $slug)->first();

        return view('article.show',$this->data);
    }

    public function share($id){
        $article = Article::findOrFail($id);
        $article->id_shared = 1;
        $article->save();
        Session::flash('success', 'The article was successfully shared and visible to public');
        return redirect()->back();
    }
    public function unshare($id){
        $article = Article::findOrFail($id);
        $article->id_shared = 2;
        $article->save();
        Session::flash('success', 'The article was successfully unshared and visible to private only');
        return redirect()->back();
    }
}
