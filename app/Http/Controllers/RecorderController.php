<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRecorderRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Record;
use App\Models\Prop;

class RecorderController extends Controller
{
    public function index(Prop $prop)
    {
        return view('_lvz.recorder-index', ['prop' => $prop]);
    }

    public function store(StoreRecorderRequest $request)
    {
        $data = [
            'user_id' => $request->user()->id,
            'timestamp' => Carbon::now(),
            'freq' => $request->recorderFreq,
            'path' => Storage::disk('records')->putFile('recorder', $request->file('recorderFile')),
        ];
        if (Record::create($data)) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
