<?php

namespace App\Filament\Resources\PriceOffersResource\Pages;

use App\Filament\Resources\ContractsResource;
use App\Filament\Resources\DocumentsResource;
use App\Filament\Resources\PriceOffersResource;
use App\Models\Events;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePriceOffers extends CreateRecord
{

    protected static string $resource = PriceOffersResource::class;
  protected function mutateFormDataBeforeCreate(array $data): array
  {
    $data['type'] = 1;
    $data['user_id'] = auth()->user()->id;
    if (!$data['customer_name']){
      $data['email'] = Events::find($data['event_id'])->customer->email;
      $data['customer_name'] = Events::find($data['event_id'])->customer->full_name;
    }else{
        $data['contracts_content'] = json_encode([
            'contracts_content' => $data['contracts_content'] ?? '',
            'customer_uid' => $data['customer_uid'],
            'customer_phone' => $data['customer_phone'],
        ]);
    }

      self::$resource = ContractsResource::class;

    return $data;
  }


    protected function mutateFormDataBeforeFill(array $data): array
    {

        if ($data['event_id'])
        {
            $data['customer_name'] = Events::find($data['event_id'])->customer->full_name;
        }

        $data['contracts_content'] = $data['contracts_content']['contracts_content'] ?? '';

        self::$resource = ContractsResource::class;

        return $data;
    }

  protected function getRedirectUrl():string
  {
    return  PriceOffersResource::getUrl('index');
  }
}
