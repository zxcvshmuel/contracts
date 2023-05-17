<x-layouts.head>
    <x-slot:title>
        {{ $title ?? '' }}
    </x-slot:title>

    <x-slot:styles>
        {{ $styles ?? '' }}
    </x-slot:styles>
</x-layouts.head>

{{ $body ?? '' }}


<x-layouts.footer>
    <x-slot:scripts>
        {{ $scripts ?? '' }}
    </x-slot:scripts>
</x-layouts.footer>
