<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Shared;
use App\Recipe;
use App\Favourite;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use Session;
use Purifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $key = Input::get('search');
        if (isset($key)) {
            $recipes = Recipe::where('title', 'like', '%' . $key . '%')->where('shared_id','=',1)->orderBy('id', 'desc')->paginate(6);
        } else {
            $recipes = Recipe::where('shared_id','=',1)->orderBy('id', 'desc')->paginate(6);
        }
        if(Auth::check()){
            $favourites = Favourite::where('user_id', '=', Auth::user()->id)->get();
        }
        return view('recipes.index')->withRecipes($recipes)->withFavourites($favourites);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shareds = Shared::all();
        return view('recipes.create')->withShareds($shareds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = Input::all();
        $materials = $request->materialName;
        $tools = $request->toolName;
        $steps = $request->step;
        $step_images = $request->file('stepImage');

        $filename = 'unknowncover.jpg';
        $hashed = md5(uniqid(Auth::user()->id*rand(), true));
        if ($request->hasFile('cover')) {
            $image = Input::file('cover');
			$filename  = $hashed.'_'.time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('uploads/recipes/' . $filename);
			Image::make($image->getRealPath())->save($path);
        }

        $recipe = new Recipe;
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->image = $filename;
        $recipe->status_id = $request->status;
        $recipe->shared_id = $request->shared;
        $recipe->user_id = Auth::user()->id;

        $ingredients = array();
        foreach($materials as $key => $value){
            array_push($ingredients,
                array(
                'name' => $input['materialName'][$key],
                'amount' => $input['materialAmount'][$key],
                'unit' => $input['materialUnit'][$key],
                )
            );
        }
        $recipe->ingredients = json_encode($ingredients);

        $tool = array();
        foreach($tools as $key => $value){
            array_push($tool,
                array(
                    'name' => $input['toolName'][$key],
                    'amount' => $input['toolAmount'][$key],
                    'unit' => $input['toolUnit'][$key],
                )
            );
        }
        $recipe->tools = json_encode($tool);

        $step = array();
        foreach($steps as $key => $value){
            array_push($step, $input['step'][$key]
            );
        }
        $recipe->steps = json_encode($step);

        $counter=1;
        $step_image = array();
        foreach($step_images as $image){
            $fileimage='none';
            if($image!=""){
                $fileimage = $hashed . '_' . $counter . time() . '.' . $image->getClientOriginalExtension();
                $pathimage = public_path('uploads/recipes/steps/' . $fileimage);
                Image::make($image->getRealPath())->save($pathimage);
            }
            $counter++;
            array_push($step_image, $fileimage
            );
        }
        $recipe->step_images = json_encode($step_image);
        $recipe->save();
        die();
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
    public function edit($slug)
    {
        $recipe = Recipe::where('slug', '=', $slug)->first();
        $shareds = Shared::all();
        return view('recipes.edit')->withRecipe($recipe)->withShareds($shareds);
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
        $input = Input::all();
        $materials = $request->materialName;
        $tools = $request->toolName;
        $steps = $request->step;
        $images = $request->imageName;
        $step_images = $request->file('stepImage');
        $hashed = md5(uniqid(Auth::user()->id*rand(), true));

        $recipe = Recipe::findOrFail($id);
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        if ($request->hasFile('cover')) {
            $image = Input::file('cover');
			$filename  = $hashed.'_'.time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('uploads/recipes/' . $filename);
            Image::make($image->getRealPath())->save($path);
            if($recipe->image!='unknowncover.jpg'){
                $file_to_delete = public_path('uploads/recipes/' . $recipe->image);
                File::delete($file_to_delete);
            }
            $recipe->image = $filename;
        }
        $recipe->shared_id = $request->shared;
        $recipe->slug = null;

        $ingredients = array();
        foreach($materials as $key => $value){
            array_push($ingredients,
                array(
                'name' => $input['materialName'][$key],
                'amount' => $input['materialAmount'][$key],
                'unit' => $input['materialUnit'][$key],
                )
            );
        }
        $recipe->ingredients = json_encode($ingredients);

        $tool = array();
        foreach($tools as $key => $value){
            array_push($tool,
                array(
                    'name' => $input['toolName'][$key],
                    'amount' => $input['toolAmount'][$key],
                    'unit' => $input['toolUnit'][$key],
                )
            );
        }
        $recipe->tools = json_encode($tool);

        $step = array();
        foreach($steps as $key => $value){
            array_push($step, $input['step'][$key]
            );
        }
        $recipe->steps = json_encode($step);

        $counter=1;
        $step_image = array();
        print_r($images);
        foreach($step_images as $key => $image){
            $fileimage='none';
            if($image!=""){
                $fileimage = $hashed . '_' . $counter . time() . '.' . $image->getClientOriginalExtension();
                $pathimage = public_path('uploads/recipes/steps/' . $fileimage);
                Image::make($image->getRealPath())->save($pathimage);
                if($images[$key]!='none'){
                    $file_to_delete = public_path('uploads/recipes/steps/' . $images[$key]);
                    File::delete($file_to_delete);
                }
            }else{
                $fileimage = $images[$key];
            }
            $counter++;
            array_push($step_image, $fileimage);
        }
        $recipe->step_images = json_encode($step_image);
        print_r($recipe->step_images);
        $recipe->save();
        die();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
