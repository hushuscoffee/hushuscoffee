<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Achievement;
use App\Language;
use App\Experience;
use App\Skill;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use Hash;
use Validator;
use Session;

class ProfileController extends Controller
{
    public function profileIndex(){
        $basic = Profile::where('user_id','=',Auth::user()->id)->first();
        return view('users.profiles.index')->withBasic($basic);
    }

    public function profileUpdate(Request $request){
        $validator = Validator::make($request->all(), [
            'photo' => 'mimes:jpg,jpeg,png',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($request->hasFile('photo')) {
            $profile = Profile::where('user_id', Auth::user()->id)->first();
            if($profile->photo!='unknown.png'){   
                    File::delete('images/avatar/' . $profile->photo);
            }
            $image = Input::file('photo');
            $destinationPath = public_path('images/avatar');
            $filename = time() .'_'.Auth::user()->username.'.'. $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$filename);
            $profile->photo= $filename;
            $profile->save();
        }

        Profile::where('user_id', Auth::user()->id)->update(array(
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
        return redirect()->back()->with('info','Success! Profile has been updated');
    }

    public function achievementIndex(){
        $achievements = Achievement::where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->get();
        $this->data['beforeyear1'] = date('Y') - 59;
    	$this->data['beforeyear2'] = date('Y') - 52;
        return view('users.achievements.index',$this->data)->withAchievements($achievements);
    }

    public function achievementCreate(Request $request){
        $achievement = new Achievement();
        $achievement->user_id = Auth::user()->id;
        $achievement->title = $request->title;
        $achievement->link = $request->link;
        $achievement->issuer = $request->issuer;
        $achievement->month = $request->month;
        $achievement->year = $request->year;
        $achievement->description = $request->description;
        $achievement->save();
        return redirect()->back()->with('info','Success! Achievement has been added');
    }

    public function achievementUpdate(Request $request){
        
    }

    public function achievementDestroy($id){
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();
        return redirect()->back()->with('info','Success! Achievement has been deleted');
    }

    public function experienceIndex(){
        $experiences = Experience::where('user_id','=',Auth::user()->id)->orderBy('id', 'desc')->get();
        $this->data['beforeyear1'] = date('Y') - 59;
    	$this->data['beforeyear2'] = date('Y') - 52;
        return view('users.experiences.index',$this->data)->withExperiences($experiences);
    }

    public function experienceCreate(Request $request){
        $experience = new Experience();
        $experience->user_id = Auth::user()->id;
        $experience->title = $request->title;
        $experience->link = $request->link;
        $experience->company = $request->company;
        $experience->position = $request->position;
        $experience->location = $request->location;
        $experience->status = $request->get('status');
        if($request->get('status')==1){
            $experience->monthf = $request->monthf_check;
            $experience->yearf = $request->yearf_check;
            $experience->montht = null;
            $experience->yeart = null;
        }else{
            $experience->monthf = $request->monthf;
            $experience->yearf = $request->yearf;
            $experience->montht = $request->montht;
            $experience->yeart = $request->yeart;
        }
        $experience->description = $request->description;
        $experience->save();
        return redirect()->back()->with('info','Success! Experience has been added');
    }

    public function experienceDestroy($id){
        $experience = Experience::findOrFail($id);
        $experience->delete();
        return redirect()->back()->with('info','Success! Experience has been deleted');
    }

    public function experienceUpdate(){
        
    }

    public function skillIndex(){
        $skills = Skill::where('user_id','=',Auth::user()->id)->orderBy('id','desc')->get();
        return view('users.skills.index')->withSkills($skills);
    }

    public function skillCreate(Request $request){
        $skill = new Skill();
        $skill->user_id = Auth::user()->id;
        $skill->skill = $request->skill;
        $skill->proficiency = $request->proficiency;
        $skill->save();
    	return redirect()->back()->with('info','Success! Skill has been added');
    }

    public function skillDestroy($id){
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect()->back()->with('info','Success! Skill has been deleted');
    }

    public function languageIndex(){
        $languages = Language::where('user_id','=',Auth::user()->id)->orderBy('id','desc')->get();
        return view('users.languages.index')->withLanguages($languages);
    }

    public function languageCreate(Request $request){
        $language = new Language();
        $language->user_id = Auth::user()->id;
        $language->language = $request->language;
        $language->proficiency = $request->proficiency;
        $language->save();
    	return redirect()->back()->with('info','Success! Language has been added');
    }

    public function languageDestroy($id){
        $language = Language::findOrFail($id);
        $language->delete();
        return redirect()->back()->with('info','Success! Language has been deleted');
    }
}
