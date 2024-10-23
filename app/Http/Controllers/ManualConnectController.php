<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManualConnectRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class ManualConnectController extends ImportController
{
    public function index () {
        return view('_lvz.manual-connect-index', ['prop' => $this->prop]);
    }

    public StoreManualConnectRequest $request;

    public function parse (string $filename) {
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

    public function checkFileName (string $filename) {
        if ($this->request->manualConnectFreq) {
            return TRUE;
        } else {
            return parent::checkFileName($filename);
        }
    }

    public function ftp_disk () {
        if ((int) $this->prop->getProp('import_separate') or !$this->isDiskSet) {
            $this->isDiskSet = TRUE;
            $this->disk = Storage::build([
                'driver' => 'ftp',
                'host' => $this->request->manualConnectHost,
                'username' => $this->request->manualConnectUsername,
                'password' => $this->request->manualConnectPassword,
                'root' => $this->request->manualConnectRoot,
                'port' => (int) $this->request->manualConnectPort,
                'passive' => (bool) (int) $this->request->manualConnectPassive,
                'timeout' => (int) $this->request->manualConnectTimeout,
            ]);
        }
        return $this->disk;
    }

    public function store (StoreManualConnectRequest $request) {
        $this->request = $request;
        return $this->import()->withInput();
    }
}
