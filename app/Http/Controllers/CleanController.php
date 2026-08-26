<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CleanController extends Controller
{
    public function clean () {
        $start = Carbon::now()->getTimestamp();
        $records = Record::onlyTrashed()->get();
        foreach ($records as $record) {
            if ($start + 15 <= Carbon::now()->getTimestamp()) {
                return back()->withErrors(['status' => 'Исчерпан лимит времени']);
            }
            if (!empty($record->file) and Storage::disk('records')->exists($record->file)) {
                Storage::disk('records')->delete($record->file);
            }
            $record->forceDelete();
        }
        return back()->with(['status' => 'БД очищена']);
    }
}
