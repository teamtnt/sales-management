<?php

namespace Teamtnt\SalesManagement\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Teamtnt\SalesManagement\Models\Message;
use Teamtnt\SalesManagement\Models\Lead;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Contracts\Queue\ShouldQueue;

class CampaignEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var Teamtnt\SalesManagement\Models\Message
     */
    public $message;
    public $lead;

    /**
     * Create a new message instance.
     *
     * @param  \Teamtnt\SalesManagement\Models\Message  $message
     * @param  \Teamtnt\SalesManagement\Models\Lead  $lead
     * @return void
     */
    public function __construct(Message $message, Lead $lead)
    {
        $this->message = $message;
        $this->lead = $lead;
    }

    public function envelope()
    {
        return new Envelope(
            from: new Address($this->message->from_email, $this->message->from_name),
            subject: $this->message->subject,
            metadata: [
                'lead_id' => $this->lead->id,
                'campaign_id' => $this->lead->campaign_id,
                'message_id' => $this->message->id,
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
        $this->message->body = str_replace('[[firstname]]', $this->lead->contact->firstname, $this->message->body);
        $this->message->body = str_replace('[[lastname]]', $this->lead->contact->lastname, $this->message->body);
        $this->message->body = str_replace('[[email]]', $this->lead->contact->email, $this->message->body);

        $messageBody = $this->message->body;

        return new Content(
            markdown: 'sales-management::emails.campaignmessage',
            with: [
                'messageBody' => $messageBody,
            ],
        );
    }
}
