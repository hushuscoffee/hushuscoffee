<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Session;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('group.index')->withGroups($groups);
    }

    public function create()
    {
        return view('group.create');
    }

    public function edit($id)
    {
        $groups = Group::find($id);  
        return view('group.edit')->withGroups($groups, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|max:255'
        ]);

        $groups = Group::findOrFail($id);
        
        $groups->name = $request->input('name');
        $groups->description = $request->input('description');
                
        $groups->save();

        return redirect()->route('groups.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|max:255'
        ]);

        $groups = new Group([
            'id_user' => 1,
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $groups->save();

        return redirect(route('groups.index'));
    }

    public function destroy($id)
    {
        $groups = Group::findOrFail($id);
        $groups->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('groups.index')->with(['success' => 'Deleted!']);
    }
}
