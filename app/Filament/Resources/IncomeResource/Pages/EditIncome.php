<?php

namespace App\Filament\Resources\IncomeResource\Pages;

use App\Filament\Resources\IncomeResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditIncome extends EditRecord
{
    protected static string $resource = IncomeResource::class;

    protected function mutateFormDataBeforeFill($data): array
    {
        $data['category_id'] = [$data['category_id']];

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {

        $data['category_id'] = $data['category_id'][array_key_first($data['category_id'])];
        $record->update($data);

        return $record;
    }

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
}
