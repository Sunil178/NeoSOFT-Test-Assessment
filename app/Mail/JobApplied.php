<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class JobApplied extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $title, $candidate_job_id;
    /**
     * Create a new message instance.
     */
    public function __construct($title, $candidate_job_id, $user)
    {
        $this->title = $title;
        $this->user = $user;
        $this->candidate_job_id = $candidate_job_id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                env('MAIL_FROM_ADDRESS', 'geekyprogrammer178@gmail.com'),
                env('MAIL_FROM_NAME', 'Job Portal')
            ),
            subject: 'A candidate applied your posted job',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.job_applied',
            with: [ 'title' => $this->title, 'candidate_job_id' => $this->candidate_job_id, 'user' => $this->user ],
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
