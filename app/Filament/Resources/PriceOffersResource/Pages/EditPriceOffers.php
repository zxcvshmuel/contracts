<?php

namespace App\Filament\Resources\PriceOffersResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\PriceOffersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPriceOffers extends EditRecord
{
  protected static string $resource = ContractsResource::class;

  protected function getActions(): array
  {
    return [
      Actions\DeleteAction::make(),
    ];
  }

  protected function getRedirectUrl():string
  {
    return  PriceOffersResource::getUrl('index');
  }
}
