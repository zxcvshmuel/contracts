<?php

namespace App\Filament\Resources\PriceOffersResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\PriceOffersResource;
use App\Models\Events;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePriceOffers extends CreateRecord
{
  protected function mutateFormDataBeforeCreate(array $data): array
  {
    $data['type'] = 1;
    $data['user_id'] = auth()->user()->id;
    if (!$data['customer_name']){
      $data['email'] = Events::find($data['event_id'])->customer->email;
      $data['customer_name'] = Events::find($data['event_id'])->customer->full_name;
    }

    self::$resource = ContractsResource::class;

    return $data;
  }

  protected static string $resource = PriceOffersResource::class;


  protected function getRedirectUrl():string
  {
    return  PriceOffersResource::getUrl('index');
  }
}
