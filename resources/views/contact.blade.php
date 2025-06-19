<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên hệ - {{ config('app.name') }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container-custom {
            max-width: 900px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            text-align: center;
            padding-top: 20px;
            padding-bottom: 10px;
            font-size: 28px;
            font-weight: bold;
            color: #0047ab;
            background-color: #fff;
        }

        .form-section {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            max-width: 800px;
            margin: 15px auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group textarea {
            width: 100%;
            padding: 5px 10px;
            font-size: 14px;
            background-color: #f2f2f2;
        }

        .form-group input[type="text"]:hover,
        .form-group input[type="email"]:hover,
        .form-group textarea:hover {
            border-color: #90CAF9;
            border-radius: 6px;
            box-shadow: 0 0 0 3px rgba(144, 202, 249, 0.5);
            background-color: #FFFFFF;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2196F3;
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.5);
        }


        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        .btn-submit {
            background-color: #0047ab;
            color: white;
            padding: 9px 9px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        .btn-submit:hover {
            background-color: #007bff;
        }

        .address-contact {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-flow: wrap;
            width: 100%;
            margin-top: 20px;
            max-width: 800px;
            margin: 15px auto;
        }

        .item-address-contact {
            width: calc(100% / 3);
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .img-address-contact {
            color: #0047ab;
        }

        .img-address-contact .fa-location-dot {
            font-size: 28px;
        }

        .img-address-contact .fa-phone-flip {
            font-size: 28px;
        }

        .img-address-contact .fa-envelope {
            font-size: 28px;
        }

        .text-address-contact {
            margin-left: 10px;
            line-height: 22px;
        }

        .text-address-contact span {
            color: #9b9b9b;
            font-size: 10px;
        }
 
        .text-address-contact p {
            color: #0047ab;
            font-size: 12px;
            font-weight: 700;
        }


        .map-section {
            text-align: center;
            max-width: 800px;
            margin: 15px auto;
        }

        .map-placeholder {
            width: 100%;
            height: 400px;
            background-color: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #666;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .map-placeholder iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Alert messages */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-size: 16px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="container-custom">
        <div class="header">
            LIÊN HỆ
        </div>

        <div class="form-section">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf <div class="form-row">
                    <div class="form-group">
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Họ tên">
                        @error('name')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                            placeholder="Số điện thoại">
                        @error('phone')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <input type="text" id="address" name="address" value="{{ old('address') }}"
                            placeholder="Địa chỉ">
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Email">
                        @error('email')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                        placeholder="Chủ đề">
                </div>

                <div class="form-group">
                    <textarea id="message" name="message" placeholder="Nội dung">{{ old('message') }}</textarea>
                    @error('message')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">GỬI THÔNG TIN</button>
            </form>
        </div>

        <div class="address-contact">
            <div class="item-address-contact">
                <div class="img-address-contact">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div class="text-address-contact">
                    <span>Địa chỉ</span>
                    <p>42 Đường số 11, Hiệp Bình Phước, Thủ Đức, Thành phố Hồ Chí Minh</p>
                </div>
            </div>

            <div class="item-address-contact">
                <div class="img-address-contact">
                    <i class="fa-solid fa-phone-flip"></i>
                </div>

                <div class="text-address-contact">
                    <span>Gọi chúng tôi</span>
                    <p>0778534569</p>
                </div>
            </div>

            <div class="item-address-contact">
                <div class="img-address-contact">
                    <i class="fa-solid fa-envelope"></i>
                </div>

                <div class="text-address-contact">
                    <span>Email</span>
                    <p>info@nhamattroi.vn</p>
                </div>
            </div>
        </div>

        <div class="map-section">
            <div class="map-placeholder">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.423984570044!2d106.7027421748281!3d10.85429118930438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175284000000001%3A0x88981d3d5f0b4b20!2s42%20%C4%90%C6%B0%E1%BB%9Dng%20s%E1%BB%91%2011%2C%20Hi%E1%BB%87p%20B%C3%ACnh%20Ph%C6%B0%E1%BB%9Bc%2C%20Th%E1%BB%A7%20%C4%90%E1%BB%A9c%2C%20Th%C3%A0nh%20ph%E1%BB%91%20H%E1%BB%93%20Ch%C3%AD%20Minh!5e0!3m2!1svi!2svn!4v1718765870634!5m2!1svi!2svn"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</body>

</html>
