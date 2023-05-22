<?php

namespace App\Mail;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContractSent extends Mailable
{
    use Queueable, SerializesModels;

    protected ?string $email = '';
    /**
     * Create a new message instance.
     */
    public function __construct(public Contract $contract, $email)
    {
            $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {

            return new Envelope(
                from: 'my-safe@gmail.com',
                to: $this->email,
                cc:  User::find($this->contract->user_id)->comp_email ,
                subject: 'מסמך חדש מאת מערכת MY-SAFE',
            );

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contract.sent',
            with: [
                'url' => route('contract.view', $this->contract->id),
                'logo' => User::find(1)->logo_url,
            ],
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
