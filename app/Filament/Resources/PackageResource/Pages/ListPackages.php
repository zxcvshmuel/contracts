<?php

namespace App\Filament\Resources\PackageResource\Pages;

use App\Filament\Resources\PackageResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPackages extends ListRecords
{
    protected static string $resource = PackageResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }


    protected function getHeaderWidgets(): array
    {
        return [
            PackageResource\Widgets\packagesChart::class,
            PackageResource\Widgets\usersChart::class,
        ];
    }
}
