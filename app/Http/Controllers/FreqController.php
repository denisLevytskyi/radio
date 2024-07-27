<?php

namespace App\Http\Controllers;

use App\Models\Freq;
use App\Http\Requests\StoreFreqRequest;
use App\Http\Requests\UpdateFreqRequest;
use Illuminate\Http\Request;

class FreqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $freqs = Freq::paginate(10);
        return view('_lvz/freq-index', ['freqs' => $freqs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('_lvz/freq-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFreqRequest $request)
    {
        if ($request->user()->cannot('create', Freq::class)) {
            return back()->withErrors([
                'status' => 'Вы не можете выполнить данное действие'
            ])->withInput();
        }
        $data = [
            'user_id' => $request->user()->id,
            'name' => $request->freqCreateName,
            'freq' => $request->freqCreateFreq,
        ];
        if (Freq::create($data)) {
            return to_route('app.freq.index')->with(['status' => 'Запись успешно добавлена']);
        } else {
            return back()->withErrors([
                'status' => 'Ошибка внесения данных в БД'
            ])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Freq $freq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Freq $freq)
    {
        return view('_lvz/freq-edit', ['freq' => $freq]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFreqRequest $request, Freq $freq)
    {
        if ($request->user()->cannot('update', $freq)) {
            return back()->withErrors([
                'status' => 'Вы не можете выполнить данное действие'
            ])->withInput();
        }
        $data = [
            'name' => $request->freqEditName,
        ];
        if ($freq->update($data)) {
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
    public function destroy(Request $request, Freq $freq)
    {
        if ($request->user()->cannot('delete', $freq)) {
            return back()->withErrors([
                'status' => 'Вы не можете выполнить данное действие'
            ]);
        }
        if ($freq->delete()) {
            return to_route('app.freq.index')->with(['status' => 'Запись успешно удалена']);
        } else {
            return back()->withErrors([
                'status' => 'Ошибка внесения данных в БД'
            ]);
        }
    }
}
