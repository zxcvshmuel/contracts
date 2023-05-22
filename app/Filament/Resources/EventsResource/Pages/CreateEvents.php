<?php

namespace App\Filament\Resources\EventsResource\Pages;

use App\Filament\Resources\EventsResource;
use App\helpers;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEvents extends CreateRecord {
    protected static string $resource = EventsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = auth()->user();
        if ($user->two_factor_secret !== null && $user->two_factor_secret !== '' )
        {
            $event = [
                'title' => $data['title'],
                'start' => $data['date'],
                'end'   => $data['end_at'],
            ];

            helpers::createEvent(auth()->user(), $event);
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
