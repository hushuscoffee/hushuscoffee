<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Article;

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
}
