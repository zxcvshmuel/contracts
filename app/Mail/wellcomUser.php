<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class wellcomUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $userPassword;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $userPassword)
    {
        $this->user = $user;
        
        $this->userPassword = $userPassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'mysafe.events@gmail.com',
            to: [$this->user->email],
            subject: 'ברוכים הבאים למערכת MySafe',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.wellcomUser',
            with: [
                'user' => $this->user,
                'password'  => $this->userPassword,
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
