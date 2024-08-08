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
                @if(Auth::user()->isAdminWhenStrong())
                    <a href="{{ route('app.freq.index') }}" class="linksWrapperA">
                        Частоты
                    </a>
                @endif
                <a href="{{ route('app.record.index') }}" class="linksWrapperA">
                    Записи
                </a>
                <a href="{{ route('app.import') }}" class="linksWrapperA">
                    Получить записи
                </a>
                @if(Auth::user()->isRecorder())
                    <a href="{{ route('app.manual.connect') }}" class="linksWrapperA">
                        Ручное подключение
                    </a>
                    <a href="{{ route('app.recorder') }}" class="linksWrapperA">
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
                @endif
            </div>
        </div>
    </section>
</x-l-layout::main>
