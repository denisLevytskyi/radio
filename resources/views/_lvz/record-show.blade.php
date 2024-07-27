<x-l-layout::form :action="route('app.record.store')">
    <x-slot:title>
        Запись № {{ $record->id }}
    </x-slot:title>
    <x-slot:header_info>
        Запись № {{ $record->id }}
    </x-slot:header_info>
    <pre class="productFormP">Запись №: {{ $record->id }}</pre>
    <pre class="productFormP">Добавлена: [{{ $record->user_id }}] {{ $record->user->name }}</pre>
    <br>
    <p class="formFormP">
        Название
    </p>
    <x-l::form-input readonly :value="$record->name()"/>
    <p class="formFormP">
        Частота
    </p>
    <x-l::form-input readonly :value="$record->freq"/>
    <p class="formFormP">
        Дата
    </p>
    <x-l::form-input readonly :value="$record->timestamp"/>
    <x-l::form-audio>
        {{ asset('records/' . $record->path) }}
    </x-l::form-audio>
    <a href="{{ route('app.record.index') }}" class="formFormA">
        Назад
    </a>
    <x-l::form-delete :action="route('app.record.destroy', $record->id)">
        Удалить
    </x-l::form-delete>
</x-l-layout::form>
