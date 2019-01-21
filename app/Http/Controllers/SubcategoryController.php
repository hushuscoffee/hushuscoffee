<?php

namespace App\Http\Controllers;

use App\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $subs = Subcategory::all();
        return view('subcategory.index')->withSubs($subs);
    }

    public function create()
    {
        return view('subcategory.create');
    }

    public function edit($id)
    {
        $subs = Subcategory::find($id);  
        return view('subcategory.edit')->withSubs($subs, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $subs = Subcategory::findOrFail($id);
        
        $subs->name = $request->input('name');
                
        $subs->save();

        return redirect()->route('subcategory.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $subs = new Subcategory([
            'id_category' => 1,
            'name' => $request->input('name')
        ]);

        $subs->save();

        return redirect(route('subcategory.index'));
    }

    public function destroy($id)
    {
        $subs = Subcategory::findOrFail($id);
        $subs->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('subcategory.index')->with(['success' => 'Deleted!']);
    }
}
