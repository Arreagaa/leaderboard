<?php

namespace App\Http\Controllers;

use App\Models\ApplyNotification;
use App\Models\ApplyUser;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;

class UserController extends Controller
{
    public function showInfo($id){
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return abort(404);
        }
        $user = ApplyUser::find($id);
        $user->count_qr = $user->count_qr + 1;
        $user->save();

        return Inertia::render('Admin/User/ShowInfo', [
            'user' => $user
        ]);
    }

    public function showInfoClase($id){
        try {
            $id = Crypt::decryptString($id);
        } catch (DecryptException $e) {
            return abort(404);
        }
        $user = ApplyUser::with('schedules', 'teams.claseScheduleTeam.claseSchedule')->find($id);
        $user->count_qr = $user->count_qr + 1;
        $user->save();
        
        $user->clase_name = "";
        $user->clase_date = "";
        $user->clase_schedule = "";
        $user->clase_team_name = "No aplica";

        if($user->type == 'team'){
            $team = $user->teams->first();
            if($team){
                $schedule = $team->claseScheduleTeam->first()->claseSchedule;
                if($schedule){
                    $user->clase_team_name = $team->name;
                    $user->clase_name = $schedule->name;
                    $user->clase_date = $schedule->date;
                    $user->clase_schedule = "$schedule->start_time $schedule->end_time";
                }
            }
        }else{
            $schedule = $user->schedules->first();
            if($schedule){
                $user->clase_name = $schedule->name;
                $user->clase_date = $schedule->date;
                $user->clase_schedule = "$schedule->start_time $schedule->end_time";
            }
        }

        return Inertia::render('Admin/User/ShowInfoClase', [
            'user' => $user
        ]);
    }
}
