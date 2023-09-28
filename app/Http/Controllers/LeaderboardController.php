<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryWorkoutResult;
use App\Models\Event;
use App\Models\EventCompetitionResult;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LeaderboardController extends Controller
{
    public function index(){

        return Inertia::render('Leaderboard/LShow', [
            'categories' => Category::get(['id', 'name']),
        ]);
    }

    public function dataLeadeaboard($id){
        $category = Category::with('workouts.competition_type', 'athletes')
        ->find($id);

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

        return response()->json([ 'category' => $category ], 200);
    }
}
