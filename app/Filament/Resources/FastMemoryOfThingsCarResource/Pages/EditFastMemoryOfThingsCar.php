<?php

namespace App\Filament\Resources\FastMemoryOfThingsCarResource\Pages;

use App\Filament\Resources\FastMemoryOfThingsCarResource;
use Filament\Resources\Pages\EditRecord;

class EditFastMemoryOfThingsCar extends EditRecord
{
    protected static string $resource = FastMemoryOfThingsCarResource::class;

    protected static ?string $slug = 'fast-contract';

    protected function mutateFormDataBeforeFill(array $data): array
    {

        if (is_array(json_decode($data['contracts_content'], true))) {

            foreach (json_decode($data['contracts_content'], true) as $key => $value) {
                $data[$key] = $value ?? '';
            }

            foreach($data['memory_of_things_car_content'] as $key => $value) {
                $data[$key] = $value ?? '';
            }

            $data['address'] = $data['customer_address'] ?? '';
            $data['owner_number'] = $data['oner_number'] ?? '';


        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return FastMemoryOfThingsCarResource::getUrl('index');
    }
}
