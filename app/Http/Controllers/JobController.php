<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Session;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::all();
        return view('job.index')->withJobs($jobs);
    }

    public function create()
    {
        return view('job.create');
    }

    public function edit($id)
    {
        $jobs = Job::find($id);  
        return view('job.edit')->withJobs($jobs, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|max:255'
        ]);

        $jobs = Job::findOrFail($id);
        
        $jobs->name = $request->input('name');
        $jobs->description = $request->input('description');
                
        $jobs->save();

        return redirect()->route('jobs.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required|max:255'
        ]);

        $jobs = new Job([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        $jobs->save();

        return redirect(route('jobs.index'));
    }

    public function destroy($id)
    {
        $jobs = Job::findOrFail($id);
        $jobs->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('jobs.index')->with(['success' => 'Deleted!']);
    }
}
