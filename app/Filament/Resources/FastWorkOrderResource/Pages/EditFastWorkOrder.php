<?php

namespace App\Filament\Resources\FastWorkOrderResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\FastWorkOrderResource;
use App\Models\Contract;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFastWorkOrder extends EditRecord
{
    protected static string $resource = FastWorkOrderResource::class;

    protected static ?string $slug = 'fast-contract';



    protected function mutateFormDataBeforeFill(array $data): array
    {
        if (is_array(json_decode($data['contracts_content'], true)))
        {
            $data['contracts_content'] = json_decode($data['contracts_content'], true);
            $data['customer_phone'] = $data['contracts_content']['customer_phone'];
            $data['customer_uid'] = $data['contracts_content']['customer_uid'];
            $data['contracts_content'] = $data['contracts_content']['contracts_content'] ?? '';
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
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
