<?php

namespace App\Filament\Resources\FastMemoryOfThingsCarResource\Pages;

use App\Filament\Resources\FastMemoryOfThingsCarResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListFastMemoryOfThingsCar extends ListRecords
{
    protected static string $resource = FastMemoryOfThingsCarResource::class;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->user()->id)
            ->where('events_id', '!=', null)
            ->where('type', 5);

    }

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
