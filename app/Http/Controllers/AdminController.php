<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserRole;
use Hash;
use Carbon\Carbon;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\StoreAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate((int) $this->prop->getProp('app_paginator'));
        return view('_lvz.admin-index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('_lvz.admin-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdminRequest $request)
    {
        $data = [
            'name' => $request->adminCreateName,
            'email' => $request->adminCreateEmail,
            'password' => Hash::make($request->adminCreatePassword),
            'email_verified_at' => Carbon::now()->timestamp
        ];
        if ($user = User::create($data)) {
            if ($request->boolean('adminCreateAdmin')) {
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => 4
                ]);
            }
            if ($request->boolean('adminCreateRecorder')) {
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => 3
                ]);
            }
            if ($request->boolean('adminCreateUser')) {
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => 2
                ]);
            }
            if ($request->boolean('adminCreateGuest')) {
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => 1
                ]);
            }
            return to_route('app.admin.index')->with(['status' => 'Запись успешно добавлена']);
        } else {
            return back()->withErrors([
                'status' => 'Ошибка внесения данных в БД'
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $admin)
    {
        return view('_lvz.admin-edit', ['user' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdminRequest $request, User $admin)
    {
        $data = [
            'name' => $request->adminEditName,
            'email' => $request->adminEditEmail
        ];
        if ($request->adminEditPassword) {
            $data['password'] = Hash::make($request->adminEditPassword);
        }
        if ($admin->update($data)) {
            UserRole::where('user_id', $admin->id)->delete();
            if ($request->boolean('adminEditAdmin')) {
                UserRole::create([
                    'user_id' => $admin->id,
                    'role_id' => 4
                ]);
            }
            if ($request->boolean('adminEditRecorder')) {
                UserRole::create([
                    'user_id' => $admin->id,
                    'role_id' => 3
                ]);
            }
            if ($request->boolean('adminEditUser')) {
                UserRole::create([
                    'user_id' => $admin->id,
                    'role_id' => 2
                ]);
            }
            if ($request->boolean('adminEditGuest')) {
                UserRole::create([
                    'user_id' => $admin->id,
                    'role_id' => 1
                ]);
            }
            return back()->with(['status' => 'Обновлено']);
        } else {
            return back()->withErrors([
                'status' => 'Ошибка внесения данных в БД'
            ])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $admin)
    {
        if ($request->user()->cannot('delete', $admin)) {
            return back()->withErrors([
                'status' => 'Вы не можете выполнить данное действие'
            ]);
        }
        if ($admin->delete()) {
            return to_route('app.admin.index')->with(['status' => 'Запись успешно удалена']);
        } else {
            return back()->withErrors([
                'status' => 'Ошибка внесения данных в БД'
            ]);
        }
    }
}
