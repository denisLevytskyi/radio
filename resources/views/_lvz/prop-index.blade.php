<x-l-layout::form :action="route('app.prop.store')" >
    <x-slot:title>
        Параметры
    </x-slot:title>
    <x-slot:header_info>
        Параметры
    </x-slot:header_info>
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
        Port
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpPort')"/>
    <x-l::form-input name="propFtpPort" type="number" :value="old('propFtpPort', $prop->get_prop('ftp_port'))"/>
    <p class="formFormP">
        Limit
    </p>
    <x-l::form-input-error :messages="$errors->get('propFtpLimit')"/>
    <x-l::form-input name="propFtpLimit" type="number" :value="old('propFtpLimit', $prop->get_prop('ftp_limit'))"/>
    <p class="formFormP">
        Register reach
    </p>
    <x-l::form-input-error :messages="$errors->get('propRegisterReach')"/>
    <x-l::form-input name="propRegisterReach" type="number" :value="old('propRegisterReach', $prop->get_prop('register_reach'))"/>
    <x-l::form-btn>
        Обновить
    </x-l::form-btn>
    <a href="/" class="formFormA">
        Назад
    </a>
</x-l-layout::form>
