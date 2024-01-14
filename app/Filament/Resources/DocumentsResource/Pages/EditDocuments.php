<?php

namespace App\Filament\Resources\DocumentsResource\Pages;

use App\Filament\Resources\DocumentsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDocuments extends EditRecord
{
    protected static string $resource = DocumentsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['contracts_content'] = json_decode($data['contracts_content'], true);
        $data['customer_phone'] = $data['contracts_content']['customer_phone'];
        $data['customer_uid'] = $data['contracts_content']['customer_uid'];

        $data['contracts_content'] = $data['contracts_content']['contractImageURL'] ?? '';
        return $data;
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['contracts_content'] = json_encode([
            'contractImageURL' => $data['contracts_content'],
            'customer_uid' => $data['customer_uid'],
            'customer_phone' => $data['customer_phone'],
        ]);

        return $data;
    }

    protected function getRedirectUrl():string
    {
        return  DocumentsResource::getUrl('index');
    }
}
