<?php

namespace App\Http\Controllers;

use App\Shared;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;

class SharedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shareds = Shared::all();
        return view('admin.shareds.index')->withShareds($shareds);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shareds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, array(
            'name' => 'required|max:255'
            ));

        $shared = new Shared;

        $shared->name = $request->name;
        $shared->save();

        Session::flash('success', 'New shared has been created');
        return redirect()->route('shared.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shared = Shared::find($id);  
        return view('admin.shareds.edit')->withShared($shared);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $shared = Shared::findOrFail($id);
        
        $shared->name = $request->input('name');
                
        $shared->save();

        Session::flash('success', 'Shared has been updated');
        return redirect()->route('shared.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shared = Shared::findOrFail($id);
        $shared->delete();
        Session::flash('success', 'Shared has been deleted');
        return redirect()->route('shared.index');

    }
}
