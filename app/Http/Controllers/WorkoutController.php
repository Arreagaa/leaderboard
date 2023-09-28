<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class WorkoutController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function only()
    {
        $resources = Workout::get(['id', 'name']);
        return $resources;
    }

    public function index()
    {
        $workouts = Workout::paginate(10);
        
        return Inertia::render('Admin/Workouts/LIndex', [
            'resources' => $workouts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Workouts/LCreate');
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
            'name' => 'required|max:255|unique:workouts',
            'description' => 'required',
        ]);

        // update resorce
        $workout =  new Workout();
        $workout->name = $request->name;
        $workout->description = $request->description;
        $workout->competition_type_id = $request->competition_type_id;
        
        $workout->save();
        
        return Redirect::route('workouts.index');
        // return response()->json(['message' => 'stored_successfully', 'workout' => $workout]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(Workout $workout)
    {
        return Inertia::render('Admin/Workouts/LShow', [
            'resource' => $workout
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        return Inertia::render('Admin/Workouts/LEdit', [
            'resource' => $workout
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Workout $workout)
    {
        $request->validate([
            'name' => 'required|max:255|unique:workouts,name,'.$workout->id,
            'description' => 'required',
        ]);
        
        $workout->name = $request->name;
        $workout->description = $request->description;
        $workout->save();
        
        return Inertia::render('Admin/Workouts/LEdit', [
            'resource' => $workout
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();

        return Redirect::route('workouts.index');
        // return response()->json(['message' => 'deleted_successfully']);
    }
}
