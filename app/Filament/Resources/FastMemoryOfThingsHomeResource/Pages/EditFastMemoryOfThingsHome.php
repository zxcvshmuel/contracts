<?php

namespace App\Filament\Resources\FastMemoryOfThingsHomeResource\Pages;

use App\Filament\Resources\FastMemoryOfThingsHomeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFastMemoryOfThingsHome extends EditRecord
{
    protected static string $resource = FastMemoryOfThingsHomeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

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
        return FastMemoryOfThingsHomeResource::getUrl('index');
    }
}
