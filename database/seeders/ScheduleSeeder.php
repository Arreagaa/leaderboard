<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clase_schedules')->insert(
        [[
            'name' => 'Yoga',
            'type' => 'yoga',
            'capacity' => ' 50',
            'start_time' => '16:30:00',
            'end_time' => '17:30:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'date' => '2022-10-14',
            'iframe' => 'LIframeYoga1',
        ],
        [
            'name' => 'Yoga',
            'type' => 'yoga',
            'capacity' => ' 50',
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'date' => '2022-10-15',
            'iframe' => 'LIframeYoga2',
        ],
        [
            'name' => 'Yoga',
            'type' => 'yoga',
            'capacity' => ' 50',
            'start_time' => '16:30:00',
            'end_time' => '17:30:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'date' => '2022-10-15',
            'iframe' => 'LIframeYoga3',
        ],
        [
            'name' => 'Ciclismo',
            'type' => 'cycling',
            'capacity' => ' 50',
            'start_time' => '16:30:00',
            'end_time' => '17:30:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'date' => '2022-10-14',
            'iframe' => 'LIframeCycling1',
        ],
        [
            'name' => 'Ciclismo',
            'type' => 'cycling',
            'capacity' => ' 50',
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'date' => '2022-10-15',
            'iframe' => 'LIframeCycling2',
        ],
        [
            'name' => 'Ciclismo',
            'type' => 'cycling',
            'capacity' => ' 50',
            'start_time' => '16:30:00',
            'end_time' => '17:30:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'date' => '2022-10-15',
            'iframe' => 'LIframeCycling3',
        ],
        [
            'name' => 'Duatlón',
            'type' => 'duatlon',
            'capacity' => '300',
            'start_time' => '06:00:00',
            'end_time' => '10:00:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'date' => '2022-10-15',
            'iframe' => 'LIframeDuatlon',
        ],
        [
            'name' => 'Fittest Duo',
            'type' => 'fittestduo',
            'capacity' => '20',
            'start_time' => '06:00:00',
            'end_time' => '10:00:00',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'date' => '2022-10-15',
            'iframe' => 'LIframeFittestDuo',
        ]]);
    }
}
