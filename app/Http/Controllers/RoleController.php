<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('role.index')->withRoles($roles);
    }

    public function create()
    {
        return view('role.create');
    }

    public function edit($id)
    {
        $roles = Role::find($id);  
        return view('role.edit')->withRoles($roles, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $roles = Role::findOrFail($id);
        
        $roles->name = $request->input('name');
                
        $roles->save();

        return redirect()->route('roles.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $roles = new Role([
            'name' => $request->input('name')
        ]);

        $roles->save();

        return redirect(route('roles.index'));
    }

    public function destroy($id)
    {
        $roles = Role::findOrFail($id);
        $roles->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('roles.index')->with(['success' => 'Deleted!']);
    }
}
