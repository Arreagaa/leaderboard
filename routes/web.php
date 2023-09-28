<?php

use App\Http\Controllers\ApplyFormController;
use App\Http\Controllers\AthleteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function () {
    return Inertia::render('Landing/LShow');
})->name('landing');

Route::get('/about', function () {
    return Inertia::render('About/LShow');
})->name('about');

Route::get('/leaderboard', function () {
    return Inertia::render('Leaderboard/LShow');
})->name('leaderboard');

Route::get('/our-athletes', function () {
    return Inertia::render('Athletes/LShow');
})->name('our-athletes');

Route::get('/sponsors', function () {
    return Inertia::render('Sponsors/LShow');
})->name('sponsors');

Route::get('/map', function () {
    return Inertia::render('Map/LShow');
})->name('map');

Route::get('/calendar', function () {
    return Inertia::render('Calendar/LShow');
})->name('calendar');

Route::get('/woods', function () {
    return Inertia::render('Woods/LShow');
})->name('woods');


Route::get('/leaderboard', LeaderboardController::class . '@index')->name('leaderboard.index');
Route::get('/data-leaderboard/{id}', LeaderboardController::class . '@dataLeadeaboard')->name('leaderboard.data-leadeaboard');

Route::prefix('/register')->group(function () {
    Route::get('/sponsor', function () {
        return Inertia::render('Registers/LSponsor');
    })->name('register.sponsor');

    Route::get('/volunteer', function () {
        return Inertia::render('Registers/LVolunteer');
    })->name('register.volunteer');

    Route::get('/user', function () {
        return Inertia::render('Registers/LUser');
    })->name('register.user');

    Route::prefix('/clase')->group(function () {
        Route::get('/cycling', ApplyFormController::class . '@indexCycling')->name('register.clase.cycling');
        Route::get('/duatlon', ApplyFormController::class . '@indexDuatlon')->name('register.clase.duatlon');
        Route::get('/yoga', ApplyFormController::class . '@indexYoga')->name('register.clase.yoga');
        Route::get('/fittestduo', ApplyFormController::class . '@indexFittestDuo')->name('register.clase.fittestduo');
        Route::get('/schedules', ApplyFormController::class . '@schedules');
        Route::get('/mail', ApplyFormController::class . '@mail');
        Route::get('/duatlon/categories', ApplyFormController::class . '@duatlonCategories');
    }); 
});


Route::prefix('/apply')->group(function () {
    Route::post('/sponsor', ApplyFormController::class . '@storeSponsor')->name('apply.store-sponsor');
    Route::post('/volunteer', ApplyFormController::class . '@storeVoluteer')->name('apply.store-volunteer');
    Route::post('/user', ApplyFormController::class . '@storeUser')->name('apply.store-user');

    Route::prefix('/clase')->group(function () {
        Route::post('/cycling', ApplyFormController::class . '@storeCycling')->name('apply.store.cycling');
        Route::post('/duatlon', ApplyFormController::class . '@storeDuatlon')->name('apply.store.duatlon');
        Route::post('/yoga', ApplyFormController::class . '@storeYoga')->name('apply.store.yoga');
        Route::post('/fittestduo', ApplyFormController::class . '@storeFittestDuo')->name('apply.store.fittestduo');
    });
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified', 
])->group(function () {
    Route::get('/user/info/{id}', UserController::class . '@showInfo' )->name('user.info');
    Route::get('/user/info/clase/{id}', UserController::class . '@showInfoClase' )->name('user.clase.info');

    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('/diradmin')->group(function () {
        Route::resources([
            'athletes' => AthleteController::class,
            'events' => EventController::class,
            'workouts' => WorkoutController::class,
            'categories' => CategoryController::class,
            'competitions' => CompetitionController::class,
        ]);
        Route::prefix('/categories/{id}')->group(function () {
            Route::post('results', CategoryController::class . '@storeResult');
            Route::post('workouts/{workout_id}', CategoryController::class . '@attachWorkout');
            Route::delete('workouts/{workout_id}', CategoryController::class . '@deattachWorkout')->name('categories.workouts.detach');
        });

        Route::get('requests', RequestsController::class . '@index')->name('requests.index');
        Route::get('registers', RegisterController::class . '@index')->name('registers.index');
        Route::post('requests/approve', RequestsController::class . '@approve')->name('requests.approve');

    });
    Route::prefix('/only')->group(function () {
        Route::get('categories', CategoryController::class . '@only')->name('categories.only');
        Route::get('athletes', AthleteController::class . '@only')->name('athletes.only');
        Route::get('workouts', WorkoutController::class . '@only')->name('workouts.only');
        Route::get('competitions', CompetitionController::class . '@only')->name('competitions.only');
        Route::get('competitions/types', CompetitionController::class . '@onlyTypes')->name('competitions.only-types');
        
        Route::get('categories/{id}/workouts', CategoryController::class . '@onlyWorkouts');
        Route::get('categories/{id}/athletes', CategoryController::class . '@onlyAthletes');

        Route::get('events/{event_id}/competitions', EventController::class . '@onlyCompetitions');
        Route::get('events/{event_id}/athletes', EventController::class . '@onlyAthletes');
    });
});

// Route::prefix('/events/{id}')->group(function () {
//     Route::post('categories/{category_id}', EventController::class . '@attachCategory');
//     Route::post('competitions/{competition_id}', EventController::class . '@attachCompetition');
//     Route::post('athletes/{athlete_id}', EventController::class . '@attachAthlete');
//     Route::post('results', EventController::class . '@storeResult');

//     Route::delete('categories/{category_id}', EventController::class . '@deattachCategory')->name('events.categories.detach');
//     Route::delete('competitions/{competition_id}', EventController::class . '@deattachCompetition')->name('events.competitions.detach');
//     Route::delete('athletes/{athlete_id}', EventController::class . '@deattachAthlete')->name('events.athletes.detach');
// });
// });
// Route::prefix('/only')->group(function () {
// Route::get('categories', CategoryController::class . '@only')->name('categories.only');
// Route::get('athletes', AthleteController::class . '@only')->name('athletes.only');
// Route::get('competitions', CompetitionController::class . '@only')->name('competitions.only');
// Route::get('competitions/types', CompetitionController::class . '@onlyTypes')->name('competitions.only-types');

// Route::get('events/{event_id}/competitions', EventController::class . '@onlyCompetitions');
// Route::get('events/{event_id}/athletes', EventController::class . '@onlyAthletes');
// });