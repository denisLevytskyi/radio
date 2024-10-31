<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManualImportRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class ManualImportController extends ImportController
{
    public function index () {
        return view('_lvz.manual-import-index', ['prop' => $this->prop]);
    }

    public StoreManualImportRequest $request;

    public function parse (string $filename) {
        if ($this->request->manualImportFreq) {
            return [
                'user_id' => Auth::user()->id,
                'timestamp' => Carbon::now()->toDateTimeString(),
                'freq' => (float) $this->request->manualImportFreq,
                'path' => $filename,
            ];
        } else {
            return parent::parse($filename);
        }
    }

    public function checkFileName (string $filename) {
        if ($this->request->manualImportFreq) {
            return TRUE;
        } else {
            return parent::checkFileName($filename);
        }
    }

    public function set_ftp_disk () {
        $this->disk = Storage::build([
            'driver' => 'ftp',
            'host' => $this->request->manualImportHost,
            'username' => $this->request->manualImportUsername,
            'password' => $this->request->manualImportPassword,
            'root' => $this->request->manualImportRoot,
            'port' => (int) $this->request->manualImportPort,
            'passive' => (bool) (int) $this->request->manualImportPassive,
            'timeout' => (int) $this->request->manualImportTimeout,
        ]);
    }

    public function set_self_disk () {
        $this->disk = Storage::build([
            'driver' => 'local',
            'root' => storage_path('app/self/' . $this->request->manualImportPath),
            'throw' => false,
        ]);
    }

    public function store (StoreManualImportRequest $request) {
        $this->request = $request;
        return $this->import()->withInput();
    }
}
