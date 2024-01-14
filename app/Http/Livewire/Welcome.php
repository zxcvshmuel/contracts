<?php

namespace App\Http\Livewire;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Exception;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class Welcome extends Component {

    public $title = 'home';
    public $name;
    public $email;
    public $phone;
    public $formSubmitted = false;
    public $formTitle;

    public function submit()
    {
        $this->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        try
        {
            $user = User::create([
                'name'         => $this->name,
                'email'        => $this->email,
                'phone'        => $this->phone,
                'active_until' => now()->addDays(7),
                'password'     => bcrypt('123456'),
            ]);
            $user->packages()->attach(1, [
                'started_at' => now(),
                'expired_at' => now()->addDays(7),
            ]);
            $this->formSubmitted = true;
            $this->formTitle = 'תודה רבה, נחזור אליכם בהקדם';

            Mail::to('mysafe.events@gmail.com')->send(new WelcomeEmail($user));




        } catch (Exception $e)
        {
            $this->formSubmitted = false;
            $this->formTitle = 'אירעה שגיאה, אנא נסו שנית';
        }

    }

    public function render()
    {
        return view('livewire.welcome-form');
    }
}
