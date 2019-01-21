<?php

namespace App\Http\Controllers;

use App\ArticleReport;
use Illuminate\Http\Request;
use Session;

class ArticleReportController extends Controller
{
    public function index()
    {
        $reports = ArticleReport::all();
        return view('article_report.index')->withReports($reports);
    }

    public function create()
    {
        return view('article_report.create');
    }

    public function edit($id)
    {
        $reports = ArticleReport::find($id);  
        return view('article_report.edit')->withReports($reports, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required'
        ]);

        $reports = ArticleReport::findOrFail($id);
        
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

        $reports = new ArticleReport([
            'id_user' => 1,
            'id_article' => 1,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $reports->save();

        return redirect(route('reports.index'));
    }

    public function destroy($id)
    {
        $reports = ArticleReport::findOrFail($id);
        $reports->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('reports.index')->with(['success' => 'Deleted!']);
    }
}
