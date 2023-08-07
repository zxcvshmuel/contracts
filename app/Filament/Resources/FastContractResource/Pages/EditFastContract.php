<?php

namespace App\Filament\Resources\FastContractResource\Pages;

use App\Filament\Resources\FastContractResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFastContract extends EditRecord
{
    protected static string $resource = FastContractResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl():string
    {
        return  FastContractResource::getUrl('index');
    }
}
