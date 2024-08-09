<x-l-layout::form :action="route('app.manual.connect')" >
    <x-slot:title>
        Ручное подключение
    </x-slot:title>
    <x-slot:header_info>
        Ручное подключение
    </x-slot:header_info>
    <p class="formFormP">
        Host
    </p>
    <x-l::form-input-error :messages="$errors->get('manualConnectHost')"/>
    <x-l::form-input name="manualConnectHost" type="text" :value="old('manualConnectHost', $prop->getProp('ftp_host'))"/>
    <p class="formFormP">
        Username
    </p>
    <x-l::form-input-error :messages="$errors->get('manualConnectUsername')"/>
    <x-l::form-input name="manualConnectUsername" type="text" :value="old('manualConnectUsername', $prop->getProp('ftp_username'))"/>
    <p class="formFormP">
        Password
    </p>
    <x-l::form-input-error :messages="$errors->get('manualConnectPassword')"/>
    <x-l::form-input name="manualConnectPassword" type="text" :value="old('manualConnectPassword', $prop->getProp('ftp_password'))"/>
    <p class="formFormP">
        Root
    </p>
    <x-l::form-input-error :messages="$errors->get('manualConnectRoot')"/>
    <x-l::form-input name="manualConnectRoot" type="text" :value="old('manualConnectRoot', $prop->getProp('ftp_root'))"/>
    <p class="formFormP">
        Port
    </p>
    <x-l::form-input-error :messages="$errors->get('manualConnectPort')"/>
    <x-l::form-input name="manualConnectPort" type="number" :value="old('manualConnectPort', $prop->getProp('ftp_port'))"/>
    <p class="formFormP">
        Freq
    </p>
    <x-l::form-input-error :messages="$errors->get('manualConnectFreq')"/>
    <x-l::form-input name="manualConnectFreq" type="number" step="0.0005" :value="old('manualConnectFreq')"/>
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
