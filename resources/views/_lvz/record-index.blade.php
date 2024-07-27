<x-l-layout::main>
    <x-slot:title>
        Список записей
    </x-slot:title>
    <x-slot:header_info>
        Список записей
    </x-slot:header_info>
    <section class="list">
        <div class="container typicalContainer">
            <div class="listWrap">
                @foreach($records as $record)
                    <div class="listWrapItem">
                        <a href="{{ route('app.record.show', $record->id) }}" class="listWrapItemA">
                            {{ $record->id . ' ' . $record->timestamp . ' ' . $record->freq  . ' ' . $record->name()}}
                        </a>
                    </div>
                @endforeach
                {{ $records->onEachSide(1)->links() }}
            </div>
        </div>
    </section>
</x-l-layout::main>
