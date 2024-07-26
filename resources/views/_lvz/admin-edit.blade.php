<x-l-layout::form :action="route('app.admin.update', $user->id)">
    @method('put')
    <x-slot:title>
        Обновление пользователя
    </x-slot:title>
    <x-slot:header_info>
        Обновление пользователя
    </x-slot:header_info>
    <p class="formFormP">
        Имя
    </p>
    <x-l::form-input-error :messages="$errors->get('adminEditName')"/>
    <x-l::form-input name="adminEditName" type="text" :value="old('adminEditName', $user->name)"/>
    <p class="formFormP">
        Email
    </p>
    <x-l::form-input-error :messages="$errors->get('adminEditEmail')"/>
    <x-l::form-input name="adminEditEmail" type="text" :value="old('adminEditEmail', $user->email)"/>
    <p class="formFormP">
        Пароль
    </p>
    <x-l::form-input-error :messages="$errors->get('adminEditPassword')"/>
    <x-l::form-input name="adminEditPassword" type="text" :value="old('adminEditPassword')"/>
    <p class="formFormP">
        Пароль
    </p>
    <x-l::form-input-error :messages="$errors->get('adminEditPassword_confirmation')"/>
    <x-l::form-input name="adminEditPassword_confirmation" type="text" :value="old('adminEditPassword_confirmation')"/>
    <x-l::form-input-check name="adminEditAdmin" :checked="old('adminEditAdmin', $roles['admin'])">
        Администратор
    </x-l::form-input-check>
    <x-l::form-input-check name="adminEditUser" :checked="old('adminEditUser', $roles['user'])">
        Пользователь
    </x-l::form-input-check>
    <x-l::form-input-check name="adminEditGuest" :checked="old('adminEditGuest', $roles['guest'])">
        Гость
    </x-l::form-input-check>
    <x-l::form-btn>
        Обновить
    </x-l::form-btn>
    <a href="{{ route('app.admin.index') }}" class="formFormA">
        Назад
    </a>
    <x-l::form-delete :action="route('app.admin.destroy', $user->id)">
        Удалить
    </x-l::form-delete>
</x-l-layout::form>
