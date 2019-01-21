<?php

namespace App\Http\Controllers;

use App\Favourite;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FavouriteController extends Controller
{
    public function index(){
        $this->data['favs'] = DB::table('favourites')->where('id_user','=',Auth::user()->id)->get();
        return view('favourite.index', $this->data);
    }

    public function add($id_article)
    {
        $favourite = new Favourite([
        'id_user' => Auth::user()->id,
        'id_article' => $id_article,
        ]);

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
