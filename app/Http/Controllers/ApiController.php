<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Article;
use App\Brewing;
use App\Recipe;
use App\Profile;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllArticle()
    {
        $articles = Article::all();

        return response()->json([
            'message'=> "success",
            'data' => $articles
        ], 200);
    }

    public function getHomeArticle()
    {
        $articles = Article::orderBy('id','desc')->limit(5)->get();

        return response()->json([
            'message'=> "success",
            'data' => $articles
        ], 200);
    }

    public function getHomePeople()
    {
        $people = Profile::orderBy('id','desc')->limit(5)->get();

        return response()->json([
            'message'=> "success",
            'data' => $people
        ], 200);
    }

    public function getHomeEvents()
    {
        $events = DB::table('articles')
        ->where('category_id', 1)
        ->orderBy('id','desc')->limit(8)
        ->get();

        return response()->json([
            'message'=> "success",
            'data' => $events
        ], 200);
    }

    public function getHomeNews()
    {
        $news = DB::table('articles')
        ->where('category_id', 2)
        ->orderBy('id','desc')->limit(8) 
        ->get();

        return response()->json([
            'message'=> "success",
            'data' => $news
        ], 200);
    }

    public function getHomeTips()
    {
        $tips = DB::table('articles')
            ->where('category_id', 3)
            ->orderBy('id','desc')->limit(8)
            ->get();

        return response()->json([
            'message'=> "success",
            'data' => $tips
        ], 200);
    }

    public function getAllEvents()
    {
        $events = DB::table('articles')->where('category_id', 1)->get();

        return response()->json([
            'message'=> "success",
            'data' => $events
        ], 200);
    }

    public function getAllNews()
    {
        $news = DB::table('articles')->where('category_id', 2)->get();

        return response()->json([
            'message'=> "success",
            'data' => $news
        ], 200);
    }

    public function getAllTips()
    {
        $tips = DB::table('articles')->where('category_id', 3)->get();

        return response()->json([
            'message'=> "success",
            'data' => $tips
        ], 200);
    }

    public function getAllBrewing()
    {
        $brewing = Brewing::all();

        return response()->json([
            'message'=> "success",
            'data' => $brewing
        ], 200);
    }

    public function getAllRecipe()
    {
        $recipe = Recipe::all();

        return response()->json([
            'message'=> "success",
            'data' => $recipe
        ], 200);
    }

    public function getAllPeople()
    {
        $user = Profile::all();

        return response()->json([
            'message'=> "success",
            'data' => $user
        ], 200);
    }

    public function getDetailArticle($id)
    {
        $article = DB::table('articles')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $article
        ], 200);
    }

    public function getDetailEvents($id)
    {
        $events = DB::table('articles')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $events
        ], 200);
    }

    public function getDetailNews($id)
    {
        $news = DB::table('articles')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $news
        ], 200);
    }

    public function getDetailTips($id)
    {
        $tips = DB::table('articles')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $tips
        ], 200);
    }

    public function getDetailBrewing($id)
    {
        $brewing = DB::table('brewings')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $brewing
        ], 200);
    }

    public function getDetailRecipe($id)
    {
        $recipe = DB::table('recipes')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $recipe
        ], 200);
    }

    public function getDetailPeople($id)
    {
        $profile = DB::table('profiles')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => 'success',
            'data' => $profile
        ], 200);
    }
}
