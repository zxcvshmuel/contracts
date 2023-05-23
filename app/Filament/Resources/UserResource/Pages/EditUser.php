<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Package;
use App\Models\User;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {

        if ($data['change_package'] === true && isset($data['package_id']))
        {
            $user = User::find($this->record->id);
            $package = \App\Models\Package::find($data['package_id']);

            // delete old row on user_package pivot table
            $user->packages()->detach();

            // create row on user_package pivot table
            $user->packages()->attach($data['package_id'], [
                'started_at' => now(),
                'expired_at' => now()->addDays($package->duration),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // set active until
            $data['active_until'] = now()->addDays($package->duration);

            unset($data['package_id']);
            unset($data['change_package']);
        }

        return $data;
    }

    protected function getRedirectUrl():string
    {
        return $this->getResource()::getUrl('index');
    }
}
