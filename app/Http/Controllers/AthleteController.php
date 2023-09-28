<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class AthleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function only()
    {
        $resources = Athlete::with('category')->get();
        return $resources;
    }

    public function index()
    {
        $resources = Athlete::paginate(10);
        
        return Inertia::render('Admin/Athletes/LIndex', [
            'resources' => $resources,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Athletes/LCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'box' => 'required',
            'image' => ['required',
                File::image()
                    ->max(4 * 1048576),
            ],
            'category_id' => 'required|exists:categories,id',
            'date_of_birth' => 'required|date',
            'dpi' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'name_contact_emergency' => 'required',
            'phone_contact_emergency' => 'required',
            'shirt_size' => 'required',
            'sex' => 'required'
        ]);

        // update resorce
        $resource =  new Athlete();
        $resource->name = $request->name;
        $resource->last_name = $request->last_name;
        $resource->box = $request->box;
        $resource->image = "";
        $resource->category_id = $request->category_id;
        $resource->date_of_birth = $request->date_of_birth;
        $resource->dpi = $request->dpi;
        $resource->phone = $request->phone;
        $resource->email = $request->email;
        $resource->name_contact_emergency = $request->name_contact_emergency;
        $resource->phone_contact_emergency = $request->phone_contact_emergency;
        $resource->shirt_size = $request->shirt_size;
        $resource->sex = $request->sex;
        $resource->save();
        
        return Redirect::route('athletes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function show(Athlete $athlete)
    {
        return Inertia::render('Admin/Athletes/LShow', [
            'resource' => $athlete
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function edit(Athlete $athlete)
    {
        return Inertia::render('Admin/Athletes/LEdit', [
            'resource' => $athlete
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Athlete $athlete)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'box' => 'required',
            'category_id' => 'required|exists:categories,id',
            'date_of_birth' => 'required|date',
            'dpi' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'name_contact_emergency' => 'required',
            'phone_contact_emergency' => 'required',
            'shirt_size' => 'required',
            'sex' => 'required'
        ]);

        // update resorce
        $athlete->name = $request->name;
        $athlete->last_name = $request->last_name;
        $athlete->box = $request->box;
        // $athlete->image = $request->image;
        $athlete->category_id = $request->category_id;
        $athlete->date_of_birth = $request->date_of_birth;
        $athlete->dpi = $request->dpi;
        $athlete->phone = $request->phone;
        $athlete->email = $request->email;
        $athlete->name_contact_emergency = $request->name_contact_emergency;
        $athlete->phone_contact_emergency = $request->phone_contact_emergency;
        $athlete->shirt_size = $request->shirt_size;
        $athlete->sex = $request->sex;
        $athlete->save();
        
        return Inertia::render('Admin/Athletes/LEdit', [
            'resource' => $athlete
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Athlete  $athlete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Athlete $athlete)
    {
        $athlete->delete();

        return Redirect::route('athletes.index');
    }
}
