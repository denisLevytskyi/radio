<?php

namespace App\Http\Controllers;

use App\Models\Prop;
use App\Http\Requests\StorePropRequest;
use App\Http\Requests\UpdatePropRequest;

class PropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Prop $prop)
    {
        return view('_lvz/prop-index', ['prop' => $prop]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropRequest $request)
    {
        $data = [
            ['key' => 'ftp_host', 'value' => $request->propFtpHost],
            ['key' => 'ftp_username', 'value' => $request->propFtpUsername],
            ['key' => 'ftp_password', 'value' => $request->propFtpPassword],
        ];
        if (Prop::upsert($data, 'key', ['key', 'value'])) {
            return back()->with(['status' => 'Обновлено']);
        } else {
            return back()->withErrors(['status' => 'Ошибка внесения данных в БД']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prop $prop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prop $prop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropRequest $request, Prop $prop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prop $prop)
    {
        //
    }
}
