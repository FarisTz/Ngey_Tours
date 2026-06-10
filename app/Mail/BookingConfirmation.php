<?php

namespace App\Mail;

use App\Models\Booking;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $item;

    public $qrCode;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, $item = null, )
    {
        $this->booking = $booking;
        $this->item = $item;


        // Generate a simple booking reference QR code (you can use a package like simplesoftwareio/simple-qrcode)
        // $this->qrCode = \QrCode::size(150)->generate(route('user.booking.view', $booking->booking_reference));
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmation - ' . $this->booking->booking_reference,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-confirmation',
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
