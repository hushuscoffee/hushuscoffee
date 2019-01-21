<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return view('comment.index')->withComments($comments);
    }

    public function create()
    {
        return view('comment.create');
    }

    public function edit($id)
    {
        $comments = Comment::find($id);  
        return view('comment.edit')->withComments($comments, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);

        $comments = Comment::findOrFail($id);
        
        $comments->text = $request->input('text');
                
        $comments->save();

        return redirect()->route('comments.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request, $article_id)
    {
        $this->validate($request, [
            'text' => 'required'
        ]);

        $comments = new Comment([
            'id_user' => Auth::user()->id,
            'id_article' => $article_id,
            'text' => $request->input('text'),
        ]);

        $comments->save();
        Session::flash('success', 'Comment was successfully added');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $comments = Comment::findOrFail($id);
        $comments->delete();
        Session::flash('success', 'Comment was successfully deleted!');
        return redirect()->back();
    }
}
