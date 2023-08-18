<?php

namespace App\Filament\Resources\FastContractResource\Pages;

use App\Filament\Resources\FastContractResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListFastContracts extends ListRecords
{
    protected static string $resource = FastContractResource::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->user()->id)
            ->where('events_id', '!=', null)
            ->where('type', 1)->orWhere('type', 2);

    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
