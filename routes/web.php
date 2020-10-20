<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TotoController;
use App\Models\Match;
use App\Models\Team;
use Illuminate\Support\Facades\Route;

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

Route::get('/s', function () {
    return Team::first();
});

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::get('/match/create', [MatchController::class, 'create'])
    ->name('new_match')
    ->middleware(['auth', 'can:create,'.Match::class]);

Route::post('/match', [MatchController::class, 'store'])
    ->name('store_match')
    ->middleware(['auth', 'can:create,'.Match::class]);

Route::get('team/create',
    [TeamController::class, 'create'])
    ->name('new_team')
    ->middleware(['auth', 'can:create,'.Team::class]);

Route::get('team/{team:slug}/edit',
    [TeamController::class, 'edit'])
    ->name('change_team')
    ->middleware(['auth', 'can:create,'.Team::class]);

Route::post('team', [TeamController::class, 'store'])
    ->name('store_team')
    ->middleware(['auth', 'can:create,'.Team::class]);

Route::patch('team/{team}', [TeamController::class, 'update'])
    ->name('update_team')
    ->middleware(['auth', 'can:create,'.Team::class]);
