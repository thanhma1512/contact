<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData;

    public function __construct(array $contactData)
    {
        $this->contactData = $contactData;
    }

    /**
     * Lấy định nghĩa phong bì tin nhắn (tiêu đề, người gửi, người nhận, reply-to).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Xác nhận thông tin liên hệ của bạn tại ' . config('app.name'),
            from: new Address(config('mail.from.address'), config('mail.from.name')),
        );
    }

    /**
     * Lấy định nghĩa nội dung tin nhắn.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-confirmation',
            with: [
                'data' => $this->contactData,
            ],
        );
    }

     public function attachments(): array
    {
        return [];
    }
}
