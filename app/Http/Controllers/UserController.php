<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use App\ProProfile;
use App\ProExperience;
use App\ProAchievement;
use App\ProSkill;
use App\ProLanguage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use File;
use Image;
use Hash;
use Validator;
use Session;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('user.index')->withUsers($users);
    }

    public function create(){
        return view('user.create');
    }

    public function edit($id){
        $users = User::find($id);  
        return view('user.edit')->withUsers($users, $id);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required|max:12',
            'password' => 'required'
        ]);

        $users = User::findOrFail($id);
        
        $users->name = $request->input('name');
        $users->email = $request->input('email');
        $users->username = $request->input('username');
        $users->password = $request->input('password');
                
        $users->save();

        return redirect()->route('users.index')->with(['success' => 'Data Updated!']);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required|max:12',
            'password' => 'required'
        ]);

        $users = new User([
            'id_role' => 1,
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => $request->input('password')
        ]);

        $users->save();

        return redirect(route('users.index'));
    }

    public function destroy($id){
        $users = User::findOrFail($id);
        $users->delete();

        // Session::flash('success', 'Deleted!');

        return redirect()->route('users.index')->with(['success' => 'Deleted!']);
    }

    public function people()
    {
        $key = Input::get('search');
        if (isset($key)) {
        $this->data['people'] = Profile::where('fullname', 'like', '%' . $key . '%')->where('username','!=','admin')->orderBy('id','desc')->paginate(8);    
        } else {
        $this->data['people'] = Profile::where('username','!=','admin')->orderBy('id','desc')->paginate(8);
        }
        $this->data['user'] = User::all();
        $this->data['proAchievement'] = ProAchievement::all();
        $this->data['proExperience'] = ProExperience::all();   
        $this->data['proSkill'] = ProSkill::all();    	
        $this->data['proLanguage'] = ProLanguage::all();
        
        return view('user.people',$this->data);
    }

    public function peopleShow($id)
    {
        $this->data['people'] = Profile::where('id_user', 'like', $id)->first();
        $this->data['user'] = User::where('id', 'like', $id)->first();
        $this->data['proAchievement'] = ProAchievement::where('id_user', 'like', $id)->get();
        $this->data['proExperience'] = ProExperience::where('id_user', 'like', $id)->get();   
        $this->data['proSkill'] = ProSkill::where('id_user', 'like', $id)->get();    	
        $this->data['proLanguage'] = ProLanguage::where('id_user', 'like', $id)->get();
        
        return view('user.peopleshow',$this->data);
    }
    
    public function profileBasic(){   
        // $this->data['basic'] = Profile::all();
        $this->data['basic'] = Profile::where('username','like',Auth::user()->username)->first();
        $this->data['email'] = Auth::user()->email;
        
    	return view('user.basic',$this->data);
    }

    public function profileBasicUpdate(Request $request){
        
        // dd($request);
        $id = Auth::user()->id;   
        $username = Auth::user()->username;              

        // $result = Profile::find($id);

        // dd($username);

        if(Profile::where('username', $username) != NULL){
            Profile::where('username', $username)->update(array(
                'username' => Auth::user()->username,
                'id_user' => Auth::user()->id,
                'fullname' => $request->input('fullname'),
                'gender' => $request->input('gender'),
                'birthday' => date("Y-m-d", strtotime( $request->input('birthday'))),
                'phone' => $request->input('phone'),
                'city' => $request->input('city'),
                'profession' => $request->input('profession'),
                'sociallinks' => $request->input('sociallinks'),
                'portfoliolinks' => $request->input('portfoliolinks'),
                'address' => $request->input('address'),
                'aboutme' => $request->input('aboutme'),
            ));
        }else{
            Profile::where('username', $username)->create(array(
                'username' => Auth::user()->username,
                'id_user' => Auth::user()->id,
                'fullname' => $request->input('fullname'),
                'gender' => $request->input('gender'),
                'birthday' => date("Y-m-d", strtotime( $request->input('birthday'))),
                'phone' => $request->input('phone'),
                'city' => $request->input('city'),
                'profession' => $request->input('profession'),
                'sociallinks' => $request->input('sociallinks'),
                'portfoliolinks' => $request->input('portfoliolinks'),
                'address' => $request->input('address'),
                'aboutme' => $request->input('aboutme'),
            ));
        }

		return redirect()->back()->with('info','Success! Profile has been updated');
    }

    public function proProfile(){    	
    	$this->data['proprofile'] = ProProfile::where('username','like',Auth::user()->username)->first();
        $this->data['basic'] = Profile::where('username','like',Auth::user()->username)->first();
    	return view('user.proprofile',$this->data);
    }

    public function proProfileUpdate(Request $request){    	
    	$input = $request->all();
        $input['username'] = Auth::user()->username;
        $input['id_user'] = Auth::user()->id;
    	$data = ProProfile::where('username','like',Auth::user()->username)->first();
	    if($data!=null){
			if($request->file('resume')){
                $validator = Validator::make($request->all(), [
            'resume' => 'required|mimes:doc,docx,pdf',
        ], [
            'resume.required' => 'Resume needed!',            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
	       		File::delete('resume/' . $data->resume);	        
	        	$resume = $request->file('resume');
	        	$input['resume'] = time().'_'.Auth::user()->username.'.'.$resume->getClientOriginalExtension();
	   
	        	$destinationPath = public_path('/resume');
	        	$request->file('resume')->move(
        			$destinationPath, $input['resume']
    			);
				ProProfile::where('username','like',Auth::user()->username)->update($input);
    		}
    		else{
    			ProProfile::where('username','like',Auth::user()->username)->update($input);
    		}
    	}else{
    		$this->validate($request, [	    	
	            	'resume' => 'required|mimes:doc,docx,pdf',
	        	]);	       	
    			$resume = $request->file('resume');
	        	$input['resume'] = time().'_'.Auth::user()->username.'.'.$resume->getClientOriginalExtension();
	   
	        	$destinationPath = public_path('/resume');
	        	$request->file('resume')->move(
        			$destinationPath, $input['resume']
    			);
    			ProProfile::create($input);
    	}		
		return redirect()->back()->with('info','Success! Professional profile has been updated');
    }

    public function proAccomplishments(){    	
    	$this->data['proAchievement'] = ProAchievement::where('username','like',Auth::user()->username)->get();
    	$this->data['beforeyear1'] = date('Y') - 59;
    	$this->data['beforeyear2'] = date('Y') - 52;
        $this->data['basic'] = Profile::where('username','like',Auth::user()->username)->first();
    	return view('user.proacademic',$this->data);
    }

    public function proAchievementAdd(Request $request){
    	$input = $request->all();
        $input['username'] = Auth::user()->username;
        $input['id_user'] = Auth::user()->id;
    	ProAchievement::create($input);
    	return response($request->all());
    }

    public function proExperience(){    	
    	$this->data['proExperience'] = ProExperience::where('username','like',Auth::user()->username)->get();       
    	$this->data['beforeyear1'] = date('Y') - 59;
    	$this->data['beforeyear2'] = date('Y') - 52;
        $this->data['basic'] = Profile::where('username','like',Auth::user()->username)->first();
    	return view('user.proexperience',$this->data);
    }

    public function proExperienceAdd(Request $request){

        if($request->ajax()){
            $input = $request->all();
            $input['username'] = Auth::user()->username;
            $input['id_user'] = Auth::user()->id;
            ProExperience::create($input);
            return response($request->all());
        }
    	// return redirect()->back()->with('info','Success! New work experience has been added');
    }

    public function proSkill(){    	
    	$this->data['proSkill'] = ProSkill::where('username','like',Auth::user()->username)->get();    	
        $this->data['proLanguage'] = ProLanguage::where('username','like',Auth::user()->username)->get();
        $this->data['proAchievement'] = ProAchievement::where('username','like',Auth::user()->username)->get();
    	$this->data['beforeyear1'] = date('Y') - 59;
    	$this->data['beforeyear2'] = date('Y') - 52;
        $this->data['basic'] = Profile::where('username','like',Auth::user()->username)->first();  	    	
    	return view('user.proskill',$this->data);
    }

    public function proSkillAdd(Request $request){
    	$input = $request->all();
        $input['username'] = Auth::user()->username;
        $input['id_user'] = Auth::user()->id;
    	ProSkill::create($input);
    	return response($request->all());
    }

    public function proLanguageAdd(Request $request){
    	$input = $request->all();
        $input['username'] = Auth::user()->username;
        $input['id_user'] = Auth::user()->id;
    	ProLanguage::create($input);
    	return response($request->all());
    }   

    public function passwordChange(){
        $this->data['basic'] = Profile::where('username','like',Auth::user()->username)->first();
        return view('user.changepassword', $this->data);
    }

    public function passwordChangeUpdate(Request $request){
        $input = $request->all();
        $data = User::where('username','like',Auth::user()->username)->first();
        if(!(Hash::check(($input['old']), $data->password))){
            return redirect()->back()->with('error','Old password is wrong. Please enter correct password');
        }
        else{
            User::where('username','like',Auth::user()->username)->update(['password' => bcrypt($input['password'])]);
        }        
        return redirect()->back()->with('info','Success! Password has been changed');
    }

    public function avatarChange(){
        $this->data['basic'] = Profile::where('username','like',Auth::user()->username)->first();
        return view('user.changeavatar', $this->data);
    }

    public function avatarChangeUpdate(Request $request){
        $input = $request->all();
        $data = Profile::where('username','like',Auth::user()->username)->first();        
            
            $validator = Validator::make($request->all(), [
            'photo' => 'required|mimes:jpg,jpeg,png',
        ], [
            'photo.required' => 'Avatar needed!',            
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
                if($data->photo!='unknown.png')   
                    File::delete('image/avatar/' . $data->photo);            

                $photo = $request->file('photo');
                $input['photo'] = time().'_'.Auth::user()->username.'.'.$photo->getClientOriginalExtension();
       
                $destinationPath = public_path('/image/avatar');
                $img = Image::make($photo->getRealPath());
                $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$input['photo']);
                Profile::where('username','like',Auth::user()->username)->update($input);
        return redirect()->back()->with('info','Success! Avatar has been changed');
    }

}
