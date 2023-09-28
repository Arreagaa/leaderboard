<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\Category;
use App\Models\CategoryWorkout;
use App\Models\CategoryWorkoutResult;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function only()
    {
        $resources = Category::get(['id', 'name']);
        return $resources;
    }

    public function onlyWorkouts($category_id){
        $resources = CategoryWorkout::where('category_id', $category_id)->get()->pluck('workout_id');
        $resources = Workout::whereIn('id', $resources)->get();

        return $resources;
    }

    public function onlyAthletes($category_id){
        $resources = Athlete::where('category_id', $category_id)->get();
        return $resources;
    }

    public function index()
    {
        $categories = Category::paginate(10);
        
        return Inertia::render('Admin/Categories/LIndex', [
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
        return Inertia::render('Admin/Categories/LCreate');
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
            'name' => 'required|max:255|unique:categories',
            'abreviature' => 'required',
            'color' => 'required',
        ]);

        // update resorce
        $category =  new Category();
        $category->name = $request->name;
        $category->color = $request->color;
        $category->abreviature = $request->abreviature;
        $category->save();
        
        return Redirect::route('categories.index');
        // return response()->json(['message' => 'stored_successfully', 'category' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */ 
    public function show(Category $category)
    {
        $category = Category::with('workouts.competition_type', 'athletes')
            ->find($category->id);
        $category->athletes = $category->athletes->mapWithKeys(function($athlete, $no) use ($category) {
            $athlete->no = $no + 1;
            $athlete->points = 0;

            foreach ($category->workouts as $competition) {
                $key = "workout_$competition->id";
                $result = CategoryWorkoutResult::where('workout_id', $competition->id)
                    ->where('athlete_id', $athlete->id)
                    ->where('category_id', $category->id)
                ->first(); 
                $value = '0';
                if($result){
                    if($competition['competition_type']['type'] == 'time'){
                        $value = $result->time;
                    }
                    if($competition['competition_type']['type'] == 'number'){
                        $value = $result->result;
                    }
                    if($competition['competition_type']['type'] == 'value'){
                        $value = $result->value;
                    }
                }
                
                $athlete[$key] = $value;             
                $athlete[$key . '_rank'] = 0;             
                $athlete[$key . '_points'] = 0;             
            }
            return [$athlete['id'] => $athlete];
        });

        foreach($category->workouts as $workout) {
            $workout_key = "workout_$workout->id";
            $rank = 1;
            $points = [100, 95, 90, 87, 84, 81, 78, 75, 72, 69, 66, 63, 60, 57, 54, 51, 48, 45, 42, 39, 36, 33, 30, 27, 24, 21, 18, 15, 12, 9, 6, 3, 0];
            if($workout->competition_type->sort == 'max'){
                $order_athletes = $category->athletes->sortByDesc('workout_' . $workout->id);                
            }else{
                $order_athletes = $category->athletes->sortBy('workout_' . $workout->id);
            }
            foreach ($order_athletes as $athlete) {
                $flag = $category->athletes[$athlete->id][$workout_key] > 0;
                if($flag){
                    $assign = count($points) == 0 ? 0 : $points[0];
                    array_shift($points);
                    $assign_rank = $rank;
                    $rank++;
                }else{
                    $assign = 0;
                    $assign_rank = '--';
                }
                $category->athletes[$athlete->id]['workout_' . $workout->id . '_points'] = $assign;
                $category->athletes[$athlete->id]['points'] += $assign;
                $category->athletes[$athlete->id]['workout_' . $workout->id . '_rank'] = $assign_rank;
            };
        }

        $athletes = $category->athletes->sortByDesc('points');
        $return = [];
        $rank = 1;
        foreach ($athletes as $key => $athlete) {
            if($athlete->points > 0){
                $athlete->rank = $rank;
                $rank++;
            }else{
                $athlete->rank = '--';
            }
            $return[] = $athlete;
        }
        
        $category->return = $return;

        return Inertia::render('Admin/Categories/LShow', [
            'resource' => $category,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return Inertia::render('Admin/Categories/LEdit', [
            'resource' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,'.$category->id,
            'abreviature' => 'required',
            'color' => 'required',
        ]);
        
        $category->name = $request->name;
        $category->color = $request->color;
        $category->abreviature = $request->abreviature;
        $category->save();
        
        return Inertia::render('Admin/Categories/LEdit', [
            'resource' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return Redirect::route('categories.index');
        // return response()->json(['message' => 'deleted_successfully']);
    }

    public function attachWorkout(Request $request, $category_id, $workout_id){
        $request->validate([
            'workout_id' => 'required',
            'id' => 'required',
        ]);

        $event = new CategoryWorkout();
        $event->category_id = $category_id;
        $event->workout_id = $workout_id;
        $event->save();

        return Redirect::route('categories.show', $category_id);
    }

    public function deattachWorkout($category_id, $workout_id){
        CategoryWorkout::where('category_id', $category_id)
            ->where('workout_id', $workout_id)
            ->delete();

        return Redirect::route('categories.show', $category_id);
    }

    public function storeResult(Request $request, $category_id){
        $request->validate([
            'athlete_id' => 'required',
            'competition_id' => 'required',
        ]);

        $competition = $request->competition_id;

        CategoryWorkoutResult::updateOrCreate(
            ['workout_id' => $competition['id'], 'athlete_id' => $request->athlete_id, 'category_id' => $category_id],
            ['result' => $request->result, 'time' => $request->time, 'value' => $request->value ?? null]
        );

        return Redirect::route('categories.show', $category_id);
    }
}
