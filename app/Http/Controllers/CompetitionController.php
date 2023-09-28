<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Competition;
use App\Models\CompetitionType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function only()
    {
        $resources = Competition::get(['id', 'name']);
        return $resources;
    }

    public function onlyTypes(){
        $resources = CompetitionType::get(['id', 'name']);
        return $resources;
    }

    public function index()
    {
        $categories = Competition::paginate(10);
        
        return Inertia::render('Admin/Competitions/LIndex', [
            'resources' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Competitions/LCreate');
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
            'name' => 'required|max:255|unique:competitions',
            'color' => 'required',
        ]);
        // update resorce
        $resource =  new Competition();
        $resource->name = $request->name;
        $resource->color = $request->color;
        $resource->competition_type_id = $request->competition_type_id;
        $resource->save();
        
        return Redirect::route('competitions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Competition $competition)
    {
        return Inertia::render('Admin/Competitions/LShow', [
            'resource' => $competition
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Competition $competition)
    {
        return Inertia::render('Admin/Competitions/LEdit', [
            'resource' => $competition
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competition $competition)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,'.$competition->id,
            'color' => 'required',
        ]);
        
        $competition->name = $request->name;
        $competition->color = $request->color;
        $competition->save();
        
        return Inertia::render('Admin/Competitions/LEdit', [
            'resource' => $competition
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competition $competition)
    {
        $competition->delete();

        return Redirect::route('competitions.index');
    }
}
