<?php

namespace App\Filament\Resources\FastMemoryOfThingsHomeResource\Pages;

use App\Filament\Resources\FastMemoryOfThingsHomeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFastMemoryOfThingsHomes extends ListRecords
{
    protected static string $resource = FastMemoryOfThingsHomeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
