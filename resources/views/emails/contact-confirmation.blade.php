<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác nhận Liên hệ của bạn</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
            font-family: 'Roboto', Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .backround {
            background-color: #D3D3D3;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        .email-header {
            background-color: #0047ab;
            padding: 25px 20px;
            text-align: center;
            color: white;
        }

        .email-header img {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .email-header h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
        }

        .email-body {
            padding: 30px 30px;
            font-size: 16px;
            line-height: 1.7;
        }

        .email-body p {
            margin: 15px 0;
        }

        .info-row strong {
            display: inline-block;
            min-width: 120px;
            color: #222;
            font-weight: 700;
        }

        .message-content {
            background-color: #f8fafd;
            border-left: 5px solid #0047ab;
            padding: 20px;
            margin: 25px 0;
            white-space: pre-wrap;
            word-break: break-word;
            color: #555;
            font-style: italic;
            border-radius: 4px;
        }

        .email-footer {
            background-color: #f9f9f9;
            text-align: center;
            font-size: 13px;
            color: #777;
            padding: 20px 25px;
            border-top: 1px solid #eee;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .email-footer a {
            color: #0047ab;
            text-decoration: none;
            font-weight: 600;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }

        .note {
            text-align: center;
            font-size: 12px;
            color: #aaa;
            padding: 15px 10px;
        }

        a {
            color: #0047ab;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="backround">
        <div class="email-wrapper">
            <div class="email-header">
                <img src="https://nhamattroi.vn/thumbs/112x76x2/upload/photo/asset-3-1173.png" alt="Logo Công ty">
                <h1 style="color: white !important;">XÁC NHẬN THÔNG TIN LIÊN HỆ</h1>
            </div>

            <div class="email-body">
                <p>Xin chào <strong>{{ $data['name'] }}</strong>,</p>

                <p>Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi đã nhận được thông tin của bạn và sẽ phản hồi sớm nhất
                    có thể.</p>

                <p>Dưới đây là chi tiết thông tin bạn đã gửi:</p>

                <p class="info-row"><strong>Họ tên:</strong> {{ $data['name'] }}</p>
                <p class="info-row"><strong>Email:</strong> <a
                        href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></p>
                <p class="info-row"><strong>Số điện thoại:</strong> {{ $data['phone'] ?? 'Không có' }}</p>
                <p class="info-row"><strong>Địa chỉ:</strong> {{ $data['address'] ?? 'Không có' }}</p>
                <p class="info-row"><strong>Chủ đề:</strong> {{ $data['subject'] ?? 'Không có chủ đề' }}</p>

                <p><strong>Nội dung tin nhắn của bạn:</strong></p>
                <div class="message-content">
                    {{ $data['message'] }}
                </div>

                <p><strong>Thời gian gửi:</strong> {{ $data['submitted_at'] }}</p>

                <p>Trân trọng,<br>Đội ngũ <strong>{{ config('app.name') }}</strong></p>
            </div>

            <div class="email-footer">
                <p>© {{ date('Y') }} <strong>{{ config('app.name') }}</strong>. Mọi quyền được bảo lưu.</p>
                <p>Truy cập website tại: <a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>
            </div>
        </div>
        <div class="note">
            Bạn nhận được email này vì đã gửi thông tin tại website của chúng tôi.<br>
            Vui lòng không phản hồi email này.
        </div>
    </div>
</body>

</html>
