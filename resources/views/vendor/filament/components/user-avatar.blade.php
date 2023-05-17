@props([
    'user' => \Filament\Facades\Filament::auth()->user(),
])

<div
    {{ $attributes->class([
        'w-20 h-20 bg-cover bg-center'
    ]) }}
    {{--    style="background-image: url('{{ \Filament\Facades\Filament::getUserAvatarUrl($user) }}')"--}}
    @if ($user->logo_url !== null)
        style="background-image: url('{{ \Illuminate\Support\Facades\Storage::url('/') . $user->logo_url }}')"
    @else
        style="background-image: url('{{ \Filament\Facades\Filament::getUserAvatarUrl($user) }}')"
    @endif
></div>
