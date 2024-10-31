<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManualExportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManualExportController extends ExportController
{
    public function index () {
        return view('_lvz.manual-export-index', ['prop' => $this->prop]);
    }

    public StoreManualExportRequest $request;

    public function local_disk () {
        return Storage::build([
            'driver' => 'local',
            'root' => storage_path('app/temp/' . $this->request->manualExportPath),
            'throw' => false,
        ]);
    }

    public function set_out_disk () {
        $this->disk = Storage::build([
            'driver' => 'ftp',
            'host' => $this->request->manualExportHost,
            'username' => $this->request->manualExportUsername,
            'password' => $this->request->manualExportPassword,
            'root' => $this->request->manualExportRoot,
            'port' => (int) $this->request->manualExportPort,
            'passive' => (bool) (int) $this->request->manualExportPassive,
            'timeout' => (int) $this->request->manualExportTimeout,
        ]);
    }

    public function store (StoreManualExportRequest $request) {
        $this->request = $request;
        return $this->export()->withInput();
    }
}
