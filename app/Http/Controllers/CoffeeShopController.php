<?php

namespace App\Http\Controllers;

use App\CoffeeShop;
use Illuminate\Http\Request;
use Session;

class CoffeeShopController extends Controller
{
    public function index()
    {
        $coffees = CoffeeShop::all();
        return view('coffee_shop.index')->withCoffees($coffees);
    }

    public function create()
    {
        return view('coffee_shop.create');
    }

    public function edit($id)
    {
        $coffees = CoffeeShop::find($id);  
        return view('coffee_shop.edit')->withCoffees($coffees, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required|max:255'
        ]);

        $coffees = CoffeeShop::findOrFail($id);
        
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

        $coffees = new CoffeeShop([
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
        $coffees = CoffeeShop::findOrFail($id);
        $coffees->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('coffee-shop.index')->with(['success' => 'Deleted!']);
    }
}
