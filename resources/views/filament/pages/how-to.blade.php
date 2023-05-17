<x-filament::page>
    <x-slot name="heading">
    </x-slot>
    <div class="w-full desktop">
        <img src="{{ \Illuminate\Support\Facades\Storage::url('/') .'howTo/howToDesc.png'}}" alt="">
    </div>
    <div class="w-full mobile">
        <img src="{{ \Illuminate\Support\Facades\Storage::url('/') .'howTo/howToMobile.png'}}" alt="">
    </div>
    
    <style>
        .filament-main-content {
            padding: 0;
        }
        
        .filament-main{
            gap: 0;
        }
        
        img {
            min-width: 100%;
        }
        
        .mobile{
            display: none;
        }
        
        @media (max-width: 768px) {
            .desktop{
                display: none;
            }
            
            .mobile{
                display: block;
            }
            
        }
    </style>
</x-filament::page>
