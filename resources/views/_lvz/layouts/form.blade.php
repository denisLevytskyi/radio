<x-l-layout::main show-auth="no" show-status="no">
    @isset($title)
        <x-slot:title>
            {{ $title }}
        </x-slot:title>
    @endisset
    @isset($header_info)
        <x-slot:header_info>
            {{ $header_info }}
        </x-slot:header_info>
    @endisset
    <x-slot:style>
        <link rel="stylesheet" href="{{ asset('css/lvz/form.css') }}">
        @isset($style)
            {{ $style }}
        @endisset
    </x-slot:style>
    @isset($before)
        {{ $before }}
    @endisset
    <section class="form">
        <div class="container">
            <form action="{{ $action }}" method="{{ $method }}" class="formForm">
                @csrf
                <x-l::form-input-status :message="session('status')"/>
                <x-l::form-input-error :messages="$errors->get('status')"/>
                {{ $slot }}
            </form>
        </div>
    </section>
    @isset($after)
        {{ $after }}
    @endisset
</x-l-layout::main>
