<?php

namespace App\Http\Controllers;

use App\MasterShared;
use Illuminate\Http\Request;
use Session;

class MasterSharedController extends Controller
{
    public function index()
    {
        $shared = MasterShared::all();
        return view('master_shared.index')->withShared($shared);
    }

    public function create()
    {
        return view('master_shared.create');
    }

    public function edit($id)
    {
        $shared = MasterShared::find($id);  
        return view('master_shared.edit')->withShared($shared, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $shared = MasterShared::findOrFail($id);
        
        $shared->name = $request->input('name');
                
        $shared->save();

        return redirect()->route('shared.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $shared = new MasterShared([
            'name' => $request->input('name')
        ]);

        $shared->save();

        return redirect(route('shared.index'));
    }

    public function destroy($id)
    {
        $shared = MasterShared::findOrFail($id);
        $shared->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('shared.index')->with(['success' => 'Deleted!']);
    }
}
