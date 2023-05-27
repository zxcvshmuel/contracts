<?php

namespace App\Filament\Pages;

use App\Models\Package;
use Filament\Pages\Page;
use Illuminate\Contracts\View\View;

class PackagesPage extends Page
{
    public array $data;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.packages-page';

    protected ?string $heading = 'החבילות שלנו';


    public function mount()
    {
        $this->data['packages'] = Package::all();
    }

    public function packageClick($id)
    {
        $this->data['package'] = Package::find($id);

        dd($this->data['package']);
    }

}
