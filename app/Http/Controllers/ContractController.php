<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Imagick;
use Mpdf\Mpdf;
use Spatie\PdfToImage\Pdf;

class ContractController extends Controller {

    public function show(Contract $contract, Request $request)
    {

        if (!$contract->opened)
        {
            $contract->opened = true;
            $contract->open_at = date('Y-m-d H:i:s');
            $contract->save();
        }

        $data = [
            'system_data' => User::find(1),
            'contract'    => $contract,
            'event'       => $contract->events_id !== null ? $contract->event : null,
            'customer'    => $contract->event->customer ?? (object)[
                    'fullName' => $contract->customer_name,
                    'uid'      => '',
                    'phone'    => '',
                    'address'  => $contract->email,
                    'city'     => '',
                ],
            'user'        => $contract->event->customer->user ?? User::find($contract->user_id),
        ];

        if (($data['contract']->type === 3 || $data['contract']->type === 4 || $data['contract']->type === 1) && is_array(
                json_decode($data['contract']->contracts_content, true)
            ))
        {
            $data['contract']->contracts_content = json_decode($data['contract']->contracts_content, true);
            $data['customer']->uid = $data['contract']->contracts_content['customer_uid'];
            $data['customer']->phone = $data['contract']->contracts_content['customer_phone'];
            if ($data['contract']->type === 3)
            {
                $data['pathToImage'] = $data['contract']->contracts_content['contractImageURL'];
                $data['contract']->contracts_content = $data['contract']->contracts_content['contractImageURL'];

            } else
            {
                $data['contract']->contracts_content = $data['contract']->contracts_content['contracts_content'];
            }


        }elseif ($data['contract']->type === 3)
        {
            $data['pathToImage'] = $data['contract']->contracts_content;
        }

        $height = 0;

        $pdfPath = Storage::path('/').$data['contract']->contracts_content;
        // check if the file is pdf
        if (pathinfo($pdfPath, PATHINFO_EXTENSION) === 'pdf')
        {
            $pdf = new Pdf($pdfPath);
            $numberOfPages = $pdf->getNumberOfPages();
            $pathToImage = time().'id'.$contract->id;
            if (!mkdir(Storage::path('/pdf/').$pathToImage, 0777, true) && !is_dir($pathToImage))
            {
                throw new \RuntimeException(sprintf('Directory "%s" was not created', $pathToImage));
            }
            $pdf->saveAllPagesAsImages(Storage::path('/pdf/').$pathToImage);
            $data['contract']->contracts_content = 'pdf/'.$pathToImage.'/1.jpg';
            $data['numberOfPages'] = $numberOfPages;
            $data['pathToImage'] = 'pdf/'.$pathToImage;
            $height = 1;
        }


        $data['height'] = $height * 2.28;


        return view('contract.show', compact('data'));
    }

    public function update(Contract $contract, Request $request)
    {

        $request->validate(['data' => 'required']);
        $imageName = time().'id'.$contract->id.'.png';
        //$image = \Image::make($request->data);
        $image = explode(',', $request->data)[1];
        if ($contract->signed_url === null || Storage::disk('local')->put(
                'public/signatures/'.$imageName,
                base64_decode($image)
            ))
        {
            $contract->signe_data = $request;
            $contract->signed = true;
            $contract->signe_at = date('Y-m-d H:i:s');
            $contract->signed_url = $imageName;
            $contract->save();

            $status = 200;
            $response = $contract->signed_url;
        } else
        {
            $status = 200;
            $response = 'failed';
        }


        return response()->json([$response], $status);
    }

    public function uploadImage(Contract $contract, Request $request)
    {
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
