<?php

namespace App\Filament\Resources\FastContractResource\Pages;

use App\Filament\Resources\FastContractResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFastContracts extends ListRecords
{
    protected static string $resource = FastContractResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
