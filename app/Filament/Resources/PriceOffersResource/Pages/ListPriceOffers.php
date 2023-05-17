<?php

namespace App\Filament\Resources\PriceOffersResource\Pages;

use App\Filament\Resources\PriceOffersResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPriceOffers extends ListRecords
{
  protected static string $resource = PriceOffersResource::class;

  protected function getActions(): array
  {
    return [
      Actions\CreateAction::make(),
    ];
  }
}
