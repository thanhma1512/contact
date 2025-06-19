<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactConfirmationMail; // Import Mailable mới
use App\Models\Contact; // Import Contact Model
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // Import Log để ghi lỗi

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

    /**
     * Xử lý dữ liệu gửi từ form liên hệ, lưu vào DB và gửi email xác nhận.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitContactForm(Request $request)
    {
        // 1. Xác thực dữ liệu người dùng gửi lên
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255',
            'phone' => 'nullable|string|max:20', // Đã thay đổi thành nullable
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

        // 2. Chuẩn bị dữ liệu để lưu vào database
        $contactDataForDb = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'] ?? null, // Đảm bảo lưu null nếu không có
            'address' => $validatedData['address'] ?? null,
            'subject' => $validatedData['subject'] ?? null,
            'message' => $validatedData['message'], // Lưu 'message' vào cột 'message' trong DB
            'ip_address' => $request->ip(),
        ];

        try {
            // 3. Lưu thông tin liên hệ vào Database
            Contact::create($contactDataForDb);
            
            // 4. Chuẩn bị dữ liệu để gửi email xác nhận (có thể thêm các trường hiển thị)
            // Lấy lại dữ liệu đầy đủ bao gồm cả IP, thời gian submit cho email
            $contactDataForEmail = array_merge($validatedData, [
                'ip_address' => $request->ip(),
                'submitted_at' => now()->format('H:i:s d/m/Y'),
            ]);

            // 5. Gửi email xác nhận tới người dùng
            Mail::to($contactDataForEmail['email'])->send(new ContactConfirmationMail($contactDataForEmail));

            // 6. Chuyển hướng trở lại trang liên hệ với thông báo thành công
            return redirect()->route('contact.show')->with('success', 'Cảm ơn bạn đã liên hệ! Tin nhắn của bạn đã được gửi thành công và một email xác nhận đã được gửi đến địa chỉ của bạn.');

        } catch (\Exception $e) {
            // 7. Ghi log lỗi và chuyển hướng trở lại với thông báo lỗi
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
        // Dữ liệu mẫu để hiển thị trong email test
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

        // Trả về view của email để xem trước trong trình duyệt
        return view('emails.contact-confirmation', ['data' => $contactData]);
    }
}