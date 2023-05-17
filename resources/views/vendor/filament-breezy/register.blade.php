<x-filament-breezy::auth-card action="register">
    <div class="w-full flex justify-center">
        <x-filament::brand />
    </div>

    <div>
        <h2 class="font-bold tracking-tight text-center text-2xl">
            {{ __('default.registration.heading') }}
        </h2>
        <p class="mt-2 text-sm text-center">
            {{ __('default.or') }}
            <a class="text-primary-600" href="{{route('filament.auth.login')}}">
                {{ strtolower(__('filament::login.heading')) }}
            </a>
        </p>
    </div>

    {{ $this->form }}

    <x-filament::button type="submit" class="w-full">
        {{ __('default.registration.submit.label') }}
    </x-filament::button>
</x-filament-breezy::auth-card>
