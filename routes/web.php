<?php

use App\helpers;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ReminderController;
use App\Mail\ContractSend;
use App\Mail\ContractSent;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// allow admin user to login as user
Route::get('login-as/{user}', function ($user) {
    // just user that id is 1 can login as other user
    if (Auth::user()->id != 1)
    {
        return redirect()->route('home');
    }
    Auth::loginUsingId($user);

    return redirect()->route('filament.auth.login');
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
    helpers::googleCodeCallback($user, $request);

    return redirect()->route('filament.pages.dashboard');
})->name('oauth2callback');

// google calendar send to oauth2
Route::get('/google/oauth2', function () {
    if ($user = auth()->user())
    {
        return redirect(helpers::getGoogleToken($user));
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
    // artisan command to create storage link
//     \Artisan::call('storage:link');
//     \Artisan::call('cache:clear');
//     \Artisan::call('route:cache');
//     \Artisan::call('route:clear');
//     \Artisan::call('config:cache');
//     \Artisan::call('config:clear');
//     \Artisan::call('optimize --force');

    try
    {
        shell_exec('composer require stephenjude/filament-debugger');
    } catch (Exception $e)
    {
        dd($e->getMessage());
    }



    return view('components.layouts.welcome');
});

Route::get('/contract/{id}/pdf', function ($id) {
    $contract = \App\Models\Contract::find($id);
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
    $pdf = \Mccarlosen\LaravelMpdf\Facades\LaravelMpdf::loadView('contract.showToPdf', ['data' => $data]);

    return $pdf->download('contract.pdf');
});
