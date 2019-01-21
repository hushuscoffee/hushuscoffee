<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Article;
use App\Tool;
use App\Technique;
use App\Ingredient;
use App\Step;
use App\MasterCategory;
use App\MasterShared;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;
use Image;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;

class PersonalizeController extends Controller
{
    public function index()
    {
        return view('personalize.index');
    }
    
    public function recipe()
    {
        $categorys = DB::table('master_categorys')->get();
        return view('personalize.recipe', compact('categorys'));
    }

    public function brewing()
    {
        $this->data['shared'] = MasterShared::all();		       	      
        return view('personalize.brewing');
    }

    public function editBrewing($slug){
        $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
        $article = DB::table('articles')->where('slug', '=', $slug)->first();		       	      
        $id_article=$article->id;
        $this->data['ingredients'] = DB::table('ingredients')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['tools'] = DB::table('tools')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['steps'] = DB::table('steps')->where('id_article', '=', $id_article)->orderBy('id')->get();
        return view('personalize.editbrewing',$this->data);
    }

    public function technique()
    {
        $categorys = DB::table('master_categorys')->get();
        return view('personalize.technique', compact('categorys'));
    }

    public function create()
    {
        return view('personalize.create');
    }

    public function storeRecipe(Request $request)
    {
        $input = Input::all();
        $material = $input['materialName'];
        $tools = $input['toolName'];
        $steps = $input['step'];
        $x = 0;
$filename = 'unknowncover.jpg';
if ($request->hasFile('cover')) {
    $image = $request->file('cover');
    $filename = 'cover' . time() . '.' . $image->getClientOriginalExtension();
    $path = public_path('uploads/recipes/' . $filename);
    Image::make($image->getRealPath())->save($path);
}


        $id_article = Article::create([
            'id_status' => 1,
            'id_shared' => $request->input('shared'),
            'id_category' => 1,
            'id_user' => Auth::user()->id,
            'slug' => str_slug($request->input('title')),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'file' => 'uploads/recipes/'.$filename
        ])->id;

        // Ingredient::create([
        //     'nama' => "Time",
        //     'jumlah' => $request->input('time1').' - '.$request->input('time2'),
        //     'satuan' => $request->input('second'),
        //     'id_article' => $id_article
        // ]);

        // Ingredient::create([
        //     'nama' => "Temperature",
        //     'jumlah' => $request->input('temperature'),
        //     'satuan' => $request->input('celcius'),
        //     'id_article' => $id_article
        // ]);

        foreach($material as $key => $value){
            $ingredient = new Ingredient;
            $ingredient->nama = $input['materialName'][$key];
            $ingredient->jumlah = $input['materialAmount'][$key];
            $ingredient->satuan = $input['materialUnit'][$key];
            $ingredient->id_article =  $id_article;
            $ingredient->save();
        }

        foreach($tools as $key => $value){
            $tool = new Tool;
            $tool->nama = $input['toolName'][$key];
            $tool->jumlah = $input['toolAmount'][$key];
            $tool->satuan = $input['toolUnit'][$key];
            $tool->id_article =  $id_article;
            $tool->save();
        }
        foreach($steps as $key => $value){
            $step = new Step;
            $step->description = $input['step'][$key];
            $step->id_article = $id_article;
            $x++;
            if ($request->hasFile('stepImage' . $x)) {
            $stepimage = $request->file('stepImage' . $x);
            $fileimage = $x . time() . '.' . $stepimage->getClientOriginalExtension();
            $pathimage = public_path('uploads/recipes/' . $fileimage);
            Image::make($stepimage->getRealPath())->save($pathimage);
            $step->file = 'uploads/recipes/' . $fileimage;
            } else {
            $step->file = 'none';
            }
            $step->save();
        }
        $slug = DB::table('articles')->where('id', '=', $id_article)->first();
        Session::flash('success', 'This recipe was successfully saved');
        return redirect(route('personalize.showrecipe', $slug->slug));

    }

    public function storeBrewing(Request $request)
    {
        $input = Input::all();
        $material = $input['materialName'];
        $tools = $input['toolName'];
        $steps = $input['step'];
        $x=0;
        $filename = 'unknowncover.jpg';
        if ($request->hasFile('cover')) {
        $image = $request->file('cover');
		$filename  = 'cover'.time() . '.' . $image->getClientOriginalExtension();
		$path = public_path('uploads/brewings/' . $filename);
        Image::make($image->getRealPath())->save($path);
        }

        $id_article = Article::create([
            'id_status' => 1,
            'id_shared' => $request->input('shared'),
            'id_category' => 2,
            'id_user' => Auth::user()->id,
            // 'slug' => str_slug($request->input('title')),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'file' => 'uploads/brewings/'.$filename
        ])->id;

        Ingredient::create([
            'nama' => "Time",
            'jumlah' => $request->input('time1').' - '.$request->input('time2'),
            'satuan' => $request->input('second'),
            'id_article' => $id_article
        ]);

        Ingredient::create([
            'nama' => "Temperature",
            'jumlah' => $request->input('temperature'),
            'satuan' => $request->input('celcius'),
            'id_article' => $id_article
        ]);

        foreach($material as $key => $value){
            $ingredient = new Ingredient;
            $ingredient->nama = $input['materialName'][$key];
            $ingredient->jumlah = $input['materialAmount'][$key];
            $ingredient->satuan = $input['materialUnit'][$key];
            $ingredient->id_article =  $id_article;
            $ingredient->save(); 
        }

        foreach($tools as $key => $value){
            $tool = new Tool;
            $tool->nama = $input['toolName'][$key];
            $tool->jumlah = $input['toolAmount'][$key];
            $tool->satuan = $input['toolUnit'][$key];
            $tool->id_article =  $id_article;
            $tool->save();
        }
        foreach($steps as $key => $value){
            $step = new Step;
            $step->description = $input['step'][$key];
            $step->id_article =  $id_article;
            $x++;
                if ($request->hasFile('stepImage'.$x)) {
                $stepimage = $request->file('stepImage'.$x);
                $fileimage = $x . time() . '.' . $stepimage->getClientOriginalExtension();
                $pathimage = public_path('uploads/brewings/' . $fileimage);
                Image::make($stepimage->getRealPath())->save($pathimage);
                $step->file = 'uploads/brewings/'.$fileimage;
                }else{
                    $step->file = 'none';
                }
                $step->save();
        }
        $slug = DB::table('articles')->where('id', '=', $id_article)->first();
        Session::flash('success', 'This brewing method was successfully saved');
        return redirect(route('personalize.showbrewing', $slug->slug));

    }

    public function myRecipe()
    {
        $this->data['recipes'] = DB::table('articles')->where('id_category', '=', 1)->where('id_user','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('personalize.myrecipe',$this->data);
    }

    public function myBrewing()
    {
        $this->data['brewings'] = DB::table('articles')->where('id_category', '=', 2)->where('id_user','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('personalize.mybrewing',$this->data);
    }

    public function destroyBrewing($id)
    {
        $articles = Article::findOrFail($id);
        $articles->delete();

        // Session::flash('success', 'Deleted!');
        Session::flash('success', 'The brewing method was successfully deleted');
        return redirect()->route('personalize.mybrewing');
    }

    public function myArticle()
    {
        $this->data['articles'] = DB::table('articles')->where('id_category', '<>', 2)->where('id_category', '<>', 1)->where('id_user','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(6);
        return view('personalize.myarticle',$this->data);
    }

    public function myTechnique()
    {
        $this->data['techniques'] = DB::table('articles')->where('id_category', '=', 3, 'and', 'id_user','=',Auth::user()->id)->orderBy('id', 'desc')->paginate(9);
        return view('personalize.mytechnique',$this->data);
    }

    public function showRecipe($slug)
    {
        $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
        $article = DB::table('articles')->where('slug', '=', $slug)->first();		       	      
        $id_article=$article->id;
        $this->data['ingredients'] = DB::table('ingredients')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['tools'] = DB::table('tools')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['steps'] = DB::table('steps')->where('id_article', '=', $id_article)->orderBy('id')->get();
        return view('personalize.showrecipe',$this->data);
    }

    public function showBrewing($slug)
    {
        $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
        $article = DB::table('articles')->where('slug', '=', $slug)->first();		       	      
        $id_article=$article->id;
        $this->data['ingredients'] = DB::table('ingredients')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['tools'] = DB::table('tools')->where('id_article', '=', $id_article)->orderBy('id')->get();
        $this->data['steps'] = DB::table('steps')->where('id_article', '=', $id_article)->orderBy('id')->get();
        return view('personalize.showbrewing',$this->data);
    }

    public function showArticle($slug){
        $this->data['article'] = DB::table('articles')->where('slug', '=', $slug)->first();
        return view('personalize.showarticle', $this->data);

    }

    public function showTechnique($id)
    {
        $id_article=$id;
        $this->data['article'] = Article::find($id);		       	      
        // $this->data['time'] = DB::table('ingredients')->where('id_article', '=', $id_article, 'and', 'name', 'like', 'Time')->first();
        // $this->data['temperature'] = DB::table('ingredients')->where('id_article', '=', $id_article, 'and', 'name', 'like', 'Temperature')->first();
        $this->data['steps'] = DB::table('steps')->where('id_article', '=', $id_article)->orderBy('id')->get();
        return view('personalize.showtechnique',$this->data);
    }
}
