<?php

namespace App\Http\Controllers;

use App\CommentReport;
use Illuminate\Http\Request;
use Session;

class CommentReportController extends Controller
{
    public function index()
    {
        $reports = CommentReport::all();
        return view('comment_report.index')->withReports($reports);
    }

    public function create()
    {
        return view('comment_report.create');
    }

    public function edit($id)
    {
        $reports = CommentReport::find($id);  
        return view('comment_report.edit')->withReports($reports, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $reports = CommentReport::findOrFail($id);
        
        $reports->title = $request->input('title');
        $reports->description = $request->input('description');
                
        $reports->save();

        return redirect()->route('reports.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $reports = new CommentReport([
            'id_user' => 1,
            'id_comment' => 1,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $reports->save();

        return redirect(route('reports.index'));
    }

    public function destroy($id)
    {
        $reports = CommentReport::findOrFail($id);
        $reports->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('reports.index')->with(['success' => 'Deleted!']);
    }
}
