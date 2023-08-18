<?php

namespace App\Filament\Resources\FastContractResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\FastContractResource;
use App\Models\Events;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFastContract extends CreateRecord
{
    protected static string $resource = FastContractResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 4;
        $data['user_id'] = auth()->user()->id;

        $data['contracts_content'] = json_encode([
            'contracts_content' => $data['contracts_content'] ?? '',
            'customer_uid' => $data['customer_uid'],
            'customer_phone' => $data['customer_phone'],
        ]);

        self::$resource = ContractsResource::class;

        return $data;
    }

    protected function getRedirectUrl():string
    {
        return  FastContractResource::getUrl('index');
    }
}
