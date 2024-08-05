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
