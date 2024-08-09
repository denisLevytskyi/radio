<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManualConnectRequest;
use App\Models\Prop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class ManualConnectController extends ImportController
{
    public function index (Prop $prop) {
        return view('_lvz.manual-connect-index', ['prop' => $prop]);
    }

    public StoreManualConnectRequest $request;

    public function parse ($filename) {
        if ($this->request->manualConnectFreq) {
            return [
                'user_id' => Auth::user()->id,
                'timestamp' => Carbon::now()->toDateTimeString(),
                'freq' => (float) $this->request->manualConnectFreq,
                'path' => $filename,
            ];
        } else {
            return parent::parse($filename);
        }
    }

    public function ftp_disk (Prop $prop) {
        return Storage::build([
            'driver' => 'ftp',
            'host' => $this->request->manualConnectHost,
            'username' => $this->request->manualConnectUsername,
            'password' => $this->request->manualConnectPassword,
            'root' => $this->request->manualConnectRoot,
            'port' => (int) $this->request->manualConnectPort,
        ]);
    }

    public function store (StoreManualConnectRequest $request, Prop $prop) {
        $this->request = $request;
        return $this->import($prop);
    }
}
