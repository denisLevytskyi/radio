<?php

namespace App\Http\Controllers;

use App\Models\Prop;
use App\Http\Requests\StorePropRequest;
use App\Http\Requests\UpdatePropRequest;

class PropController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('_lvz.prop-index', ['prop' => $this->prop]);
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
    public function store(StorePropRequest $request)
    {
        $data = [
            ['key' => 'self_path', 'value' => $request->propSelfPath],
            ['key' => 'ftp_host', 'value' => $request->propFtpHost],
            ['key' => 'ftp_username', 'value' => $request->propFtpUsername],
            ['key' => 'ftp_password', 'value' => $request->propFtpPassword],
            ['key' => 'ftp_root', 'value' => $request->propFtpRoot],
            ['key' => 'ftp_port', 'value' => $request->propFtpPort],
            ['key' => 'ftp_passive', 'value' => $request->propFtpPassive],
            ['key' => 'ftp_timeout', 'value' => $request->propFtpTimeout],
            ['key' => 'temp_path', 'value' => $request->propTempPath],
            ['key' => 'out_host', 'value' => $request->propOutHost],
            ['key' => 'out_username', 'value' => $request->propOutUsername],
            ['key' => 'out_password', 'value' => $request->propOutPassword],
            ['key' => 'out_root', 'value' => $request->propOutRoot],
            ['key' => 'out_port', 'value' => $request->propOutPort],
            ['key' => 'out_passive', 'value' => $request->propOutPassive],
            ['key' => 'out_timeout', 'value' => $request->propOutTimeout],
            ['key' => 'import_disk', 'value' => $request->propImportDisk],
            ['key' => 'import_limit', 'value' => $request->propImportLimit],
            ['key' => 'import_sleep', 'value' => $request->propImportSleep],
            ['key' => 'import_redirect', 'value' => $request->propImportRedirect],
            ['key' => 'import_separate', 'value' => $request->propImportSeparate],
            ['key' => 'importer_delay', 'value' => $request->propImporterDelay],
            ['key' => 'recorder_freq', 'value' => $request->propRecorderFreq],
            ['key' => 'recorder_threshold', 'value' => $request->propRecorderThreshold],
            ['key' => 'recorder_delay_pause', 'value' => $request->propRecorderDelayPause],
            ['key' => 'recorder_delay_stop', 'value' => $request->propRecorderDelayStop],
            ['key' => 'recorder_min_duration', 'value' => $request->propRecorderMinDuration],
            ['key' => 'recorder_max_duration', 'value' => $request->propRecorderMaxDuration],
            ['key' => 'recorder_play', 'value' => $request->propRecorderPlay],
            ['key' => 'recorder_file', 'value' => $request->propRecorderFile],
            ['key' => 'export_limit', 'value' => $request->propExportLimit],
            ['key' => 'export_sleep', 'value' => $request->propExportSleep],
            ['key' => 'export_separate', 'value' => $request->propExportSeparate],
            ['key' => 'exporter_delay', 'value' => $request->propExporterDelay],
            ['key' => 'app_mode', 'value' => $request->propAppMode],
            ['key' => 'app_register', 'value' => $request->propAppRegister],
            ['key' => 'app_paginator', 'value' => $request->propAppPaginator],
            ['key' => 'app_import_status', 'value' => 0],
            ['key' => 'app_export_status', 'value' => 0],
        ];
        if ($this->prop->upsert($data, ['key'], ['value'])) {
            return back()->with(['status' => 'Обновлено']);
        } else {
            return back()->withErrors(['status' => 'Ошибка внесения данных в БД']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Prop $prop)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prop $prop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropRequest $request, Prop $prop)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prop $prop)
    {
        //
    }
}
