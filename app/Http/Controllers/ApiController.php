<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use Illuminate\Support\Facades\Hash;

use DB;
use App\Article;
use App\Brewing;
use App\Recipe;
use App\Profile;
use App\Favourite;
use App\Achievement;
use App\Experience;
use App\Language;
use App\Skill;
use App\User;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllArticle()
    {
        $articles = Article::where('shared_id','=',1)->orderBy('id', 'desc')->get();

        return response()->json([
            'message'=> "success",
            'data' => $articles
        ], 200);
    }

    public function getHomeArticle()
    {
        $articles = Article::where('shared_id','=',1)->orderBy('id','desc')->limit(5)->get();

        return response()->json([
            'message'=> "success",
            'data' => $articles
        ], 200);
    }

    public function getHomePeople()
    {
        $people = Profile::orderBy('id','desc')->limit(5)->get();

        return response()->json([
            'message'=> "success",
            'data' => $people
        ], 200);
    }

    public function getHomeEvents()
    {
        $events = DB::table('articles')
        ->where('category_id', 1)
        ->where('shared_id','=',1)
        ->orderBy('id','desc')->limit(8)
        ->get();

        return response()->json([
            'message'=> "success",
            'data' => $events
        ], 200);
    }

    public function getHomeNews()
    {
        $news = DB::table('articles')
        ->where('category_id', 2)
        ->where('shared_id','=',1)
        ->orderBy('id','desc')->limit(8) 
        ->get();

        return response()->json([
            'message'=> "success",
            'data' => $news
        ], 200);
    }

    public function getHomeTips()
    {
        $tips = DB::table('articles')
            ->where('category_id', 3)
            ->where('shared_id','=',1)
            ->orderBy('id','desc')->limit(8)
            ->get();

        return response()->json([
            'message'=> "success",
            'data' => $tips
        ], 200);
    }

    public function getAllEvents()
    {
        $events = DB::table('articles')->where('category_id', 1)->where('shared_id','=',1)->get();

        return response()->json([
            'message'=> "success",
            'data' => $events
        ], 200);
    }

    public function getAllNews()
    {
        $news = DB::table('articles')->where('category_id', 2)->where('shared_id','=',1)->get();

        return response()->json([
            'message'=> "success",
            'data' => $news
        ], 200);
    }

    public function getAllTips()
    {
        $tips = DB::table('articles')->where('category_id', 3)->where('shared_id','=',1)->get();

        return response()->json([
            'message'=> "success",
            'data' => $tips
        ], 200);
    }

    public function getAllBrewing()
    {
        $brewing = Brewing::where('shared_id','=',1)->orderBy('id', 'desc')->get();

        return response()->json([
            'message'=> "success",
            'data' => $brewing
        ], 200);
    }

    public function getAllRecipe()
    {
        $recipe = Recipe::where('shared_id','=',1)->orderBy('id', 'desc')->get();

        return response()->json([
            'message'=> "success",
            'data' => $recipe
        ], 200);
    }

    public function getAllPeople()
    {
        $user = Profile::all();

        return response()->json([
            'message'=> "success",
            'data' => $user
        ], 200);
    }

    public function getDetailArticle($id)
    {
        $article = DB::table('articles')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => "success",
            'data' => $article
        ], 200);
    }

    public function getDetailEvents($id)
    {
        $events = DB::table('articles')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => "success",
            'data' => $events
        ], 200);
    }

    public function getDetailNews($id)
    {
        $news = DB::table('articles')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => "success",
            'data' => $news
        ], 200);
    }

    public function getDetailTips($id)
    {
        $tips = DB::table('articles')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => "success",
            'data' => $tips
        ], 200);
    }

    public function getDetailBrewing($id)
    {
        $brewing = DB::table('brewings')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => "success",
            'data' => $brewing
        ], 200);
    }

    public function getDetailRecipe($id)
    {
        $recipe = DB::table('recipes')
                        ->select('*')
                        ->where('id', '=', $id)
                        ->get();

        return response()->json([
            'message' => "success",
            'data' => $recipe
        ], 200);
    }

    public function getDetailPeople($id)
    {
        $profile = Profile::where('user_id', '=', $id)->first();
        $achievement = Achievement::where('user_id', '=', $id)->orderBy('id','desc')->get();
        $experience = Experience::where('user_id', '=', $id)->orderBy('id','desc')->get();   
        $skill = Skill::where('user_id', 'like', $id)->orderBy('id','desc')->get();    	
        $language = Language::where('user_id', 'like', $id)->orderBy('id','desc')->get();

        return response()->json([
            'message' => "success",
            'profile' => $profile,
            'achievement' => $achievement,
            'experience' => $experience,
            'skill' => $skill,
            'language' => $language
        ], 200);
    }

    public function getMyArticle($id)
    {
        $articles = Article::where('user_id','=',$id)->orderBy('id', 'desc')->get();
        if ($articles->count()!=0){
            return response()->json([
                'message'=> "success",
                'data' => $articles
            ], 200);
        }else{
            return response()->json([
                'message'=> "error",
                'data' => $articles
            ], 401);
        }
    }

    public function getMyBrewing($id)
    {
        $brewings = Brewing::where('user_id','=',$id)->orderBy('id', 'desc')->get();
        if ($brewings->count()!=0){
            return response()->json([
                'message'=> "success",
                'data' => $brewings
            ], 200);
        }else{
            return response()->json([
                'message'=> "error",
                'data' => $brewings
            ], 401);
        }
    }

    public function getMyRecipe($id)
    {
        $recipes = Recipe::where('user_id','=',$id)->orderBy('id', 'desc')->get();
        if ($recipes->count()!=0){
            return response()->json([
                'message'=> "success",
                'data' => $recipes
            ], 200);
        }else{
            return response()->json([
                'message'=> "error",
                'data' => $recipes
            ], 401);
        }
    }

    // public function getFavourite($id){
    //     $favs = Favourite::where('user_id','=',$id)->orderBy('id', 'desc')->get();
    //     $article = Article::where('id', '=', $fav->article_id)->where('shared_id', '=', 1)->first();
    //     $brewing = Brewing::where('id', '=', $fav->brewing_id)->where('shared_id', '=', 1)->first();
    //     $recipe = Recipe::where('id', '=', $fav->recipe_id)->where('shared_id', '=', 1)->first();
    //     if ($favs->count()!=0){
    //         return response()->json([
    //             'message'=> "success",
    //             'article' => $article,
    //             'brewing' => $brewing,
    //             'recipe' => $recipe
    //         ], 200);
    //     }else{
    //         return response()->json([
    //             'message'=> "error",
    //             'article' => $article,
    //             'brewing' => $brewing,
    //             'recipe' => $recipe
    //         ], 401);
    //     }
    // }

    // public function add($user, $id, $category)
    // {
    //     $favourite = new Favourite;
    //     $favourite->user_id = Auth::user()->id;
    //     if($category==1){
    //         $favourite->article_id = $id;
    //     }elseif($category==2){
    //         $favourite->brewing_id = $id;
    //     }elseif($category==3){
    //         $favourite->recipe_id = $id;
    //     }
    //     $favourite->save();
    //     Session::flash('success', 'Successfully added to favourites');
    //     return redirect()->back();
    // }

    //Authentication API

    public function login(Request $request)
    {
    	if(!Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
    		return response()->json(['message' => "error", 'error' => "Wrong Username or Password"], 401);
    	}

    	$user = User::find(Auth::user()->id);

    	return response()->json([
            'message' => "success",
            'data' => $user
        ], 200);
    }

    public function register(Request $request) {

        $validator1 = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',           
        ]);
        // Email Validation
        $validator2 = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        // Validation Process
        if ($validator1->fails()) {
            return response()->json(['message' => "error", 'error' => "Username has been registered. Please choose another username"], 401);
        }elseif($validator2->fails()){
            return response()->json(['message' => "error", 'error' => "Email has been registered. Please choose another email"], 401);
        }elseif($request->password!=$request->password_confirmation){
            return response()->json(['message' => "error", 'error' => "Password and confirm password did not match. Please enter your password carefully"], 401);
        }
        else{
            // Create User
            $user = new User;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role_id = 2;
            $user->save();
            // End of Create User

            // Create Profile
            $profile = new Profile;
            $profile->user_id = $user->id;
            $profile->photo = 'unknown.png';
            $profile->fullname = $request->username;
            $profile->save();
            // End of Create Profile
            

            return response()->json([
                'message' => "success",
                'data' => $user
            ], 200);
        }

    }

    //End of Authentication API

    //Article CRUD API
    public function storeArticle(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        
        $filename = 'unknowncover.jpg';
        // if ($request->hasFile('file')) {
        //     $hashed = md5(uniqid($request->user, true));
        //     $image = Input::file('file');
		// 	$filename  = $hashed.'_'.time() . '.' . $image->getClientOriginalExtension();
		// 	$path = public_path('uploads/articles/' . $filename);
		// 	Image::make($image->getRealPath())->save($path);
        // }
        $article = new Article;
        $article->status_id = 1;
        $article->shared_id = $request->shared;
        $article->category_id = $request->category;
        $article->user_id = $request->user;
        $article->title = $request->title;
        $article->description = $request->description;
        $article->image = $filename;
        
        $article->save();
        return response()->json([
            'message' => "success",
            'data' => $article
        ], 200);
    }

    public function updateArticle(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->description = $request->description;
        $article->shared_id = $request->shared;
        $article->category_id = $request->category;

        if ($request->hasFile('file')) {
            $hashed = md5(uniqid(Auth::user()->id, true));
            $image = Input::file('file');
			$filename  = $hashed.'_'.time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('uploads/articles/' . $filename);
            Image::make($image->getRealPath())->save($path);
            if($article!='unknowncover.jpg'){
                $file_to_delete = public_path('uploads/articles/' . $article->image);
                File::delete($file_to_delete);
            }
            $article->image = $filename;
        }
        $article->slug = null;
        $article->save();

        return response()->json([
            'message' => "success",
            'data' => $article
        ], 200);
    }

    public function destroyArticle($id)
    {
        $article = Article::find($id);
        $article->delete();

        return response()->json([
            'message' => "success"
        ], 200);
    }
    //End of Article CRUD API


    //Brewing CRUD API
    public function storeBrewing(Request $request)
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
        $brewing->description = $request->description;
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
        return response()->json([
            'message' => "success",
            'data' => $brewing
        ], 200);
    }

    public function updateBrewing(Request $request, $id)
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
        $brewing->description = $request->description;
        if ($request->hasFile('cover')) {
            $image = Input::file('cover');
			$filename  = $hashed.'_'.time() . '.' . $image->getClientOriginalExtension();
			$path = public_path('uploads/brewings/' . $filename);
            Image::make($image->getRealPath())->save($path);
            if($brewing->image!='unknowncover.jpg'){
                $file_to_delete = public_path('uploads/brewings/' . $brewing->image);
                File::delete($file_to_delete);
            }
            $brewing->image = $filename;
        }
        $brewing->shared_id = $request->shared;
        $brewing->slug = null;

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
        $brewing->save();
        return response()->json([
            'message' => "success",
            'data' => $brewing
        ], 200);
    }

    public function destroyBrewing($id)
    {
        $brewing = Brewing::find($id);
        $brewing->delete();
        return response()->json([
            'message' => "success"
        ], 200);
    }
    //End of Brewing CRUD API


    //Recipe CRUD API
    public function storeRecipe(Request $request)
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

        return response()->json([
            'message' => "success",
            'data' => $recipe
        ], 200);
    }

    public function updateRecipe(Request $request, $id)
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
        $recipe->save();

        return response()->json([
            'message' => "success",
            'data' => $recipe
        ], 200);
    }

    public function destroyRecipe($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();

        return response()->json([
            'message' => "success"
        ], 200);
    }

    //End of Recipe CRUD API

}
