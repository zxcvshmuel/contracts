<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;


    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $user = User::find($this->record->id);
        $package = \App\Models\Package::find($data['package_id']);

        // create row on user_package pivot table
        $user->packages()->attach($package->id, [
            'started_at' => now(),
            'expired_at' => now()->addDays($package->duration),
        ]);

        // set active until
        $data['active_until'] = now()->addDays($package->duration);

        // remove package_id from data
        unset($data['package_id']);
        unset($data['change_package']);
        return $data;
    }
}
