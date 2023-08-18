<?php

namespace App\Filament\Resources\PriceOffersResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\FastContractResource;
use App\Filament\Resources\PriceOffersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPriceOffers extends EditRecord {
    protected static string $resource = PriceOffersResource::class;

    protected static ?string $title = 'ערוך הצעת מחיר מהירה';


    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {

        if (is_array(json_decode($data['contracts_content'], true)))
        {
            $data['contracts_content'] = json_decode($data['contracts_content'], true);
            $data['customer_phone'] = $data['contracts_content']['customer_phone'];
            $data['customer_uid'] = $data['contracts_content']['customer_uid'];

            $data['contracts_content'] = $data['contracts_content']['contractImageURL'] ?? '';
        }

        return $data;
    }


    protected function getRedirectUrl(): string
    {
        return PriceOffersResource::getUrl('index');
    }
}
