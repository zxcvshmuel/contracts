<x-filament-breezy::auth-card action="logout">
    <div class="w-full flex justify-center">
        <x-filament::brand />
    </div>

    <div class="space-y-8">
        <h2 class="font-bold tracking-tight text-center text-2xl">
            {{ __('default.verification.heading') }}
        </h2>
        <div>
            {{ __('default.verification.before_proceeding') }}
            @unless($hasBeenSent)
                {{ __('default.verification.not_receive') }}

                <a class="text-primary-600" href="#" wire:click="resend">
                    {{ __('default.verification.request_another') }}
                </a>

            @else
                <span class="block text-success-600 font-semibold">{{ __('default.verification.notification_success') }}</span>
            @endunless
        </div>
    </div>

    {{ $this->form }}

    <x-filament::button type="submit" class="w-full">
        {{ __('default.verification.submit.label') }}
    </x-filament::button>
</x-filament-breezy::auth-card>
