<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $title = 'Invoice';
    public $template = 'mail.invoice';


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        public $model,
        public $recevier,
        public $action,
    ) {
        $this->afterCommit();
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        $model = $this->model;
        return new Envelope(
            subject: $this->title . " [{$model->invoice_number}] - " . ucfirst($this->action),
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
            view: $this->template . '.' . $this->action,
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
