<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactConfirmationMail; 
use App\Models\Contact; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; 

class ContactController extends Controller
{
    /**
     * Hiển thị trang form liên hệ.
     *
     * @return \Illuminate\View\View
     */
    public function showContactForm()
    {
        return view('contact');
    }


    public function submitContactForm(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'nullable|string|max:20', 
            'address' => 'nullable|string|max:500',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|min:10|max:2000',
        ], [
            'name.required' => 'Vui lòng nhập họ tên của bạn.',
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'message.required' => 'Vui lòng nhập nội dung tin nhắn.',
            'message.min' => 'Nội dung tin nhắn phải có ít nhất :min ký tự.',
            'message.max' => 'Nội dung tin nhắn không được vượt quá :max ký tự.',
        ]);

        $contactDataForDb = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ?? null, 
            'address' => $validatedData['address'] ?? null,
            'subject' => $validatedData['subject'] ?? null,
            'message' => $validatedData['message'], 
            'ip_address' => $request->ip(),
        ];

        try {
            Contact::create($contactDataForDb);
            
            $contactDataForEmail = array_merge($validatedData, [
                'ip_address' => $request->ip(),
                'submitted_at' => now()->format('H:i:s d/m/Y'),
            ]);

            Mail::to($contactDataForEmail['email'])->send(new ContactConfirmationMail($contactDataForEmail));

            return redirect()->route('contact.show')->with('success', 'Cảm ơn bạn đã liên hệ! Tin nhắn của bạn đã được gửi thành công và một email xác nhận đã được gửi đến địa chỉ của bạn.');

        } catch (\Exception $e) {
            Log::error('Lỗi khi xử lý form liên hệ: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'exception' => $e,
            ]);
            return redirect()->route('contact.show')->with('error', 'Có lỗi xảy ra khi gửi tin nhắn. Vui lòng thử lại sau.')->withInput();
        }
    }

    /**
     * Hiển thị giao diện email xác nhận liên hệ trong trình duyệt để kiểm tra.
     */
    public function testContactEmail()
    {
        $contactData = [
            'name' => 'Nguyễn Văn A',
            'email' => 'test@example.com',
            'phone' => '0987654321',
            'address' => '123 Đường ABC, Quận XYZ, TP.HCM',
            'subject' => 'Về sản phẩm Camera siêu nhỏ',
            'message' => 'Tôi muốn hỏi thêm về thông số kỹ thuật và chính sách bảo hành của sản phẩm camera không dây siêu nhỏ. Xin vui lòng liên hệ lại cho tôi.',
            'ip_address' => '192.168.1.1',
            'submitted_at' => '09:30:00 19/06/2025',
        ];

        return view('emails.contact-confirmation', ['data' => $contactData]);
    }
}