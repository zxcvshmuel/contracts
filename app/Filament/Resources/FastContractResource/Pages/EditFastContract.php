<?php

namespace App\Filament\Resources\FastContractResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\FastContractResource;
use App\Models\Contract;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFastContract extends EditRecord
{
    protected static string $resource = FastContractResource::class;

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

    protected function getRedirectUrl():string
    {
        return  FastContractResource::getUrl('index');
    }
}
