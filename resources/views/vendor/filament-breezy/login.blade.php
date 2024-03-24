<x-filament-breezy::auth-card action="authenticate">

    <div class="flex justify-center w-full">
        <x-filament::brand />
    </div>

    <div>
        <h2 class="text-2xl font-bold tracking-tight text-center">
            {{ __('filament::login.heading') }}
        </h2>
        @if(config("filament-breezy.enable_registration"))
            <p class="mt-2 text-sm text-center">
                {{ __('default.or') }}
                <a class="text-primary-600" href="{{route(config('filament-breezy.route_group_prefix').'register')}}">
                    {{ strtolower(__('filament-breezy::default.registration.heading')) }}
                </a>
            </p>
        @endif
    </div>

    {{ $this->form }}
    <x-filament-socialite::buttons />

    <x-filament::button type="submit" class="w-full">
        {{ __('filament::login.buttons.submit.label') }}
    </x-filament::button>

    <div class="text-center">
        <a class="text-primary-600 hover:text-primary-700" href="{{route(config('filament-breezy.route_group_prefix').'password.request')}}">שכחתי סיסמא</a>
    </div>
</x-filament-breezy::auth-card>
