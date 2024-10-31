<x-l-layout::form :action="route('app.admin.store')">
    <x-slot:title>
        Создание пользователя
    </x-slot:title>
    <x-slot:header_info>
        Создание пользователя
    </x-slot:header_info>
    <p class="formFormP">
        Имя
    </p>
    <x-l::form-input-error :messages="$errors->get('adminCreateName')"/>
    <x-l::form-input name="adminCreateName" type="text" :value="old('adminCreateName')"/>
    <p class="formFormP">
        Email
    </p>
    <x-l::form-input-error :messages="$errors->get('adminCreateEmail')"/>
    <x-l::form-input name="adminCreateEmail" type="text" :value="old('adminCreateEmail')"/>
    <p class="formFormP">
        Пароль
    </p>
    <x-l::form-input-error :messages="$errors->get('adminCreatePassword')"/>
    <x-l::form-input name="adminCreatePassword" type="text" :value="old('adminCreatePassword')"/>
    <p class="formFormP">
        Пароль
    </p>
    <x-l::form-input-error :messages="$errors->get('adminCreatePassword_confirmation')"/>
    <x-l::form-input name="adminCreatePassword_confirmation" type="text" :value="old('adminCreatePassword_confirmation')"/>
    <x-l::form-input-check name="adminCreateAdmin" :checked="(bool) old('adminCreateAdmin')">
        Администратор
    </x-l::form-input-check>
    <x-l::form-input-check name="adminCreateExporter" :checked="(bool) old('adminCreateExporter')">
        Экспорт
    </x-l::form-input-check>
    <x-l::form-input-check name="adminCreateRecorder" :checked="(bool) old('adminCreateRecorder')">
        Диктофон
    </x-l::form-input-check>
    <x-l::form-input-check name="adminCreateUser" :checked="(bool) old('adminCreateUser')">
        Пользователь
    </x-l::form-input-check>
    <x-l::form-input-check name="adminCreateGuest" :checked="(bool) old('adminCreateGuest')">
        Гость
    </x-l::form-input-check>
    <x-l::form-btn>
        Добавить
    </x-l::form-btn>
    <a href="{{ route('app.admin.index') }}" class="formFormA">
        Назад
    </a>
</x-l-layout::form>
