<?php

namespace App\Mail;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendQrCode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The event instance.
     *
     * @var \App\Models\Event
     */
    public $event;

    /**
     * The event instance.
     *
     * @var \App\Models\Participant
     */
    public $participant;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Event $event
     * @param \App\Models\Participant $participant
     * @return void
     */
    public function __construct(Event $event, Participant $participant)
    {
        $this->event = $event;
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $event = $this->event;
        $participant = $this->participant;

        return $this->view('emails.qr-code', compact('event', 'participant'))
            ->subject("Kode Akses $event->title - $participant->name")
            ->attach(storage_path("app/public/upload/qr-codes/$participant->email.png"), [
                'as' => " $event->title - $participant->name",
                'mime' => 'application/pdf',
            ]);;
    }
}
