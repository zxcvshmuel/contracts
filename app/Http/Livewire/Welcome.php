<?php

namespace App\Http\Livewire;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Welcome extends Component
{

    public $title = 'home';

    public $name;
    public $email;
    public $phone;
    public $formSubmitted = false;
    public $formTitle;

    public function registerUser()
    {
        $validateData = $this->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
        ], [
            'name.required'  => 'חובה להזין שם פרטי',
            'email.unique' => 'כתובת הדוא"ל כבר קיימת במערכת',
            'email.required' => 'חובה להזין כתובת דוא"ל',
            'phone.required' => 'חובה להזין מספר טלפון',
        ], [
            'name'  => 'שם פרטי',
            'email' => 'דוא"ל',
            'phone' => 'טלפון',
        ]);

        $validateData['password'] = bcrypt('12345678');
        $validateData['active_until'] = now()->addDays(50);


        $user = User::create($validateData);

        $this->formSubmitted = true;
    }

    public function hideModal()
    {
        $this->formSubmitted = false;
        return redirect('/admin');
    }

    public function render()
    {
        return view('livewire.welcome-form');
    }
}
