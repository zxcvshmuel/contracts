<?php

namespace App\Filament\Resources\DocumentsResource\Pages;

use App\Filament\Resources\DocumentsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
