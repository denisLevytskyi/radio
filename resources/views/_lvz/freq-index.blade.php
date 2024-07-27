<x-l-layout::main>
    <x-slot:title>
        Список частот
    </x-slot:title>
    <x-slot:header_info>
        Список частот
    </x-slot:header_info>
    <section class="list">
        <div class="container typicalContainer">
            <a href="{{ route('app.freq.create') }}" class="listA">
                Добавить частоту
            </a>
            <div class="listWrap">
                @foreach($freqs as $freq)
                    <div class="listWrapItem">
                        <a href="{{ route('app.freq.edit', $freq->id) }}" class="listWrapItemA">
                            {{ $freq->id . ' ' . $freq->name . ' ' . $freq->freq }}
                        </a>
                    </div>
                @endforeach
                {{ $freqs->onEachSide(1)->links() }}
            </div>
        </div>
    </section>
</x-l-layout::main>
