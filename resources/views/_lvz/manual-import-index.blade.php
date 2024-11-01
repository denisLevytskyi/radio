<x-l-layout::form :action="route('app.manual.import.store')" >
    <x-slot:title>
        Ручной импорт
    </x-slot:title>
    <x-slot:header_info>
        Ручной импорт
    </x-slot:header_info>
    @if((int) $prop->getProp('import_disk') == 0)
        <p class="formFormP">
            Path
        </p>
        <x-l::form-input-error :messages="$errors->get('manualImportPath')"/>
        <x-l::form-input name="manualImportPath" type="text" :value="old('manualImportPath', $prop->getProp('self_path'))"/>
    @elseif((int) $prop->getProp('import_disk') == 1)
        <p class="formFormP">
            Host
        </p>
        <x-l::form-input-error :messages="$errors->get('manualImportHost')"/>
        <x-l::form-input name="manualImportHost" type="text" :value="old('manualImportHost', $prop->getProp('ftp_host'))"/>
        <p class="formFormP">
            Username
        </p>
        <x-l::form-input-error :messages="$errors->get('manualImportUsername')"/>
        <x-l::form-input name="manualImportUsername" type="text" :value="old('manualImportUsername', $prop->getProp('ftp_username'))"/>
        <p class="formFormP">
            Password
        </p>
        <x-l::form-input-error :messages="$errors->get('manualImportPassword')"/>
        <x-l::form-input name="manualImportPassword" type="text" :value="old('manualImportPassword', $prop->getProp('ftp_password'))"/>
        <p class="formFormP">
            Root
        </p>
        <x-l::form-input-error :messages="$errors->get('manualImportRoot')"/>
        <x-l::form-input name="manualImportRoot" type="text" :value="old('manualImportRoot', $prop->getProp('ftp_root'))"/>
        <p class="formFormP">
            Port
        </p>
        <x-l::form-input-error :messages="$errors->get('manualImportPort')"/>
        <x-l::form-input name="manualImportPort" type="number" :value="old('manualImportPort', $prop->getProp('ftp_port'))"/>
        <p class="formFormP">
            Passive
        </p>
        <x-l::form-input-error :messages="$errors->get('manualImportPassive')"/>
        <x-l::form-input name="manualImportPassive" type="number" :value="old('manualImportPassive', $prop->getProp('ftp_passive'))"/>
        <p class="formFormP">
            Timeout
        </p>
        <x-l::form-input-error :messages="$errors->get('manualImportTimeout')"/>
        <x-l::form-input name="manualImportTimeout" type="number" :value="old('manualImportTimeout', $prop->getProp('ftp_timeout'))"/>
    @endif
    <p class="formFormP">
        Freq
    </p>
    <x-l::form-input-error :messages="$errors->get('manualImportFreq')"/>
    <x-l::form-input name="manualImportFreq" type="number" step="0.000001" :value="old('manualImportFreq')"/>
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
    @if((int) $prop->getProp('import_disk') == 0)
        <p class="formFormP">
            С диска SELF на RECORDS
        </p>
    @elseif((int) $prop->getProp('import_disk') == 1)
        <p class="formFormP">
            С диска FTP на RECORDS
        </p>
    @endif
    <x-l::form-btn>
        Получить записи
    </x-l::form-btn>
    <a href="/" class="formFormA">
        Назад
    </a>
</x-l-layout::form>
