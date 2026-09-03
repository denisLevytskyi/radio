<x-l-layout::main>
    <x-slot:title>
        Список записей
    </x-slot:title>
    <x-slot:header_info>
        Список записей
    </x-slot:header_info>
    <section class="list">
        <div class="container typicalContainer">
            <a href="{{ route('app.import')}}" class="listA">
                Импорт
            </a>
            <p class="listP">
                /
            </p>
            <a href="{{ route('app.record.commented')}}" class="listA">
                С комментарием
            </a>
            <p class="listP">
                /
            </p>
            <a href="{{ route('app.record.index')}}" class="listA">
                Все
            </a>
            <form action="{{ route('app.record.search') }}" method="POST" class="listForm" id="form">
                @csrf
                <select class="listFormInput" id="input" name="recordSearchFreq">
                    <option value="0">Поиск по частоте</option>
                    @foreach($freqs as $freq)
                        <option value="{{ $freq->freq }}" {{ $current == $freq->freq ? 'selected' : '' }}>
                            {{ $freq->freq_form . ' ==> ' . $freq->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <div class="listWrap">
                @foreach($records as $record)
                    <div class="listWrapItem {{ $record->opened ? 'listWrapItemOpened' : '' }}">
                        <a href="{{ route('app.record.edit', $record->id) }}" class="listWrapItemA">
                            {{ $record->id . ' || ' . $record->timestamp . ' || ' . $record->freq_form  . ' || ' . $record->name}}
                        </a>
                    </div>
                @endforeach
                {{ $records->onEachSide(1)->links() }}
            </div>
        </div>
    </section>
    <script>
        document.getElementById('input').addEventListener('change', function() {
            document.getElementById('form').submit();
        });
    </script>
</x-l-layout::main>
