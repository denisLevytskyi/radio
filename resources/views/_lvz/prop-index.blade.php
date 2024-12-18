<x-l-layout::form :action="route('app.prop.store')" >
    <x-slot:title>
        Параметры
    </x-slot:title>
    <x-slot:header_info>
        Параметры
    </x-slot:header_info>
    <p class="formFormP">
        <strong>
            SELF [DISK]
        </strong>
    </p>
    <p class="formFormP">
        Path
    </p>
    <x-l::form-input-error :messages="$errors->get('propSelfPath')"/>
    <x-l::form-input name="propSelfPath" type="text" :value="old('propSelfPath', $prop->getProp('self_path'))"/>
    <p class="formFormP">
        <strong>
            FTP [DISK]
        </strong>
    </p>
    <p class="formFormP">
        Host
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpHost')"/>
    <x-l::form-input name="propFtpHost" type="text" :value="old('propFtpHost', $prop->getProp('ftp_host'))"/>
    <p class="formFormP">
        Username
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpUsername')"/>
    <x-l::form-input name="propFtpUsername" type="text" :value="old('propFtpUsername', $prop->getProp('ftp_username'))"/>
    <p class="formFormP">
        Password
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpPassword')"/>
    <x-l::form-input name="propFtpPassword" type="text" :value="old('propFtpPassword', $prop->getProp('ftp_password'))"/>
    <p class="formFormP">
        Root
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpRoot')"/>
    <x-l::form-input name="propFtpRoot" type="text" :value="old('propFtpRoot', $prop->getProp('ftp_root'))"/>
    <p class="formFormP">
        Port
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpPort')"/>
    <x-l::form-input name="propFtpPort" type="number" :value="old('propFtpPort', $prop->getProp('ftp_port'))"/>
    <p class="formFormP">
        Passive
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpPassive')"/>
    <x-l::form-input name="propFtpPassive" type="number" :value="old('propFtpPassive', $prop->getProp('ftp_passive'))"/>
    <p class="formFormP">
        Timeout
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpTimeout')"/>
    <x-l::form-input name="propFtpTimeout" type="number" :value="old('propFtpTimeout', $prop->getProp('ftp_timeout'))"/>
    <p class="formFormP">
        <strong>
            TEMP [DISK]
        </strong>
    </p>
    <p class="formFormP">
        Path
    </p>
    <x-l::form-input-error :messages="$errors->get('propTempPath')"/>
    <x-l::form-input name="propTempPath" type="text" :value="old('propTempPath', $prop->getProp('temp_path'))"/>
    <p class="formFormP">
        <strong>
            OUT [DISK]
        </strong>
    </p>
    <p class="formFormP">
        Host
    </p>
    <x-l::form-input-error :messages="$errors->get('propOutHost')"/>
    <x-l::form-input name="propOutHost" type="text" :value="old('propOutHost', $prop->getProp('out_host'))"/>
    <p class="formFormP">
        Username
    </p>
    <x-l::form-input-error :messages="$errors->get('propOutUsername')"/>
    <x-l::form-input name="propOutUsername" type="text" :value="old('propOutUsername', $prop->getProp('out_username'))"/>
    <p class="formFormP">
        Password
    </p>
    <x-l::form-input-error :messages="$errors->get('propOutPassword')"/>
    <x-l::form-input name="propOutPassword" type="text" :value="old('propOutPassword', $prop->getProp('out_password'))"/>
    <p class="formFormP">
        Root
    </p>
    <x-l::form-input-error :messages="$errors->get('propOutRoot')"/>
    <x-l::form-input name="propOutRoot" type="text" :value="old('propOutRoot', $prop->getProp('out_root'))"/>
    <p class="formFormP">
        Port
    </p>
    <x-l::form-input-error :messages="$errors->get('propOutPort')"/>
    <x-l::form-input name="propOutPort" type="number" :value="old('propOutPort', $prop->getProp('out_port'))"/>
    <p class="formFormP">
        Passive
    </p>
    <x-l::form-input-error :messages="$errors->get('propOutPassive')"/>
    <x-l::form-input name="propOutPassive" type="number" :value="old('propOutPassive', $prop->getProp('out_passive'))"/>
    <p class="formFormP">
        Timeout
    </p>
    <x-l::form-input-error :messages="$errors->get('propOutTimeout')"/>
    <x-l::form-input name="propOutTimeout" type="number" :value="old('propOutTimeout', $prop->getProp('out_timeout'))"/>
    <p class="formFormP">
        <strong>
            IMPORT
        </strong>
    </p>
    <p class="formFormP">
        Disk
    </p>
    <x-l::form-input-error :messages="$errors->get('propImportDisk')"/>
    <x-l::form-input name="propImportDisk" type="number" :value="old('propImportDisk', $prop->getProp('import_disk'))"/>
    <p class="formFormP">
        Limit
    </p>
    <x-l::form-input-error :messages="$errors->get('propImportLimit')"/>
    <x-l::form-input name="propImportLimit" type="number" :value="old('propImportLimit', $prop->getProp('import_limit'))"/>
    <p class="formFormP">
        Sleep
    </p>
    <x-l::form-input-error :messages="$errors->get('propImportSleep')"/>
    <x-l::form-input name="propImportSleep" type="number" :value="old('propImportSleep', $prop->getProp('import_sleep'))"/>
    <p class="formFormP">
        Redirect
    </p>
    <x-l::form-input-error :messages="$errors->get('propImportRedirect')"/>
    <x-l::form-input name="propImportRedirect" type="number" :value="old('propImportRedirect', $prop->getProp('import_redirect'))"/>
    <p class="formFormP">
        Separate
    </p>
    <x-l::form-input-error :messages="$errors->get('propImportSeparate')"/>
    <x-l::form-input name="propImportSeparate" type="number" :value="old('propImportSeparate', $prop->getProp('import_separate'))"/>
    <p class="formFormP">
        <strong>
            IMPORTER
        </strong>
    </p>
    <p class="formFormP">
        Delay
    </p>
    <x-l::form-input-error :messages="$errors->get('propImporterDelay')"/>
    <x-l::form-input name="propImporterDelay" type="number" :value="old('propImporterDelay', $prop->getProp('importer_delay'))"/>
    <p class="formFormP">
        <strong>
            RECORDER
        </strong>
    </p>
    <p class="formFormP">
        Freq
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderFreq')"/>
    <x-l::form-input name="propRecorderFreq" type="number" step="0.000001" :value="old('propRecorderFreq', $prop->getProp('recorder_freq'))"/>
    <p class="formFormP">
        Threshold
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderThreshold')"/>
    <x-l::form-input name="propRecorderThreshold" type="number" :value="old('propRecorderThreshold', $prop->getProp('recorder_threshold'))"/>
    <p class="formFormP">
        Delay pause
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderDelayPause')"/>
    <x-l::form-input name="propRecorderDelayPause" type="number" :value="old('propRecorderDelayPause', $prop->getProp('recorder_delay_pause'))"/>
    <p class="formFormP">
        Delay stop
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderDelayStop')"/>
    <x-l::form-input name="propRecorderDelayStop" type="number" :value="old('propRecorderDelayStop', $prop->getProp('recorder_delay_stop'))"/>
    <p class="formFormP">
        Min duration
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderMinDuration')"/>
    <x-l::form-input name="propRecorderMinDuration" type="number" :value="old('propRecorderMinDuration', $prop->getProp('recorder_min_duration'))"/>
    <p class="formFormP">
        Max duration
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderMaxDuration')"/>
    <x-l::form-input name="propRecorderMaxDuration" type="number" :value="old('propRecorderMaxDuration', $prop->getProp('recorder_max_duration'))"/>
    <p class="formFormP">
        Play
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderPlay')"/>
    <x-l::form-input name="propRecorderPlay" type="number" :value="old('propRecorderPlay', $prop->getProp('recorder_play'))"/>
    <p class="formFormP">
        File
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderFile')"/>
    <x-l::form-input name="propRecorderFile" type="number" :value="old('propRecorderFile', $prop->getProp('recorder_file'))"/>
    <p class="formFormP">
        <strong>
            EXPORT
        </strong>
    </p>
    <p class="formFormP">
        Limit
    </p>
    <x-l::form-input-error :messages="$errors->get('propExportLimit')"/>
    <x-l::form-input name="propExportLimit" type="number" :value="old('propExportLimit', $prop->getProp('export_limit'))"/>
    <p class="formFormP">
        Sleep
    </p>
    <x-l::form-input-error :messages="$errors->get('propExportSleep')"/>
    <x-l::form-input name="propExportSleep" type="number" :value="old('propExportSleep', $prop->getProp('export_sleep'))"/>
    <p class="formFormP">
        Separate
    </p>
    <x-l::form-input-error :messages="$errors->get('propExportSeparate')"/>
    <x-l::form-input name="propExportSeparate" type="number" :value="old('propExportSeparate', $prop->getProp('export_separate'))"/>
    <p class="formFormP">
        <strong>
            EXPORTER
        </strong>
    </p>
    <p class="formFormP">
        Delay
    </p>
    <x-l::form-input-error :messages="$errors->get('propExporterDelay')"/>
    <x-l::form-input name="propExporterDelay" type="number" :value="old('propExporterDelay', $prop->getProp('exporter_delay'))"/>
    <p class="formFormP">
        <strong>
            APP
        </strong>
    </p>
    <p class="formFormP">
        Mode
    </p>
    <x-l::form-input-error :messages="$errors->get('propAppMode')"/>
    <x-l::form-input name="propAppMode" type="number" :value="old('propAppMode', $prop->getProp('app_mode'))"/>
    <p class="formFormP">
        Register
    </p>
    <x-l::form-input-error :messages="$errors->get('propAppRegister')"/>
    <x-l::form-input name="propAppRegister" type="number" :value="old('propAppRegister', $prop->getProp('app_register'))"/>
    <p class="formFormP">
        Paginator
    </p>
    <x-l::form-input-error :messages="$errors->get('propAppPaginator')"/>
    <x-l::form-input name="propAppPaginator" type="number" :value="old('propAppPaginator', $prop->getProp('app_paginator'))"/>
    <p class="formFormP">
        <strong>
            Настройка Audio Recorder в SDR#:
        </strong>
    </p>
    <p class="formFormP">
        date + "." + time  + "." + frequency
    </p>
    <p class="formFormP">
        <strong>
            Пример правильного имени файла:
        </strong>
    </p>
    <p class="formFormP">
        2024_12_31.23-59-59.100,000 MHz.wav
    </p>
    <p class="formFormP">
        <strong>
            Импорт
        </strong>
    </p>
    <p class="formFormP">
        С диска SELF на RECORDS
    </p>
    <p class="formFormP">
        С диска FTP на RECORDS
    </p>
    <p class="formFormP">
        <strong>
            Экспорт
        </strong>
    </p>
    <p class="formFormP">
        С диска TEMP на OUT
    </p>
    <x-l::form-btn>
        Обновить
    </x-l::form-btn>
    <a href="/" class="formFormA">
        Назад
    </a>
</x-l-layout::form>
