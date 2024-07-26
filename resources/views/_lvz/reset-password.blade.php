<x-l-layout::form :action="route('password.store')" >
    <x-slot:title>
        Сброс пароля
    </x-slot:title>
    <x-slot:header_info>
        Сброс пароля
    </x-slot:header_info>
    <x-l::form-input type="hidden" name="token" value="{{ $request->route('token') }}"/>
    <x-l::form-input-error :messages="$errors->get('resetPasswordEmail')"/>
    <x-l::form-input name="resetPasswordEmail" type="text" placeholder="Email" :value="old('resetPasswordEmail', $request->email)"/>
    <x-l::form-input-error :messages="$errors->get('resetPasswordPassword')"/>
    <x-l::form-input name="resetPasswordPassword" type="password" placeholder="Пароль" :value="old('resetPasswordPassword')"/>
    <x-l::form-input-error :messages="$errors->get('resetPasswordPassword_confirmation')"/>
    <x-l::form-input name="resetPasswordPassword_confirmation" type="password" placeholder="Пароль" :value="old('resetPasswordPassword_confirmation')"/>
    <x-l::form-btn>
        Установить
    </x-l::form-btn>
    <a href="{{ route('login') }}" class="formFormA">
        Вход
    </a>
</x-l-layout::form>
