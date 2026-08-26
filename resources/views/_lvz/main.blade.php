<x-l-layout::main>
    <x-slot:title>
        Главная
    </x-slot:title>
    <x-slot:header_info>
        Главная страница
    </x-slot:header_info>
    <x-slot:style>
        <link rel="stylesheet" href="{{ asset('css/lvz/index.css') }}">
    </x-slot:style>
    <section class="links">
        <div class="container typicalContainer">
            <div class="linksWrapper">
                @if(Auth::user()->isPassStrongMod())
                    <a href="{{ route('app.freq.index') }}" class="linksWrapperA">
                        Частоты
                    </a>
                @endif
                <a href="{{ route('app.record.index') }}" class="linksWrapperA">
                    Записи
                </a>
                @if(Auth::user()->isUser())
                    <a href="{{ route('app.import') }}" class="linksWrapperA">
                        Импорт
                    </a>
                @endif
                @if(Auth::user()->isRecorder())
                    <a href="{{ route('app.recorder.index') }}" class="linksWrapperA">
                        Диктофон
                    </a>
                @endif
                @if(Auth::user()->isAdministrator())
                    <a href="{{ route('app.prop.index') }}" class="linksWrapperA">
                        Параметры
                    </a>
                    <a href="{{ route('app.admin.index') }}" class="linksWrapperA">
                        Пользователи
                    </a>
                    <a href="{{ route('app.clean') }}" class="linksWrapperA">
                        Очистить БД
                    </a>
                @endif
            </div>
        </div>
    </section>
</x-l-layout::main>
