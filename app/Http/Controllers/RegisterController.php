<?php

namespace App\Http\Controllers;

use App\Models\ApplyUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function index()
    {
        $resources = ApplyUser::with('teams')
            ->where('approved', 1)
            ->when(request()->type != 'fittestduo', function ($query) {
                $query->where('type', 'individual')
                    ->whereHas('schedules', function ($q) {
                        $q->where('type', request()->type);
                    });
            })
            ->when(request()->type == 'fittestduo', function ($query) {
                $query->whereHas('teams', function($qq){
                    $qq->whereHas('claseScheduleTeam', function($qq){
                        $qq->whereHas('claseSchedule', function($qqq){
                            $qqq->where('type', request()->type);
                        });
                    })
                    ->where('approved', 1);
                });
            })
            ->get()
            ->map(function ($item) {
                if(request()->type == 'fittestduo'){
                    $item->team_name = $item->teams->first()->name;

                }
                return $item;
            });

        
        return Inertia::render('Admin/Registers/LIndex', [
            'resources' => $resources,
            'type' => request()->type,
        ]);
    }
}
