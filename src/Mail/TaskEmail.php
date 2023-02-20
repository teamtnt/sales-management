<?php

namespace Teamtnt\SalesManagement\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Teamtnt\SalesManagement\Models\Message;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;

class TaskEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Teamtnt\SalesManagement\Models\Message
     */
    public $message;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function envelope()
    {
        return new Envelope(
            from: new Address('nticaric@gmail.com', 'Nenad Ticaric'),
            subject: 'Neki testni subjekt',
            metadata: [
                'lead_id' => 13223,
            ],
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'sales-management::emails.taskmessage',
        );
    }
}
