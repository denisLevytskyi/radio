<x-l-layout::form :action="route('login')" >
    <x-slot:title>
        Вход
    </x-slot:title>
    <x-slot:header_info>
        Вход в приложение
    </x-slot:header_info>
    <x-l::form-input-error :messages="$errors->get('loginEmail')"/>
    <x-l::form-input name="loginEmail" type="text" placeholder="Email" :value="old('loginEmail')"/>
    <x-l::form-input-error :messages="$errors->get('loginPassword')"/>
    <x-l::form-input name="loginPassword" type="password" placeholder="Пароль" :value="old('loginPassword')"/>
    <x-l::form-input-check name="loginRemember">
        Запомнить меня
    </x-l::form-input-check>
    <x-l::form-btn>
        Вход
    </x-l::form-btn>
    <a href="{{ route('register') }}" class="formFormA">
        Регистрация
    </a>
    <a href="{{ route('password.request') }}" class="formFormA">
        Восстановить пароль
    </a>
</x-l-layout::form>
