<?php

namespace App\Mail;

use App\Models\Contract;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContractSigned extends Mailable
{
    use Queueable, SerializesModels;

    public $contract;
    public $user;

    public $title;

    /**
     * Create a new message instance.
     */
    public function __construct(Contract $contract, User $user)
    {
        $this->contract = $contract;
        $this->user     = $user;

        switch ($contract->type) {
            case '1':
                $this->title = 'הצעת מחיר';
                break;
            case '2':
                $this->title = 'חוזה';
                break;
            case '3':
                $this->title = 'מסמך לחתימה';
                break;
            case '4':
                $this->title = 'חוזה מהיר';
                break;
            case '5':
                $this->title = 'זכרון דברים לרכב';
                break;
            case '6':
                $this->title = 'זכרון דברים להשכרת דירה';
                break;
            case '7':
                $this->title = 'הזמנת עבודה';
                break;
            default:
                $this->title = 'מסמך';
                break;
        }

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: 'my-safe@gmail.com',
            to: $this->user->comp_email,
            subject: 'My-Safe - ' . $this->title . ': ' . $this->contract->id . ' נחתם'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contract-signed',
            with: [
                'user'  => $this->user,
                'contract' => $this->contract,
                'logo' => User::find(1)->logo_url,
                'url' => route('contract.view', $this->contract->id),
                'color' => 'success',
                'title' => $this->title,
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
