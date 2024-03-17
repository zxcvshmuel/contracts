<?php
use Carbon\Carbon;
?>
<x-filament::widget class="filament-account-widget">
    <x-filament::card>
        @php
            $user = \Filament\Facades\Filament::auth()->user();
        @endphp

        <div class="flex items-center justify-center h-12">
        <h2 class="text-lg font-bold tracking-tight text-center sm:text-xl">
                    {{ __('filament::widgets/account-widget.welcome', ['user' => \Filament\Facades\Filament::getUserName($user)]) }}
                </h2>
            </div>
        </div>
        <div class="flex justify-around pb-6">
            <div class="flex flex-col items-center justify-center w-1/4 pt-1 bg-red-200 bg-no-repeat border border-red-300 flex-column rounded-xl min-h-[80px]">
                <div class="mb-1 text-sm">שם המסלול</div>
                <div class="text-sm">{{ auth()->user()->packages()->first()->name }}</div>
            </div>

            <div class="flex flex-col items-center justify-center w-1/4 pt-1 bg-blue-200 bg-no-repeat border border-blue-300 flex-column rounded-xl">
                <div class="mb-1 text-sm">תוקף המינוי</div>
                <div class="text-sm">{{ Carbon::createFromDate(auth()->user()->active_until)->format('d-m-y') }}</div>
            </div>

            <div class="flex flex-col items-center justify-center w-1/4 pt-1 bg-green-200 bg-no-repeat border border-green-300 flex-column rounded-xl">
                <div class="mb-1 text-sm">מסמכים שנוצרו</div>
                <div class="text-sm">{{ auth()->user()->contracts()->count() }}</div>
            </div>
            </div>
    </x-filament::card>
</x-filament::widget>
