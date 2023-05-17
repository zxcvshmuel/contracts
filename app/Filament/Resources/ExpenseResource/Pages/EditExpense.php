<?php

namespace App\Filament\Resources\ExpenseResource\Pages;

use App\Filament\Resources\ExpenseResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditExpense extends EditRecord
{
    protected static string $resource = ExpenseResource::class;


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
