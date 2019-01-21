<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class BlogController extends Controller
{
    public function getIndex(){
        $articles = Articles::paginate(10);
        return view('blog.index')->withArticles($articles);
    }
    public function getSingle($slug){
        $article = Article::where('slug','=',$slug)->first();
        return view('blog.single')->withArticle($article);
    }
    //
}
