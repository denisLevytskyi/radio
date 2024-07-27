<x-l-layout::form :action="route('app.freq.store')">
    <x-slot:title>
        Создание частоты
    </x-slot:title>
    <x-slot:header_info>
        Создание частоты
    </x-slot:header_info>
    <p class="formFormP">
        Название
    </p>
    <x-l::form-input-error :messages="$errors->get('freqCreateName')"/>
    <x-l::form-input name="freqCreateName" type="text" :value="old('freqCreateName')"/>
    <p class="formFormP">
        Частота
    </p>
    <x-l::form-input-error :messages="$errors->get('freqCreateFreq')"/>
    <x-l::form-input name="freqCreateFreq" type="number" step="0.000001" :value="old('freqCreateFreq')"/>
    <x-l::form-btn>
        Добавить
    </x-l::form-btn>
    <a href="{{ route('app.freq.index') }}" class="formFormA">
        Назад
    </a>
</x-l-layout::form>
