<?php

namespace App\Filament\Resources\FastMemoryOfThingsCarResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\FastMemoryOfThingsCarResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFastMemoryOfThingsCar extends CreateRecord
{
    protected static string $resource = FastMemoryOfThingsCarResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type']    = 5;
        $data['user_id'] = auth()->user()->id;

        $memoryOfThingsCarContent = [
            'customer_name'                => $data['customer_name'] ?? '',
            'customer_uid'                 => $data['customer_uid'],
            'customer_phone'               => $data['customer_phone'],
            'customer_email'               => $data['email'] ?? '',
            'customer_address'             => $data['address'] ?? '',
            'location'                     => $data['location'] ?? '',
            'car_brand'                    => $data['car_brand'] ?? '',
            'car_model'                    => $data['car_model'] ?? '',
            'car_year'                     => $data['car_year'] ?? '',
            'car_color'                    => $data['car_color'] ?? '',
            'car_number'                   => $data['car_number'] ?? '',
            'oner_number'                  => $data['owner_number'] ?? '',
            'was_in_rental_company'        => $data['was_in_rental_company'] ?? '',
            'was_in_accident'              => $data['was_in_accident'] ?? '',
            'car_price'                    => $data['car_price'] ?? '',
            'more_info'                    => $data['more_info'] ?? '',
            'car_distance'                 => $data['car_distance'] ?? '',
            'car_license_number' => $data['car_license_number'] ?? '',

        ];

        $data['contracts_content'] = json_encode([
            'contracts_content'            => $data['contracts_content'] ?? '',
            'customer_uid'                 => $data['customer_uid'],
            'customer_phone'               => $data['customer_phone'],
            'memory_of_things_car_content' => $memoryOfThingsCarContent,
        ]);

        self::$resource = ContractsResource::class;

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return FastMemoryOfThingsCarResource::getUrl('index');
    }
}
