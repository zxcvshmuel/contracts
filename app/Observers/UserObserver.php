<?php

namespace App\Observers;

use App\Mail\WelcomeToPackage;
use App\Models\User;
use App\Models\Category;
use App\Mail\wellcomUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // $token = Password::getRepository()->create($user);
        // $user->sendPasswordResetNotification($token);

        // create random password
        $userPassword = '12345';
        $user->password = bcrypt($userPassword);
        $user->save();

        $user->packages()->attach(1, [
            'started_at' => now(),
            'expired_at' => now()->addDays(7),
        ]);


        // send email to user
        Mail::to($user->email)->send(new wellcomUser($user, $userPassword));



        // send email to admin

        $to = "mysafe.events@gmail.com";
        $subject = "משתמש חדש שלח פרטים למערכת";
        $txt = `<p>משתמש חדש שלח פרטים למערכת</p>
          <p>שם: $user->name</p>
          <p>מייל: $user->email</p>
          <p>טלפון: $user->phone</p>`;
        $headers = "From: mysafe.events@gmail.com" . "\r\n";

        mail($to,$subject,$txt,$headers);



        // copy categories from user 1 categories to new user
        $user1 = User::find(1); // Retrieve the user
        $baseCategories = $user1->categories; // Retrieve the base categories

        foreach ($baseCategories as $category) {
            $newCategory = [
                'user_id' => $user->id,
                'name' => $category->name,
                'is_active' => $category->is_active,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
                'income' => $category->income,
            ];

            $user->categories()->create($newCategory);
        }
    }



    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $changes = $user->getChanges();
        if (isset($changes[ 'active_until'])) {
            // get package name
            $package = $user->packages()->first();
            Mail::to($user->email)->send(new WelcomeToPackage($user, $package));
            };
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        $user->email = $user->email . '_deleted' . now()->timestamp;
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
