<?php

use App\Models\User;
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
    return Inertia::render('Users/Index', [
        // 'time' => now()->toTimeString()
        // 'users' => \App\Models\User::paginate(10)
        'users' => \App\Models\User::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
                'name' => $user->name,
                'id' => $user->id
            ]),

        'filters' => Request::only(['search'])
    ]);
});
// show create user form
Route::get('/users/create', function () {
    return Inertia::render('Users/Create');
});
// post the create user form
Route::post('/users', function () {
    // validate the request
    $attributes = Request::validate([
        'name' => 'required',
        'email' => ['required', 'email'],
        'password' => 'required',
    ]);
    // create the user
    User::create($attributes);
    // redirect
    return redirect('/users');
});

Route::get('/settings', function () {
    return Inertia::render('Settings');
});

Route::post('/logout', function () {
    dd(request('foo'));
    // return Inertia::render('Settings');
});
