<?php

namespace App\Filament\Resources\ContractsResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Models\Events;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateContracts extends CreateRecord
{
    protected static string $resource = ContractsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 2;
        $data['user_id'] = auth()->user()->id;
        if (!$data['customer_name']){
            $data['email'] = Events::find($data['event_id'])->customer->email;
            $data['customer_name'] = Events::find($data['event_id'])->customer->full_name;
        }

        return $data;
    }

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
}
