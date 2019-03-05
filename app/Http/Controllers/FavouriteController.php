<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Favourite;
use App\Article;
use App\Brewing;
use App\Recipe;
use Session;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index(){
        $favs = Favourite::where('user_id','=',Auth::user()->id)->paginate(6);
        return view('favourites.index')->withFavs($favs);
    }

    public function add($id, $category)
    {
        $favourite = new Favourite;
        $favourite->user_id = Auth::user()->id;
        if($category==1){
            $favourite->article_id = $id;
        }elseif($category==2){
            $favourite->brewing_id = $id;
        }elseif($category==3){
            $favourite->recipe_id = $id;
        }
        $favourite->save();
        Session::flash('success', 'Successfully added to favourites');
        return redirect()->back();
    }

    public function remove($id){
        $fav = Favourite::findOrFail($id);
        $fav->delete();
        Session::flash('success', 'Successfully removed from favourites');
        return redirect()->back();
    }
}
