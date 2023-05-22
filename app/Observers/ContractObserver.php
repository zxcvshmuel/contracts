<?php

namespace App\Observers;

use App\Helpers;
use App\Mail\ContractSent;
use App\Models\Contract;
use App\Models\Events;
use http\Message;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContractObserver
{
    /**
     * Handle the Contract "created" event.
     */
    public function created(Contract $contract): void
    {

    if ($contract->customer_name == null)
    {
      $event = Events::find($contract->events_id);
      $contract->update([
        'user_id'       => auth()->user()->id,
        'customer_name' => $event->customer->full_name,
        'email'         => $event->customer->email,
      ]);
    }

        Mail::to($contract->email)->send(new ContractSent($contract, $contract->email));

        $contract->sent = true;
        $contract->sent_at = date('Y-m-d H:i:s');
        $contract->signed_url = route('contract.view', $contract->id);
        $contract->save();

    }

    /**
     * Handle the Contract "updated" event.
     */
    public function updated(Contract $contract): void
    {
        /*$user = $contract->event->user;
        if ($contract->signed === true && $user()->two_factor_secret !== null)
        {
            $events = $contract->event;
            $data = [
                'title' => $events['title'],
                'start' => $events['date'],
                'end' => $events['end_at'],
            ];

            if ($user->two_factor_secrete !== null)
            {
                Helpers::createEvent($user, $data);
            }
        }*/
    }

    /**
     * Handle the Contract "deleted" event.
     */
    public function deleted(Contract $contract): void
    {
        //
    }

    /**
     * Handle the Contract "restored" event.
     */
    public function restored(Contract $contract): void
    {
        //
    }

    /**
     * Handle the Contract "force deleted" event.
     */
    public function forceDeleted(Contract $contract): void
    {
        //
    }
}
