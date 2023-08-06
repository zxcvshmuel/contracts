<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    use HasFactory;


    protected $table = 'payments';


    protected $fillable = [
        'user_id',
        'package_id',
        'action',
        'info',
        'heshDesc',
        'amount',
        'payment_status',
        'payment_method',
        'transaction_id',
        'payment_date',
        'request',
        'response',
        'transaction_code',
        'transaction_status',
    ];


    // const for payment_status
    public const STATUS_INITIAL = 'initial';
    public const STATUS_SENT = 'sent';
    public const STATUS_PENDING = 'pending';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_FAILED = 'failed';


    // const for payment_method
    public const METHOD_CREDIT_CARD = 'credit_card';
    public const METHOD_PAYPAL = 'paypal';


    // const for payment_method_url
    public const METHOD_CREDIT_CARD_url = 'https://icom.yaad.net/p/?';
    public const METHOD_PAYPAL_url = 'https://www.paypal.com/';


    // const for masof
    public const MASOF_YAAD = '5602733528';
    public const MASOF_PAYPAL = '';

    // const for payment api key
    public const YAAD_API_KEY = '68c9c94b6d6ef71488a86c044ddbd6b114d7a6dd';
    public const PAYPAL_API_KEY = '';


    // const for payment action
    public const ACTION_PAY = 'pay';


    // array of all credit parameters
    public array $creditParamenters = [
        'action'          => '',
        'Amount'          => 0,
        'ClientLName'     => '',
        'ClientName'      => '',
        'Coin'            => 1,
        'FixTash'         => false,
        'Info'            => '',
        'J5'              => false,
        'Masof'           => '',
        'MoreData'        => true,
        'Order'           => 0,
        'PageLang'        => 'HEB',
        'Postpone'        => false,
        'Pritim'          => true,
        'SendHesh'        => true,
        'ShowEngTashText' => false,
        'Sign'            => true,
        'Tash'            => 1,
        'UTF8'            => true,
        'UTF8out'         => true,
        'UserId'          => '',
        'cell'            => '',
        'city'            => '',
        'email'           => '',
        'heshDesc'        => '[פריט ראשון][פריט שני]',
        'phone'           => '',
        'sendemail'       => '',
        'street'          => '',
        'tmp'             => 1,
        'zip'             => '',
        'signature'       => '',
    ];


    // function to create payment
    public static function createPayment($user, $package, $action, $paymentMethod)
    {
        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->package_id = $package->id;
        $payment->amount = $package->price;
        $payment->action = $action;
        $payment->info = $package->name;
        $payment->heshDesc = $package->name.' '.$package->price;
        $payment->payment_status = self::STATUS_INITIAL;
        $payment->payment_method = $paymentMethod;

        $payment->save();

        return $payment;
    }


    // function to prepare payment for sending and to return array of parameters that required for sending
    public function preparePaymentForSending(
        $action,
        $amount,
        $clientName,
        $order,
        $userId,
        $cell,
        $city,
        $email,
        $sendEmail,
        $masof,
        $signature,
        $pritim,
        $info
    ): array {
        $creditParameters = $this->creditParamenters;
        $creditParameters['action'] = $action;
        $creditParameters['Amount'] = $amount;
        $creditParameters['ClientName'] = $clientName;
        $creditParameters['Order'] = $order;
        $creditParameters['UserId'] = $userId;
        $creditParameters['cell'] = $cell;
        $creditParameters['city'] = $city;
        $creditParameters['email'] = $email;
        $creditParameters['sendemail'] = $sendEmail;
        $creditParameters['Masof'] = $masof;
        $creditParameters['signature'] = $signature;
        $creditParameters['Pritim'] = $pritim;
        $creditParameters['Info'] = $info;

        return $creditParameters;
    }


    // function to send payment
    public function sendPayment($url, $payment, $creditParameters)
    {
        $url = $url.http_build_query($creditParameters);
        $response = file_get_contents($url);
        $response = json_decode($response, true);

        if ($response['status'] == 'success')
        {
            $payment = self::updatePayment($payment, $response['transactionId'], self::STATUS_SENT, now());
        } else
        {
            $payment = self::updatePayment($payment, $response['transactionId'], self::STATUS_FAILED, now());
        }

        return $payment;
    }

    // function to update payment
    public function updatePayment($payment, $transactionId, $paymentStatus, $paymentDate)
    {
        $payment->transaction_id = $transactionId;
        $payment->payment_status = $paymentStatus;
        $payment->payment_date = $paymentDate;
        $payment->save();

        return $payment;
    }

    // function to get url for payment
    public function getUrl(Payment $payment, $type, array $creditParameters)
    {
        if ($type == self::METHOD_CREDIT_CARD)
        {
            $url = self::METHOD_CREDIT_CARD_url.http_build_query($creditParameters);
        } else
        {
            $url = self::METHOD_PAYPAL_url;
        }

        $payment->request = $url;
        $payment->save();

        return $url;
    }


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

public function package(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Package::class);
    }


}
