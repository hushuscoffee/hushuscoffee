<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    
    public function index()
    {
        $tags = Tag::all();
        return view('tag.index')->withTags($tags);
    }

    public function create()
    {
        return view('tag.create');
    }

    public function edit($id)
    {
        $tags = Tag::find($id);  
        return view('tag.edit')->withTags($tags, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $tags = Tag::findOrFail($id);
        
        $tags->name = $request->input('name');
                
        $tags->save();

        return redirect()->route('tag.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $tags = new Tag([
            'name' => $request->input('name')
        ]);

        $tags->save();

        return redirect(route('tag.index'));
    }

    public function destroy($id)
    {
        $tags = Tag::findOrFail($id);
        $tags->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('tag.index')->with(['success' => 'Deleted!']);
    }
}