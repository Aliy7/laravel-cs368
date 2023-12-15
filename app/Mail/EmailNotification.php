<?php

namespace App\Mail;
use App\Models\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public Notification $notification;

    /**
     * Create a new message instance.
     */
    public function __construct($notification)
    {
        $this->notification=$notification;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'livewire.notifications',
        );
    }

    public function buildNotifcation()
    {
        return $this->view('livewire.notifications')
                    ->with(['notification' => $this->notification]);
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
    public function build()
    {
        return $this->from('hello@example.com')
                    ->subject('New Notification')
                    ->view('livewire.notifications'); 
    }
}
