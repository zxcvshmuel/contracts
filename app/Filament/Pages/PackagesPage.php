<?php

namespace App\Filament\Pages;

use App\Models\Package;
use App\Models\Payment;
use Filament\Forms\Components\Card;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Tables\Columns\TextInputColumn;

class PackagesPage extends Page {
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
        $this->popup = false;
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

        $payment = Payment::createPayment($user, $package, Payment::ACTION_PAY, Payment::METHOD_CREDIT_CARD);

        $creditParameters = $payment->preparePaymentForSending(
            Payment::ACTION_PAY,
            $package->price,
            $user->name,
            $payment->id,
            $user->id,
            $user->phone,
            $user->comp_address,
            $user->email,
            '1',
            Payment::MASOF_YAAD,
            Payment::YAAD_API_KEY,
            false,
            $package->name
        );

        $this->redirect($payment->getUrl($payment, Payment::METHOD_CREDIT_CARD, $creditParameters));
    }


}
