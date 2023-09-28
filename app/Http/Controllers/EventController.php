<?php

namespace App\Http\Controllers;

use App\Models\Athlete;
use App\Models\AthleteEvent;
use App\Models\Category;
use App\Models\CategoryEvent;
use App\Models\Competition;
use App\Models\CompetitionEvent;
use App\Models\Event;
use App\Models\EventCompetitionResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function only()
    {
        $resources = Event::get(['id', 'name']);
        return $resources;
    }

    public function onlyCompetitions($event_id){
        $resources = CompetitionEvent::where('event_id', $event_id)->get()->pluck('competition_id');
        $resources = Competition::whereIn('id', $resources)->get();

        return $resources;
    }

    public function onlyAthletes($event_id){
        $resources = AthleteEvent::where('event_id', $event_id)->get()->pluck('athlete_id');
        $resources = Athlete::whereIn('id', $resources)->get();
        return $resources;
    }

    public function index()
    {
        $events = Event::paginate(10);
        
        return Inertia::render('Admin/Events/LIndex', [
            'resources' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Admin/Events/LCreate');
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
            'name' => 'required|max:255|unique:events',
            'description' => 'required',
        ]);

        // update resorce
        $category =  new Event();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        
        return Redirect::route('events.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $event = Event::with('categories', 'competitions', 'athletes')
            ->find($event->id);

        $event->athletes = $event->athletes->map(function($athlete, $no) use ($event) {
            foreach ($event->competitions as $competition) {
                $key = "competition_$competition->id";
                $result = EventCompetitionResult::where('competition_id', $competition->id)
                    ->where('athlete_id', $athlete->id)
                    ->where('event_id', $event->id)
                ->first();
                $value = 0;
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
            }
            $athlete->no = $no + 1;
            $athlete->points = 0;
            return $athlete;
        });
        
        foreach ($event->competitions as $competition) {
            $key = "competition_$competition->id";
            $points = [100, 95, 90, 87, 84, 81, 78, 75, 72, 69, 66, 63, 60, 57, 54, 51, 48, 45, 42, 39, 36, 33, 30, 27, 24, 21, 18, 15, 12, 9, 6, 3, 0];
            foreach($event->athletes as $athlete) {
                $assign = count($points) == 0 ? 80 : $points[0];
                $athlete->points = $athlete->points + $assign;
                array_shift($points);
            };
        }

        $athletes = $event->athletes->sortByDesc('points');
        $athletes = $event->athletes->values()->all();

        foreach ($athletes as $key => $athlete) {
            $athletes[$key]->no = $key + 1;
        }

        return Inertia::render('Admin/Events/LShow', [
            'resource' => $event,
            'athletes' => $athletes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return Inertia::render('Admin/Events/LEdit', [
            'resource' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|max:255|unique:events,name,'.$event->id,
            'description' => 'required',
        ]);
        
        $event->name = $request->name;
        $event->description = $request->description;
        $event->save();
        
        return Inertia::render('Admin/Events/LEdit', [
            'resource' => $event
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return Redirect::route('events.index');
    }

    public function storeResult(Request $request, $event_id){
        $request->validate([
            'athlete_id' => 'required',
            'competition_id' => 'required',
        ]);

        $competition = $request->competition_id;

        $result = EventCompetitionResult::updateOrCreate(
            ['competition_id' => $competition['id'], 'athlete_id' => $request->athlete_id, 'event_id' => $event_id],
            ['result' => $request->result, 'time' => $request->time, 'value' => $request->value ?? null]
        );

        return Redirect::route('events.show', $event_id);
    }

    public function attachCategory(Request $request, $event_id, $category_id){
        $request->validate([
            'event_id' => 'required',
            'id' => 'required',
        ]);

        $event = new CategoryEvent();
        $event->category_id = $category_id;
        $event->event_id = $event_id;
        $event->save();

        return Redirect::route('events.show', $event_id);

    }

    public function attachCompetition(Request $request, $event_id, $competition_id){
        $request->validate([
            'event_id' => 'required',
            'id' => 'required',
        ]);

        $event = new CompetitionEvent();
        $event->competition_id = $competition_id;
        $event->event_id = $event_id;
        $event->save();

        return Redirect::route('events.show', $event_id);
    }

    public function attachAthlete(Request $request, $event_id, $athlete_id){
        $request->validate([
            'event_id' =>'required',
            'id' =>'required',
            ]);
    
        $event = new AthleteEvent();
        $event->athlete_id = $athlete_id;
        $event->event_id = $event_id;
        $event->save();

        return Redirect::route('events.show', $event_id);         

    }

    public function deattachCategory($event_id, $category_id){
        CategoryEvent::where('category_id', $category_id)
            ->where('event_id', $event_id)
            ->delete();

        return Redirect::route('events.show', $event_id);
    }

    public function deattachCompetition($event_id, $competition_id){
        CompetitionEvent::where('competition_id', $competition_id)
            ->where('event_id', $event_id)
            ->delete();

        return Redirect::route('events.show', $event_id);
    }

    public function deattachAthlete($event_id, $athlete_id){
        AthleteEvent::where('athlete_id', $athlete_id)
            ->where('event_id', $event_id)
            ->delete();

        return Redirect::route('events.show', $event_id);
    }
}
