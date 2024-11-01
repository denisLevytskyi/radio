<x-l-layout::form :action="route('app.manual.export.store')" >
    <x-slot:title>
        Ручной экспорт
    </x-slot:title>
    <x-slot:header_info>
        Ручной экспорт
    </x-slot:header_info>
    <p class="formFormP">
        Path
    </p>
    <x-l::form-input-error :messages="$errors->get('manualExportPath')"/>
    <x-l::form-input name="manualExportPath" type="text" :value="old('manualExportPath', $prop->getProp('temp_path'))"/>
    <p class="formFormP">
        Host
    </p>
    <x-l::form-input-error :messages="$errors->get('manualExportHost')"/>
    <x-l::form-input name="manualExportHost" type="text" :value="old('manualExportHost', $prop->getProp('out_host'))"/>
    <p class="formFormP">
        Username
    </p>
    <x-l::form-input-error :messages="$errors->get('manualExportUsername')"/>
    <x-l::form-input name="manualExportUsername" type="text" :value="old('manualExportUsername', $prop->getProp('out_username'))"/>
    <p class="formFormP">
        Password
    </p>
    <x-l::form-input-error :messages="$errors->get('manualExportPassword')"/>
    <x-l::form-input name="manualExportPassword" type="text" :value="old('manualExportPassword', $prop->getProp('out_password'))"/>
    <p class="formFormP">
        Root
    </p>
    <x-l::form-input-error :messages="$errors->get('manualExportRoot')"/>
    <x-l::form-input name="manualExportRoot" type="text" :value="old('manualExportRoot', $prop->getProp('out_root'))"/>
    <p class="formFormP">
        Port
    </p>
    <x-l::form-input-error :messages="$errors->get('manualExportPort')"/>
    <x-l::form-input name="manualExportPort" type="number" :value="old('manualExportPort', $prop->getProp('out_port'))"/>
    <p class="formFormP">
        Passive
    </p>
    <x-l::form-input-error :messages="$errors->get('manualExportPassive')"/>
    <x-l::form-input name="manualExportPassive" type="number" :value="old('manualExportPassive', $prop->getProp('out_passive'))"/>
    <p class="formFormP">
        Timeout
    </p>
    <x-l::form-input-error :messages="$errors->get('manualExportTimeout')"/>
    <x-l::form-input name="manualExportTimeout" type="number" :value="old('manualExportTimeout', $prop->getProp('out_timeout'))"/>
    <x-l::form-input-check name="manualExportIgnore" :checked="(bool) old('manualExportIgnore')">
        Ignore filename
    </x-l::form-input-check>
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
            Экспорт
        </strong>
    </p>
    <p class="formFormP">
        С диска TEMP на OUT
    </p>
    <x-l::form-btn>
        Отправить записи
    </x-l::form-btn>
    <a href="/" class="formFormA">
        Назад
    </a>
</x-l-layout::form>
