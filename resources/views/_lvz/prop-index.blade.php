<x-l-layout::form :action="route('app.prop.store')" >
    <x-slot:title>
        Параметры
    </x-slot:title>
    <x-slot:header_info>
        Параметры
    </x-slot:header_info>
    <p class="formFormP">
        <strong>
            FTP
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
        <strong>
            IMPORT
        </strong>
    </p>
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
    <x-l::form-btn>
        Обновить
    </x-l::form-btn>
    <a href="/" class="formFormA">
        Назад
    </a>
</x-l-layout::form>
