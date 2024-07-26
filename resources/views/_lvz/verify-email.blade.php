<x-l-layout::form :action="route('verification.send')" >
    <x-slot:title>
        Подтвердите email
    </x-slot:title>
    <x-slot:header_info>
        Подтвердите email
    </x-slot:header_info>
    <p class="formFormP">
        Спасибо за регистрацию! Прежде чем начать, не могли бы вы подтвердить свой адрес электронной почты, нажав на ссылку, которую мы только что отправили вам по электронной почте? Если вы не получили письмо, мы с радостью отправим вам другое.
    </p>
    <x-l::form-btn>
        Подтвердить
    </x-l::form-btn>
    <a href="{{ route('logout') }}" class="formFormA">
        Выход
    </a>
</x-l-layout::form>
