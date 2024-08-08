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
    <x-l::form-input name="propFtpHost" type="text" :value="old('propFtpHost', $prop->get_prop('ftp_host'))"/>
    <p class="formFormP">
        Username
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpUsername')"/>
    <x-l::form-input name="propFtpUsername" type="text" :value="old('propFtpUsername', $prop->get_prop('ftp_username'))"/>
    <p class="formFormP">
        Password
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpPassword')"/>
    <x-l::form-input name="propFtpPassword" type="text" :value="old('propFtpPassword', $prop->get_prop('ftp_password'))"/>
    <p class="formFormP">
        Root
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpRoot')"/>
    <x-l::form-input name="propFtpRoot" type="text" :value="old('propFtpRoot', $prop->get_prop('ftp_root'))"/>
    <p class="formFormP">
        Port
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpPort')"/>
    <x-l::form-input name="propFtpPort" type="number" :value="old('propFtpPort', $prop->get_prop('ftp_port'))"/>
    <p class="formFormP">
        <strong>
            IMPORT
        </strong>
    </p>
    <p class="formFormP">
        Limit
    </p>
    <x-l::form-input-error :messages="$errors->get('propImportLimit')"/>
    <x-l::form-input name="propImportLimit" type="number" :value="old('propImportLimit', $prop->get_prop('import_limit'))"/>
    <p class="formFormP">
        Redirect
    </p>
    <x-l::form-input-error :messages="$errors->get('propImportRedirect')"/>
    <x-l::form-input name="propImportRedirect" type="number" :value="old('propImportRedirect', $prop->get_prop('import_redirect'))"/>
    <p class="formFormP">
        <strong>
            RECORDER
        </strong>
    </p>
    <p class="formFormP">
        Freq
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderFreq')"/>
    <x-l::form-input name="propRecorderFreq" type="number" step="0.0005" :value="old('propRecorderFreq', $prop->get_prop('recorder_freq'))"/>
    <p class="formFormP">
        Threshold
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderThreshold')"/>
    <x-l::form-input name="propRecorderThreshold" type="number" :value="old('propRecorderThreshold', $prop->get_prop('recorder_threshold'))"/>
    <p class="formFormP">
        Delay pause
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderDelayPause')"/>
    <x-l::form-input name="propRecorderDelayPause" type="number" :value="old('propRecorderDelayPause', $prop->get_prop('recorder_delay_pause'))"/>
    <p class="formFormP">
        Delay stop
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderDelayStop')"/>
    <x-l::form-input name="propRecorderDelayStop" type="number" :value="old('propRecorderDelayStop', $prop->get_prop('recorder_delay_stop'))"/>
    <p class="formFormP">
        Min duration
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderMinDuration')"/>
    <x-l::form-input name="propRecorderMinDuration" type="number" :value="old('propRecorderMinDuration', $prop->get_prop('recorder_min_duration'))"/>
    <p class="formFormP">
        Max duration
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderMaxDuration')"/>
    <x-l::form-input name="propRecorderMaxDuration" type="number" :value="old('propRecorderMaxDuration', $prop->get_prop('recorder_max_duration'))"/>
    <p class="formFormP">
        Play
    </p>
    <x-l::form-input-error :messages="$errors->get('propRecorderPlay')"/>
    <x-l::form-input name="propRecorderPlay" type="number" :value="old('propRecorderPlay', $prop->get_prop('recorder_play'))"/>
    <p class="formFormP">
        <strong>
            APP
        </strong>
    </p>
    <p class="formFormP">
        Mode
    </p>
    <x-l::form-input-error :messages="$errors->get('propAppMode')"/>
    <x-l::form-input name="propAppMode" type="number" :value="old('propAppMode', $prop->get_prop('app_mode'))"/>
    <p class="formFormP">
        Register
    </p>
    <x-l::form-input-error :messages="$errors->get('propAppRegister')"/>
    <x-l::form-input name="propAppRegister" type="number" :value="old('propAppRegister', $prop->get_prop('app_register'))"/>
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
