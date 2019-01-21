<?php

namespace App\Http\Controllers;

use App\MasterCategory;
use Illuminate\Http\Request;
use Session;

class MasterCategoryController extends Controller
{
    public function index()
    {
        $category = MasterCategory::all();
        return view('master_category.index')->withCategory($category);
    }

    public function create()
    {
        return view('master_category.create');
    }

    public function edit($id)
    {
        $category = MasterCategory::find($id);  
        return view('master_category.edit')->withCategory($category, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|max:255'
        ]);

        $category = MasterCategory::findOrFail($id);
        
        $category->name = $request->input('name');
        $category->description = $request->input('description');
                
        $category->save();

        return redirect()->route('category.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|max:255'
        ]);

        $category = new MasterCategory([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $category->save();

        return redirect(route('category.index'));
    }

    public function destroy($id)
    {
        $category = MasterCategory::findOrFail($id);
        $category->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('category.index')->with(['success' => 'Deleted!']);
    }
}
