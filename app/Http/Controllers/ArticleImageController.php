<?php

namespace App\Http\Controllers;

use App\ArticleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Session;
use Image;

use Validator;

class ArticleImageController extends Controller
{
    
    public function index()
    {
        $articles = ArticleImage::all();
        return view('article_image.index')->withArticles($articles);
    }

    public function create()
    {
        return view('article_image.create');
    }

    public function edit($id)
    {
        $articles = ArticleImage::find($id);  
        return view('article_image.edit')->withArticles($articles, $id);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required|max:255'
        ]);

        $articles = ArticleImage::findOrFail($id);
                
        $articles->save();

        return redirect()->route('article-image.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request)
    {
        if($request->file('image') != NULL){
            $image = $request->file('image');
            $file_count = count($image);
            $uploadcount = 0;

            foreach($image as $img) {
                $rules = array('image' => 'required'); 
                $validator = Validator::make(array('image'=> $img), $rules);

                if($validator->passes()){
                    $fileName = $img->getClientOriginalName();
                    $img->move(public_path('uploads'), $fileName);
                    $uploadcount++;

                    $articles = new ArticleImage();
                    $articles->id_article = 2;
                    $articles->image = $fileName;

                    $articles->save();
                }
            }
        }else{
            echo('Failed');
        }
        // dd($request);

        // $image = $request->file('image');
        // foreach($image as $img){
        //     $fileName = $img->getClientOriginalName();
        //     $location = $img->move(public_path('uploads'), $fileName);
        // }
        // dd($location);
        return redirect()->route('article-image.index')->with(['success' => 'Your image uploaded successful']);
    }

    public function destroy($id)
    {
        $articles = ArticleImage::findOrFail($id);
        $articles->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('article-image.index')->with(['success' => 'Deleted!']);
    }
}
