<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            @isset($title)
                {{ $title }}
            @else
                LVZ
            @endisset
        </title>
        <link rel="stylesheet" href="{{ asset('css/lvz/main.css') }}">
        <link rel="stylesheet" href="{{ asset('css/lvz/list.css') }}">
        @isset($style)
            {{ $style }}
        @endisset
    </head>
    <body>
        <header class="header">
            <div class="container">
                <div class="headerWrap">
                    <a href="/" class="headerWrapLink">
                        <img src="{{ asset('images/main_logo.png') }}" class="headerWrapLinkImg" alt="logo">
                    </a>
                    <p class="headerWrapP">
                        [LVZ]
                        @isset($header_info)
                            {{ $header_info }}
                        @endisset
                    </p>
                </div>
            </div>
        </header>
        @if ($showAuth == 'show')
            <x-l::auth-info/>
        @endif
        @if ($showStatus == 'show')
            <x-l::status :message="session('status')"/>
            <x-l::status-error :messages="$errors->get('status')"/>
        @endif
        {{ $slot }}
    </body>
</html>
