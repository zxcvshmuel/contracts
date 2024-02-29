<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeToPackage extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $package;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $package)
    {
        $this->user = $user;
        $this->package = $package;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'mysafe.events@gmail.com',
            to: [$this->user->email],
            subject: 'תודה שרכשת את החבילה שלנו',

        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.welcomeToPackage',
            with: [
                'user' => $this->user,
                'package'  => $this->package,
                'logo' => User::find(1)->logo_url,
                'url' => 'my-safe.co.il/admin',
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
