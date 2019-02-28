<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Shared;
use App\Brewing;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use Session;
use Purifier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BrewingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shareds = Shared::all();
        return view('brewings.create')->withShareds($shareds);
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
			$path = public_path('uploads/brewings/' . $filename);
			Image::make($image->getRealPath())->save($path);
        }

        $brewing = new Brewing;
        $brewing->title = $request->title;
        $brewing->description = Purifier::clean($request->description);
        $brewing->image = $filename;
        $brewing->status_id = $request->status;
        $brewing->shared_id = $request->shared;
        $brewing->user_id = Auth::user()->id;

        $time = array(
            'time1' => $request->time1,
            'time2' => $request->time2,
            'unit' => $request->second,
        );
        $brewing->time = json_encode($time);

        $temperature = array(
            'temperature' => $request->temperature,
            'unit' => $request->celcius,
        );
        $brewing->temperature = json_encode($temperature);

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
        $brewing->ingredients = json_encode($ingredients);

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
        $brewing->tools = json_encode($tool);

        $step = array();
        foreach($steps as $key => $value){
            array_push($step, $input['step'][$key]
            );
        }
        $brewing->steps = json_encode($step);

        $counter=1;
        $step_image = array();
        foreach($step_images as $image){
            $fileimage='none';
            if($image!=""){
                $fileimage = $hashed . '_' . $counter . time() . '.' . $image->getClientOriginalExtension();
                $pathimage = public_path('uploads/brewings/steps/' . $fileimage);
                Image::make($image->getRealPath())->save($pathimage);
            }
            $counter++;
            array_push($step_image, $fileimage
            );
        }
        $brewing->step_images = json_encode($step_image);
        $brewing->save();
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
        $brewing = Brewing::where('slug', '=', $slug)->first();
        $shareds = Shared::all();
        return view('brewings.edit')->withBrewing($brewing)->withShareds($shareds);
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

        $brewing = Brewing::findOrFail($id);
        $brewing->title = $request->title;
        $brewing->description = Purifier::clean($request->description);
        if ($request->hasFile('cover')) {
            $image = Input::file('cover');
			$filename  = $hashed.'_'.time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('uploads/brewings/' . $filename);
            Image::make($image->getRealPath())->save($path);
            if($article!='unknowncover.jpg'){
                $file_to_delete = public_path('uploads/brewings/' . $brewing->image);
                File::delete($file_to_delete);
            }
            $brewing->image = $filename;
        }
        $brewing->shared_id = $request->shared;

        $time = array(
            'time1' => $request->time1,
            'time2' => $request->time2,
            'unit' => $request->second,
        );
        $brewing->time = json_encode($time);

        $temperature = array(
            'temperature' => $request->temperature,
            'unit' => $request->celcius,
        );
        $brewing->temperature = json_encode($temperature);

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
        $brewing->ingredients = json_encode($ingredients);

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
        $brewing->tools = json_encode($tool);

        $step = array();
        foreach($steps as $key => $value){
            array_push($step, $input['step'][$key]
            );
        }
        $brewing->steps = json_encode($step);

        $counter=1;
        $step_image = array();
        print_r($images);
        foreach($step_images as $key => $image){
            $fileimage='none';
            if($image!=""){
                $fileimage = $hashed . '_' . $counter . time() . '.' . $image->getClientOriginalExtension();
                $pathimage = public_path('uploads/brewings/steps/' . $fileimage);
                Image::make($image->getRealPath())->save($pathimage);
                if($images[$key]!='none'){
                    $file_to_delete = public_path('uploads/brewings/steps/' . $images[$key]);
                    File::delete($file_to_delete);
                }
            }else{
                $fileimage = $images[$key];
            }
            $counter++;
            array_push($step_image, $fileimage);
        }
        $brewing->step_images = json_encode($step_image);
        print_r($brewing->step_images);
        $brewing->save();
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
