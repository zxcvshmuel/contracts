<?php

namespace App\Filament\Resources\ContractsResource\Pages;

use App\Filament\Resources\ContractsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContracts extends ListRecords
{
    protected static string $resource = ContractsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
