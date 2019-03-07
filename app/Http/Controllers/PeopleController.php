<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Achievement;
use App\Experience;
use App\Language;
use App\Skill;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class PeopleController extends Controller
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
            $people = Profile::where('fullname', 'like', '%' . $key . '%')->inRandomOrder()->paginate(8);
        } else {
            $people = Profile::inRandomOrder()->paginate(8);
        }
        
        return view('users.people.index')->withPeople($people);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->data['people'] = Profile::where('user_id', '=', $id)->first();
        $this->data['achievement'] = Achievement::where('user_id', '=', $id)->orderBy('id','desc')->get();
        $this->data['experience'] = Experience::where('user_id', '=', $id)->orderBy('id','desc')->get();   
        $this->data['skill'] = Skill::where('user_id', 'like', $id)->orderBy('id','desc')->get();    	
        $this->data['language'] = Language::where('user_id', 'like', $id)->orderBy('id','desc')->get();
        return view('users.people.show',$this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
