<?php

namespace App\Filament\Pages;

use App\Models\Package;
use Filament\Forms\Components\Card;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Tables\Columns\TextInputColumn;

class PackagesPage extends Page
{
    public array $data;
    public array $dataToPay;

    public bool $popup = false;



    protected $listeners = ['$showPayModal', 'packageClick' => 'packageClick'];

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.packages-page';

    protected ?string $heading = 'החבילות שלנו';


    public function mount(): void
    {
        $this->data['packages'] = Package::all()->where('status', 1)->where('price', '>', 0);
        $this->dataToPay = Package::find(1)->toArray();
    }

    public function packageClick($id): void
    {
        $this->data['packages'] = Package::all()->where('status', 1)->where('price', '>', 0);
        $this->dataToPay = Package::find($id)->toArray();

        $this->popup = true;
    }

    public function redirectToPay($id): void
    {
        $package = Package::find($id);
        $user = auth()->user();

        $params = [
            'action' => 'pay',
            'Amount' => $package->price,
            'ClientLName' => $user->name,
            'ClientName' => $user->name,
            'Coin' => 1,
            'FixTash' => false,
            'Info' => 'test-api',
            'J5' => false,
            'Masof' => '0010188625',
            'MoreData' => true,
            'Order' => '1',
            'PageLang' => 'HEB',
            'Postpone' => false,
            'Pritim' => true,
            'SendHesh' => true,
            'ShowEngTashText' => false,
            'Sign' => true,
            'Tash' => 2,
            'UTF8' => true,
            'UTF8out' => true,
            'UserId' => $user->id,
            'cell' => $user->phone,
            'city' => $user->comp_address,
            'email' => $user->email,
            'heshDesc' => '[0~Item 1~1~8][0~Item 2~2~1]',
            'phone' => $user->phone,
            'sendemail' => true,
            'street' => 'levanon 3',
            'tmp' => 1,
            'zip' => '42361',
            'signature' => 'b6589fc6ab0dc82cf12099d1c2d40ab994e8410c'
        ];


        $url = 'https://icom.yaad.net/p/?' . http_build_query($params);


        $this->redirect($url);
    }


}
