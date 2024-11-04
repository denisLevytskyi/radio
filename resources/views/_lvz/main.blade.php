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
            <h1 class="linksH1">
                Доступные действия
            </h1>
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
                    <a href="{{ route('app.manual.import.index') }}" class="linksWrapperA">
                        Ручной импорт
                    </a>
                    <a href="{{ route('app.importer.index') }}" class="linksWrapperA">
                        Импортер
                    </a>
                    <a href="{{ route('app.ballast.create') }}" class="linksWrapperA">
                        Создать балласт
                    </a>
                    <a href="{{ route('app.ballast.delete') }}" class="linksWrapperA">
                        Удалить балласт
                    </a>
                    <a href="{{ route('app.recorder.index') }}" class="linksWrapperA">
                        Диктофон
                    </a>
                @endif
                @if(Auth::user()->isExporter())
                    <a href="{{ route('app.export') }}" class="linksWrapperA">
                        Экспорт
                    </a>
                    <a href="{{ route('app.manual.export.index') }}" class="linksWrapperA">
                        Ручной экспорт
                    </a>
                    <a href="{{ route('app.exporter.index') }}" class="linksWrapperA">
                        Экспортер
                    </a>
                @endif
                @if(Auth::user()->isAdministrator())
                    <a href="{{ route('app.prop.index') }}" class="linksWrapperA">
                        Параметры
                    </a>
                    <a href="{{ route('app.admin.index') }}" class="linksWrapperA">
                        Пользователи
                    </a>
                @endif
            </div>
        </div>
    </section>
</x-l-layout::main>
