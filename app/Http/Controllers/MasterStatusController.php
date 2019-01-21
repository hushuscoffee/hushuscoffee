<?php

namespace App\Http\Controllers;

use App\MasterStatus;
use Illuminate\Http\Request;
use Session;

class MasterStatusController extends Controller
{
    public function index()
    {
        $status = MasterStatus::all();
        return view('master_status.index')->withStatus($status);
    }

    public function create()
    {
        return view('master_status.create');
    }

    public function edit($id)
    {
        $status = MasterStatus::find($id);  
        return view('master_status.edit')->withStatus($status, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $status = MasterStatus::findOrFail($id);
        
        $status->name = $request->input('name');
                
        $status->save();

        return redirect()->route('status.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $status = new MasterStatus([
            'name' => $request->input('name')
        ]);

        $status->save();

        return redirect(route('status.index'));
    }

    public function destroy($id)
    {
        $status = MasterStatus::findOrFail($id);
        $status->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('status.index')->with(['success' => 'Deleted!']);
    }
}
