<?php

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

/* Route::get('/', function () {
    return inertia('Home', [
        'name' => 'Gonzalo',
        'frameworks' => ['Laravel', 'Vue', 'Inertia']
    ]);
}); */

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/users', function () {
//    sleep(3);
    return Inertia::render('Users', [
        // 'time' => now()->toTimeString()
        // 'users' => \App\Models\User::paginate(10)
        'users' => \App\Models\User::paginate(10)->through(fn($user) => [
            'name' => $user->name,
            'id' => $user->id
        ])
    ]);
});

Route::get('/settings', function () {
    return Inertia::render('Settings');
});

Route::post('/logout', function () {
    dd(request('foo'));
    // return Inertia::render('Settings');
});
