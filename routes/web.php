<?php

use App\helpers;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ReminderController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/test', function () {
    $categories = \App\Models\Category::all()->toArray();
    $user = User::find(1);
    dd($user->categories);
});*/

Route::get('/privacy', function () {
    return view('components.layouts.privacy');
});

Route::get('/terms', function () {
    return view('components.layouts.term');
});

// allow admin user to login as user
Route::get('login-as/{user_id}', function ($user_id) {
    // just user that id is 1 can login as other user
    if (Auth::user()->id !== 1)
    {
        return redirect()->route('filament.pages.dashboard');
    }
    $user = User::find((integer)$user_id);
    session()->flush();
    Auth::guard('web')->login($user);

    return redirect()->route('filament.pages.dashboard');
})->middleware('auth');

Route::get('contract/{contract}/view/', [ContractController::class, 'show'])->name('contract.view');
Route::Post('contract/{contract}/update/', [ContractController::class, 'update'])->name('contract.update');
Route::Post('contract/{contract}/uploadImage/', [ContractController::class, 'uploadImage'])->name(
    'contract.uploadImage'
);
Route::resource('reminder', ReminderController::class);


// google calendar
// google calendar callback oauth2callback
Route::get('/oauth2callback', function (Request $request) {
    $user = \App\Models\User::find(Session::get('user'));
    Helpers::googleCodeCallback($user, $request);

    return redirect()->route('filament.pages.dashboard');
})->name('oauth2callback');

// google calendar send to oauth2
Route::get('/google/oauth2', function () {
    if ($user = auth()->user())
    {
        return redirect(Helpers::getGoogleToken($user));
    } else
    {
        return redirect()->route('filament.pages.dashboard');
    }
})->name('google.oauth2');


Route::get('storage/logos/{filename}', function ($filename) {
    $path = storage_path('public/'.$filename);

    if (File::exists($path))
    {
        dd([
            base_path('/'),
            Storage::disk('local')->exists($filename),
            File::exists($path),
            $path,
            \Illuminate\Support\Facades\Storage::url('logos/').$filename,
            File::exists(
                \Illuminate\Support\Facades\Storage::url('logos/').$filename
            ),
        ]);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('change-color/{color}', function ($color) {
    if ($user = Auth::user())
    {
        $user->color = $color;
        $user->save();

        return response()->json(['success' => true]);
    } else
    {
        return response()->json(['success' => false]);
    }
});

Route::get('/', function () {

    return view('components.layouts.welcome');
});

Route::get('/contract/{id}/pdf', function ($id) {
    $contract = \App\Models\Contract::find($id);
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


    $pdf = \Mccarlosen\LaravelMpdf\Facades\LaravelMpdf::loadView('contract.showToPdf', ['data' => $data]);

    return $pdf->download('contract.pdf');
});

Route::get('/paymentCallBack', function () {
    $data = request()->all();
    $payment = \App\Models\Payment::find($data['Order']);
    $payment->response = json_encode($data);
    $payment->transaction_id = $data['ACode'];
    $payment->transaction_code = $data['CCode'];
    $payment->payment_status = Payment::STATUS_COMPLETED;
    $payment->save();

    return redirect()->route('filament.pages.dashboard');
})->name('paymentCallBack');

