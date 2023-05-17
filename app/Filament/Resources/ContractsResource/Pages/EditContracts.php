<?php

namespace App\Filament\Resources\ContractsResource\Pages;

use App\Filament\Resources\ContractsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditContracts extends EditRecord
{
    protected static string $resource = ContractsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
}
