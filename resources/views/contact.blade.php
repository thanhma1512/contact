@extends('layouts.app')
@section('content')
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
@endsection
