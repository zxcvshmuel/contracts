<?php

namespace App\Filament\Resources\FastWorkOrderResource\Pages;

use App\Models\Events;
use App\Models\Contract;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\FastWorkOrderResource;

class CreateFastWorkOrder extends CreateRecord
{
    protected static string $resource = FastWorkOrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = Contract::TYPE['WORK_ORDER'];
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
        return  FastWorkOrderResource::getUrl('index');
    }
}
