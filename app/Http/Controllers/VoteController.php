<?php

namespace App\Http\Controllers;

use App\Vote;
use Illuminate\Http\Request;
use Session;

class VoteController extends Controller
{
    public function index()
    {
        $votes = Vote::all();
        return view('vote.index')->withVotes($votes);
    }

    public function create()
    {
        return view('vote.create');
    }

    public function edit($id)
    {
        $votes = Vote::find($id);  
        return view('vote.edit')->withVotes($votes, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'vote' => 'required|digits_between:1,10'
        ]);

        $votes = Vote::findOrFail($id);
        
        $votes->vote = $request->input('vote');
                
        $votes->save();

        return redirect()->route('votes.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'vote' => 'required|digits_between:1,10'
        ]);

        $votes = new Vote([
            'vote' => $request->input('vote')
        ]);

        $votes->save();

        return redirect(route('votes.index'));
    }

    public function destroy($id)
    {
        $votes = Vote::findOrFail($id);
        $votes->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('votes.index')->with(['success' => 'Deleted!']);
    }
}
