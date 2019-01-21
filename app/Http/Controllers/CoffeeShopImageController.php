<?php

namespace App\Http\Controllers;

use App\CoffeeShopImage;
use Illuminate\Http\Request;
use Session;

class CoffeeShopImageController extends Controller
{
    public function index()
    {
        $coffees = CoffeeShopImage::all();
        return view('coffee_shop_image.index')->withCoffees($coffees);
    }

    public function create()
    {
        return view('coffee_shop_image.create');
    }

    public function edit($id)
    {
        $coffees = CoffeeShopImage::find($id);  
        return view('coffee_shop_image.edit')->withCoffees($coffees, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,jpg,png'
        ]);

        $coffees = CoffeeShopImage::findOrFail($id);
        
        $coffees->description = $request->input('description');
        $coffees->comment_count = $request->input('countComment');
        $coffees->upvote_count = $request->input('upVote');
        $coffees->downvote_count = $request->input('downVote');
                
        $coffees->save();

        return redirect()->route('coffee-shop.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|max:255',
            'name' => 'required',
            'address' => 'required'
        ]);

        $coffees = new CoffeeShopImage([
            'id_user' => 1,
            'description' => $request->input('description'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
        ]);

        $coffees->save();

        return redirect(route('coffee-shop.index'));
    }

    public function destroy($id)
    {
        $coffees = CoffeeShopImage::findOrFail($id);
        $coffees->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('coffee-shop.index')->with(['success' => 'Deleted!']);
    }
}
