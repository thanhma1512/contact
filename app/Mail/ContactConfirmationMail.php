<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData; 

    /**
     * Tạo một phiên bản tin nhắn mới.
     *
     * @param array $contactData Dữ liệu từ form liên hệ
     */
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
            subject: 'Xác nhận thông tin liên hệ của bạn tại ' . config('app.name'), // Tiêu đề email
            // Gửi từ địa chỉ của ứng dụng
            from: new \Illuminate\Mail\Mailables\Address(config('mail.from.address'), config('mail.from.name')),
        );
    }

    /**
     * Lấy định nghĩa nội dung tin nhắn.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-confirmation', // Template Blade cho email xác nhận liên hệ
            with: [
                'data' => $this->contactData, // Truyền dữ liệu contactData vào view dưới tên 'data'
            ],
        );
    }
}