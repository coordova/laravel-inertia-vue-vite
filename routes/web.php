<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
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

/* Route::get('/', function () {
    return inertia('Home', [
        'name' => 'Gonzalo',
        'frameworks' => ['Laravel', 'Vue', 'Inertia']
    ]);
}); */

Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
Route::post('logout', [LoginController::class, 'destroy'])->middleware('auth');

Route::middleware('auth')->group(function () {


    Route::get('/', function () {
        return Inertia::render('Home');
    });

    // El Index de users, muestra la lista de usuarios con su paginacion
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
                    'id' => $user->id,
                    // para definir reglas por cada registro hacerlo de esta manera, ej: can
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user)
                    ]
                ]),

            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class) // Auth::user()->email === 'gretta@email.com'
            ]
        ]);
    });

    // show create user form - con Authorization mediante middleware
    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    // })->middleware('can:create,App\Models\User'); // version antigua para definir authorization
    })->can('create', 'App\Models\User');   // Authorization con el metodo 'can' en versiones mas modernas de laravel

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

    // show edit user form
    Route::get('/users/{id}/edit', function (/*User $user*/ $id) {
        $user = User::findOrFail($id);
        // dd($user);
        return Inertia::render('Users/Edit', [
            'user' => $user->only('name', 'email', 'password'),
        ]);
    })->can('edit', 'App\Models\User');

    Route::patch('/users/{id}', function (User $user) {
        dd($user);
    });


    // Dummy settings page
    Route::get('/settings', function () {
        return Inertia::render('Settings');
    });

    /*Route::post('/logout', function () {
        dd(request('foo'));
        // return Inertia::render('Settings');
    });*/
});
