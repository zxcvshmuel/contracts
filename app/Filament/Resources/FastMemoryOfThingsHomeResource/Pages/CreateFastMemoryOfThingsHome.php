<?php

namespace App\Filament\Resources\FastMemoryOfThingsHomeResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\FastMemoryOfThingsHomeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFastMemoryOfThingsHome extends CreateRecord
{
    protected static string $resource = FastMemoryOfThingsHomeResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type']    = 6;
        $data['user_id'] = auth()->user()->id;

        $memoryOfThingsCarContent = [
            'customer_name'                  => $data['customer_name'] ?? '',
            'customer_uid'                   => $data['customer_uid'],
            'customer_phone'                 => $data['customer_phone'],
            'customer_email'                 => $data['email'] ?? '',
            'customer_address'               => $data['address'] ?? '',
            'rented_appartment_city'         => $data['rented_appartment_city'] ?? '',
            'rented_appartment_street'       => $data['rented_appartment_street'] ?? '',
            'rented_appartment_floor'        => $data['rented_appartment_floor'] ?? '',
            'rented_appartment_num'          => $data['rented_appartment_num'] ?? '',
            'enterens_num'                   => $data['enterens_num'] ?? '',
            'rented_appartment_price'        => $data['rented_appartment_price'] ?? '',
            'rented_appartment_rooms'        => $data['rented_appartment_rooms'] ?? '',
            'rented_appartment_to_be_signed' => $data['rented_appartment_to_be_signed'] ?? '',

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
        return FastMemoryOfThingsHomeResource::getUrl('index');
    }

}
