<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreManualConnectRequest;
use App\Models\Prop;
use Illuminate\Http\Request;

class ManualConnectController extends Controller
{
    public function index (Prop $prop) {
        return view('_lvz.manual-connect-index', ['prop' => $prop]);
    }

    public function import (StoreManualConnectRequest $request, ImportController $controller, Prop $prop) {
        config([
            'filesystems.disks.ftp' => [
                'driver' => 'ftp',
                'host' => $request->manualConnectHost,
                'username' => $request->manualConnectUsername,
                'password' => $request->manualConnectPassword,
                'root' => $request->manualConnectRoot,
                'port' => (int) $request->manualConnectPort,
            ]
        ]);
        return $controller->import($request, $prop);
    }
}
