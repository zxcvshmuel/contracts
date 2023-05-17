@if (filled($brand = config('filament.brand')) and \App\Models\User::find(1)->logo_url !== null)
    <div @class([
        'filament-brand text-xl font-bold tracking-tight',
        'dark:text-white' => config('filament.dark_mode'),
    ])>
        <img class=" h-20 m-auto" src="{{ \Illuminate\Support\Facades\Storage::url('/') . \App\Models\User::find(1)->logo_url }}" alt="">
    </div>
@endif
