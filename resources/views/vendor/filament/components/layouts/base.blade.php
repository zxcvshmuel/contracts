@props([
    'title' => null,
])

<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    dir="{{ __('filament::layout.direction') ?? 'ltr' }}"
    class="min-h-screen antialiased bg-gray-100 filament js-focus-visible"
>
    <head>
        {{ \Filament\Facades\Filament::renderHook('head.start') }}

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="og:image" content="https://my-safe.co.il/storage/layout/ogimage.png">

    @foreach (\Filament\Facades\Filament::getMeta() as $tag)
            {{ $tag }}
        @endforeach

        @if ($favicon = config('filament.favicon'))
            <link rel="icon" href="{{ $favicon }}">
        @endif

        <title>{{ $title ? "{$title} - " : null }} {{ config('filament.brand') }}</title>

        {{ \Filament\Facades\Filament::renderHook('styles.start') }}

        <style>
            [x-cloak=""], [x-cloak="x-cloak"], [x-cloak="1"] { display: none !important; }
            @media (max-width: 1023px) { [x-cloak="-lg"] { display: none !important; } }
            @media (min-width: 1024px) { [x-cloak="lg"] { display: none !important; } }
            :root {
                --sidebar-width: {{ config('filament.layout.sidebar.width') ?? '16rem' }};
                --collapsed-sidebar-width: {{ config('filament.layout.sidebar.collapsed_width') ?? '5.4rem' }};
                --quick-create-color: {{ auth()->user()->color ?? '#3788d8' }};
            }
        </style>

        @livewireStyles

        @if (filled($fontsUrl = config('filament.google_fonts')))
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="{{ $fontsUrl }}" rel="stylesheet" />
        @endif

        @foreach (\Filament\Facades\Filament::getStyles() as $name => $path)
            @if (\Illuminate\Support\Str::of($path)->startsWith(['http://', 'https://']))
                <link rel="stylesheet" href="{{ $path }}" />
            @elseif (\Illuminate\Support\Str::of($path)->startsWith('<'))
                {!! $path !!}
            @else
                <link rel="stylesheet" href="{{ route('filament.asset', [
                    'file' => "{$name}.css",
                ]) }}" />
            @endif
        @endforeach

        {{ \Filament\Facades\Filament::getThemeLink() }}

        {{ \Filament\Facades\Filament::renderHook('styles.end') }}

        @if (config('filament.dark_mode'))
            <script>
                const theme = localStorage.getItem('theme')

                if ((theme === 'dark') || (! theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.documentElement.classList.add('dark')
                }
            </script>
        @endif

        {{ \Filament\Facades\Filament::renderHook('head.end') }}
    </head>

    <body @class([
        'filament-body min-h-screen bg-gray-100 text-gray-900 overflow-y-auto',
        'dark:text-gray-100 dark:bg-gray-900' => config('filament.dark_mode'),
    ])>
        {{ \Filament\Facades\Filament::renderHook('body.start') }}

        {{ $slot }}

        {{ \Filament\Facades\Filament::renderHook('scripts.start') }}

        @livewireScripts

        <script>
            window.filamentData = @json(\Filament\Facades\Filament::getScriptData());
        </script>

        @foreach (\Filament\Facades\Filament::getBeforeCoreScripts() as $name => $path)
            @if (\Illuminate\Support\Str::of($path)->startsWith(['http://', 'https://']))
                <script defer src="{{ $path }}"></script>
            @elseif (\Illuminate\Support\Str::of($path)->startsWith('<'))
                {!! $path !!}
            @else
                <script defer src="{{ route('filament.asset', [
                    'file' => "{$name}.js",
                ]) }}"></script>
            @endif
        @endforeach

        @stack('beforeCoreScripts')

        <script defer src="{{ route('filament.asset', [
            'id' => Filament\get_asset_id('app.js'),
            'file' => 'app.js',
        ]) }}"></script>

        @if (config('filament.broadcasting.echo'))
            <script defer src="{{ route('filament.asset', [
                'id' => Filament\get_asset_id('echo.js'),
                'file' => 'echo.js',
            ]) }}"></script>

            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    window.Echo = new window.EchoFactory(@js(config('filament.broadcasting.echo')))

                    window.dispatchEvent(new CustomEvent('EchoLoaded'))
                })
            </script>
        @endif

        @foreach (\Filament\Facades\Filament::getScripts() as $name => $path)
            @if (\Illuminate\Support\Str::of($path)->startsWith(['http://', 'https://']))
                <script defer src="{{ $path }}"></script>
            @elseif (\Illuminate\Support\Str::of($path)->startsWith('<'))
                {!! $path !!}
            @else
                <script defer src="{{ route('filament.asset', [
                    'file' => "{$name}.js",
                ]) }}"></script>
            @endif
        @endforeach
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="{{ url('js/flowbite.js') }}" type="text/javascript"></script>
        @stack('scripts')

        {{ \Filament\Facades\Filament::renderHook('scripts.end') }}

        {{ \Filament\Facades\Filament::renderHook('body.end') }}
    </body>
</html>
