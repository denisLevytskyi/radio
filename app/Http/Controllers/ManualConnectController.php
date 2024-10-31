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

    public function set_ftp_disk () {
        $this->disk = Storage::build([
            'driver' => 'ftp',
            'host' => $this->request->manualConnectFtpHost,
            'username' => $this->request->manualConnectFtpUsername,
            'password' => $this->request->manualConnectFtpPassword,
            'root' => $this->request->manualConnectFtpRoot,
            'port' => (int) $this->request->manualConnectFtpPort,
            'passive' => (bool) (int) $this->request->manualConnectFtpPassive,
            'timeout' => (int) $this->request->manualConnectFtpTimeout,
        ]);
    }

    public function set_self_disk () {
        $this->disk = Storage::build([
            'driver' => 'local',
            'root' => storage_path('app/self/' . $this->request->manualConnectSelfPath),
            'throw' => false,
        ]);
    }

    public function store (StoreManualConnectRequest $request) {
        $this->request = $request;
        return $this->import()->withInput();
    }
}
