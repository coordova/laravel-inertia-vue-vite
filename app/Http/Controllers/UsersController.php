<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        // return UserResource::collection( User::all() );
        return Inertia::render('Users/Index', [
            'users' => \App\Models\User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                ->paginate(10)
                ->withQueryString()
                ->through(fn($user) => [
                    'name' => $user->name,
                    'email' => $user->email,
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
    }


    public function _index()
    {
        // return UserResource::collection( User::all() );

        return Inertia::render('Users/Index', [
            'users' => UserResource::collection( User::query()
                ->paginate(50)
                ->withQueryString() ),
                /*->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'can' => [
                        'edit' => Auth::user()->can('edit', $user)
                    ]
                ]),*/

            'filters' => Request::only(['search']),
            'can' => [
                'createUser' => Auth::user()->can('create', User::class) // Auth::user()->email === 'gretta@email.com'
            ]
        ]);
    }

    public function show(User $user)
    {
        return Inertia::render('Users/Show', [
            // 'user' => $user->only(['id', 'name', 'email', 'created_at'])     // Serializacion Opcion 1
            // 'user' => $user->only(['id', 'name', 'email', 'created_at'])
            'user' => UserResource::make($user)
        ]);
    }

    public function create()
    {
        return Inertia::render('Users/Create');
    }

    public function store()
    {
        $attributes = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        User::create($attributes);

        return redirect('/users');
    }

    public function edit(User $user)
    {
        return Inertia::render('Users/Edit', [
            'user' => $user->only('id', 'name', 'email'/*, 'password'*/),
            // 'user' => $user
        ]);
    }

    public function update(User $user)
    {
        // validate the request
        $attributes = Request::validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            // 'password' => 'required',
        ]);
        // update user
        $user->update(Request::only('name', 'email'));

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        return redirect('/users');
    }

    public function delete(User $user)
    {
        $user->delete();
    }
}
