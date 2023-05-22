<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContractController extends Controller
{

    public function show(Contract $contract, Request $request){

        if (!$contract->opened)
        {
            $contract->opened = true;
            $contract-> open_at = date('Y-m-d H:i:s');
            $contract->save();
        }

        $data = [
            'system_data' => User::find(1),
            'contract' => $contract,
            'event' => $contract->events_id !== null ? $contract->event : null,
            'customer' => $contract->events_id !== null ? $contract->event->customer
                :  (object) [
                    'fullName' => $contract->customer_name,
                    'uid' => '',
                    'phone' => '',
                    'address' => $contract->email,
                    'city' => '',
                ],
            'user' => $contract->event->customer->user?? User::find($contract->user_id) ,
        ];

        /* $pdf = Pdf::loadView('contract.show', compact('data'));
         return $pdf->download('invoice.pdf');*/

        return view('contract.show', compact('data'));
    }

    public function update(Contract $contract, Request $request)
    {


        $request->validate(['data' => 'required']);
        $imageName = time().'id'.$contract->id.'.png';
        //$image = \Image::make($request->data);
        $image = explode(',', $request->data)[1];
        if ($contract->signed_url === null || Storage::disk('local')->put('public/signatures/'. $imageName, base64_decode($image)))
        {
            $contract->signe_data = $request;
            $contract->signed = true;
            $contract->signe_at = date('Y-m-d H:i:s');
            $contract->signed_url = $imageName;
            $contract->save();

            $status = 200;
            $response = $contract->signed_url;
        }else{
            $status = 200;
            $response = 'failed';
        }



        return response()->json([$response], $status);
    }

    public function uploadImage(Contract $contract, Request $request){
        /*$imageName = time().'id'.$contract->id.'.png';
        $image = explode(',', $request->data)[1];

        if ($contract->contract_url === null || Storage::disk('local')->put('public/contracts/'. $imageName, base64_decode($image)))
        {
            $contract->contract_url = $imageName;
            $contract->save();

            $status = 200;
            $response = Storage::url('/') . 'contracts/' . $imageName;
        }else{
            $status = 200;
            $response = 'failed';
        }
        return response()->json([$response], $status);*/

    }

}
