<x-l-layout::form :action="route('password.email')" >
    <x-slot:title>
        Восстановление пароля
    </x-slot:title>
    <x-slot:header_info>
        Восстановление пароля
    </x-slot:header_info>
    <x-l::form-input-error :messages="$errors->get('forgotPasswordEmail')"/>
    <x-l::form-input name="forgotPasswordEmail" type="text" placeholder="Email" :value="old('forgotPasswordEmail')"/>
    <x-l::form-btn>
        Восстановить
    </x-l::form-btn>
    <a href="{{ route('login') }}" class="formFormA">
        Вход
    </a>
    <a href="{{ route('register') }}" class="formFormA">
        Регистрация
    </a>
</x-l-layout::form>
