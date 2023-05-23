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
        if (!isset($data['customer_name'])){
            $event = Events::find($data['events_id']);
            $data['email'] = $event->customer->email;
            $data['customer_name'] = $event->customer->full_name;
        }

        return $data;
    }

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
}
