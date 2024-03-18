<?php

namespace App\Filament\Resources\FastWorkOrderResource\Pages;

use App\Filament\Resources\FastWorkOrderResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListFastWorkOrders extends ListRecords
{
    protected static string $resource = FastWorkOrderResource::class;

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
