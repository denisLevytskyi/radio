<x-l-layout::form action="/">
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
    <p class="formFormP">
        Навигация
    </p>
    <div class="formFormNavigator">
        @if($navigator['previousById'])
            <a href="{{ route('app.record.show', $navigator['previousById']->id) }}" class="formFormNavigatorA">
                [ &#x21D0; ]
            </a>
        @else
            <p class="formFormNavigatorP">
                [ X ]
            </p>
        @endif
        @if($navigator['previousByFreq'])
            <a href="{{ route('app.record.show', $navigator['previousByFreq']->id) }}" class="formFormNavigatorA">
                [ &#8592; ]
            </a>
        @else
            <p class="formFormNavigatorP">
                [ X ]
            </p>
        @endif
        <a href="{{ route('app.record.search', $record->freq) }}" class="formFormNavigatorSearch">
            [ ПОИСК ]
        </a>
        @if($navigator['nextByFreq'])
            <a href="{{ route('app.record.show', $navigator['nextByFreq']->id) }}" class="formFormNavigatorA">
                [ &#8594; ]
            </a>
        @else
            <p class="formFormNavigatorP">
                [ X ]
            </p>
        @endif
        @if($navigator['nextById'])
            <a href="{{ route('app.record.show', $navigator['nextById']->id) }}" class="formFormNavigatorA">
                [ &#x21D2; ]
            </a>
        @else
            <p class="formFormNavigatorP">
                [ X ]
            </p>
        @endif
    </div>
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
