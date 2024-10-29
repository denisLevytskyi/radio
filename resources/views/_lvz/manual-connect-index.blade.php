<x-l-layout::form :action="route('app.manual.connect.store')" >
    <x-slot:title>
        Ручное подключение
    </x-slot:title>
    <x-slot:header_info>
        Ручное подключение
    </x-slot:header_info>
    @if((int) $prop->getProp('import_disk') == 0)
        <p class="formFormP">
            Path
        </p>
        <x-l::form-input-error :messages="$errors->get('manualConnectSelfPath')"/>
        <x-l::form-input name="manualConnectSelfPath" type="text" :value="old('manualConnectSelfPath', $prop->getProp('self_path'))"/>
    @elseif((int) $prop->getProp('import_disk') == 1)
        <p class="formFormP">
            Host
        </p>
        <x-l::form-input-error :messages="$errors->get('manualConnectFtpHost')"/>
        <x-l::form-input name="manualConnectFtpHost" type="text" :value="old('manualConnectFtpHost', $prop->getProp('ftp_host'))"/>
        <p class="formFormP">
            Username
        </p>
        <x-l::form-input-error :messages="$errors->get('manualConnectFtpUsername')"/>
        <x-l::form-input name="manualConnectFtpUsername" type="text" :value="old('manualConnectFtpUsername', $prop->getProp('ftp_username'))"/>
        <p class="formFormP">
            Password
        </p>
        <x-l::form-input-error :messages="$errors->get('manualConnectFtpPassword')"/>
        <x-l::form-input name="manualConnectFtpPassword" type="text" :value="old('manualConnectFtpPassword', $prop->getProp('ftp_password'))"/>
        <p class="formFormP">
            Root
        </p>
        <x-l::form-input-error :messages="$errors->get('manualConnectFtpRoot')"/>
        <x-l::form-input name="manualConnectFtpRoot" type="text" :value="old('manualConnectFtpRoot', $prop->getProp('ftp_root'))"/>
        <p class="formFormP">
            Port
        </p>
        <x-l::form-input-error :messages="$errors->get('manualConnectFtpPort')"/>
        <x-l::form-input name="manualConnectFtpPort" type="number" :value="old('manualConnectFtpPort', $prop->getProp('ftp_port'))"/>
        <p class="formFormP">
            Passive
        </p>
        <x-l::form-input-error :messages="$errors->get('manualConnectFtpPassive')"/>
        <x-l::form-input name="manualConnectFtpPassive" type="number" :value="old('manualConnectFtpPassive', $prop->getProp('ftp_passive'))"/>
        <p class="formFormP">
            Timeout
        </p>
        <x-l::form-input-error :messages="$errors->get('manualConnectFtpTimeout')"/>
        <x-l::form-input name="manualConnectFtpTimeout" type="number" :value="old('manualConnectFtpTimeout', $prop->getProp('ftp_timeout'))"/>
    @endif
    <p class="formFormP">
        Freq
    </p>
    <x-l::form-input-error :messages="$errors->get('manualConnectFreq')"/>
    <x-l::form-input name="manualConnectFreq" type="number" step="0.000001" :value="old('manualConnectFreq')"/>
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
        Получить записи
    </x-l::form-btn>
    <a href="/" class="formFormA">
        Назад
    </a>
</x-l-layout::form>
