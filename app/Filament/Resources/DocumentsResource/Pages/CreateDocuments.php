<?php

namespace App\Filament\Resources\DocumentsResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\DocumentsResource;
use App\Models\Events;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDocuments extends CreateRecord
{
    protected static string $resource = DocumentsResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['type'] = 3;
        $data['user_id'] = auth()->user()->id;
        if (!$data['customer_name']){
            $data['email'] = Events::find($data['event_id'])->customer->email;
            $data['customer_name'] = Events::find($data['event_id'])->customer->full_name;
        }

        $data['contracts_content'] = json_encode([
            'contractImageURL' => $data['contracts_content'],
            'customer_uid' => $data['customer_uid'],
            'customer_phone' => $data['customer_phone'],
        ]);

        self::$resource = ContractsResource::class;

        return $data;
    }


    protected function getRedirectUrl():string
    {
        return  DocumentsResource::getUrl('index');
    }
}
