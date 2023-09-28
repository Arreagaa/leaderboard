<?php

namespace App\Http\Controllers;

use App\Mail\RegisterUser;
use App\Models\ApplyUser;
use App\Models\ClaseScheduleTeam;
use App\Models\ClaseScheduleUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RequestsController extends Controller
{
    public function index(){

        $individuals = ClaseScheduleUser::with('claseSchedule', 'applyUser')
            ->whereHas(
                'applyUser', function($query){
                    $query->whereNull('approved')->where('type', 'individual');
            })
            ->get()
            ->map(function($item){
                $item->applyUser->voucher = config('app.url') . '/storage/' . $item->applyUser->voucher;
                return $item;
            });
        $teams = ClaseScheduleTeam::with('claseSchedule', 'claseTeam.users')
            ->whereHas(
                'claseTeam', function($query){
                    $query->whereNull('approved');
            })
            ->get()
            ->map(function($item){
                $item->claseTeam->voucher = config('app.url') . '/storage/' . $item->claseTeam->voucher;
                return $item;
            });

        return Inertia::render('Admin/Requests/LIndex', [
            'individual' => $individuals,
            'teams' => $teams
        ]);
    }

    public function approve(){
        $approved = request()->boolean('approved');
         
        if(request()->type == 'individual'){
            $individual = ClaseScheduleUser::with('applyUser', 'claseSchedule')->find(request()->id);
            $user = ApplyUser::find($individual->apply_user_id);
            $user->approved = $approved;
            $user->save();
            $user->type = $individual->claseSchedule->name;

            if($approved){
                Mail::to([$user->email])->send(new RegisterUser($user));
            }
        }

        if(request()->type == 'team'){
            $team = ClaseScheduleTeam::with('claseTeam.users', 'claseSchedule')->find(request()->id);
            $team->claseTeam->approved = $approved;
            $team->claseTeam->save();

            foreach ($team->claseTeam->users as $user){
                $user->approved = $approved;
                $user->save();
                $user->type = $team->claseSchedule->name;
                if($approved){
                    Mail::to([$user->email])->send(new RegisterUser($user));
                }
            }

            return Redirect::route('requests.index');
        }

        return Redirect::route('requests.index');
    }
}
