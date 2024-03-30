@if (count($providers))
    <div class="relative flex items-center justify-center text-center">
        <div class="absolute border-t border-gray-200 w-full h-px"></div>
        <p class="inline-block relative bg-white text-sm p-2 rounded-full font-medium text-gray-500 dark:bg-gray-800 dark:text-gray-100">
            או התחבר באמצעות
        </p>
    </div>

    <div class="grid @if(count($providers) > 1) grid-cols-2 @endif gap-4 pb-2">
        @foreach($providers as $key => $provider)
            <x-filament::button
                color="secondary"
                :icon="$provider['icon'] ?? null"
                tag="a"
                :href="route('socialite.oauth.redirect', $key)"
            >
                {{ $provider['label'] }}
            </x-filament::button>
        @endforeach
    </div>
@else
    <span></span>
@endif
