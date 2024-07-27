<x-l-layout::form :action="route('app.freq.update' , $freq->id)">
    @method('put')
    <x-slot:title>
        Обновление частоты
    </x-slot:title>
    <x-slot:header_info>
        Обновление частоты
    </x-slot:header_info>
    <pre class="productFormP">Запись №: {{ $freq->id }}</pre>
    <pre class="productFormP">Добавлена: [{{ $freq->user_id }}] {{ $freq->user->name }}</pre>
    <br>
    <p class="formFormP">
        Название
    </p>
    <x-l::form-input-error :messages="$errors->get('freqEditName')"/>
    <x-l::form-input name="freqEditName" type="text" :value="old('freqEditName', $freq->name)"/>
    <p class="formFormP">
        Частота
    </p>
    <x-l::form-input readonly :value="$freq->freq"/>
    <x-l::form-btn>
        Обновить
    </x-l::form-btn>
    <a href="{{ route('app.freq.index') }}" class="formFormA">
        Назад
    </a>
    <x-l::form-delete :action="route('app.freq.destroy', $freq->id)">
        Удалить
    </x-l::form-delete>
</x-l-layout::form>
