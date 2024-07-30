<?php

namespace App\Http\Controllers;

use App\Models\Freq;
use App\Models\Record;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRecordRequest;

class RecordController extends Controller
{
    public function search(SearchRecordRequest $request, $paginator_freq = NULL)
    {
        if ($search_freq = $request->recordSearchFreq) {
            $freq = $search_freq;
        } elseif ((int) $paginator_freq) {
            $freq = $paginator_freq;
        } else {
            return to_route('app.record.index')->withErrors(['status' => 'Ошибка поиска']);
        }
        $freqs = Freq::orderBy('freq')->get();
        $records = Record::where('freq', '=', $freq)->orderBy('id', 'desc')->paginate(10)->withPath(route('app.record.search' , ['freq' => $freq]));
        return view('_lvz/record-index', ['records' => $records, 'freqs' => $freqs]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $freqs = Freq::orderBy('freq')->get();
        $records = Record::orderBy('id', 'desc')->paginate(10);
        return view('_lvz/record-index', ['records' => $records, 'freqs' => $freqs]);
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
    public function store(StoreRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Record $record)
    {
        if ($request->user()->cannot('view', $record)) {
            return back()->withErrors([
                'status' => 'Вы не можете выполнить данное действие'
            ]);
        }
        return view('_lvz/record-show', ['record' => $record]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecordRequest $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Record $record)
    {
        if ($request->user()->cannot('delete', $record)) {
            return back()->withErrors([
                'status' => 'Вы не можете выполнить данное действие'
            ]);
        }
        if ($record->delete()) {
            return to_route('app.record.index')->with(['status' => 'Запись успешно удалена']);
        } else {
            return back()->withErrors([
                'status' => 'Ошибка внесения данных в БД'
            ]);
        }
    }
}
