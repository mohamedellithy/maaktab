@extends('layouts.master_front')
@push('style')
<style>
    .login-form input{
        border-radius: 44px;
        text-align: right;
    }
    .field-phone select {
        width: 66%;
    }
    .login-form .btn {
        padding: 10px 18px;
        border-radius: 35px;
        margin: 10px 0px;
    }
</style>
@endpush
@section('content')
<section class="container register page-bg">
    <div class="row">
        <div class="d-flex login-form">
            <div class="form-login">
                <div class="heading">
                    <h4>تسجيل الدخول</h4>
                    <p class="description">
                        يمكنك التسجيل الدخول فى منصتنا و الاستفدة بخدماتنا و منتجاتنا الرقمية
                    </p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">البريد الالكترونى</label>
                        <input name="email" type="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الالكترونى">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">كلمة المرور</label>
                        <input name="password" type="password" value="{{ old('password') }}" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">تسجيل الدخول</button>
                    <p class=" text-right" style="padding: 10px;">
                        <a href="{{ route('password.request') }}">نسيت كلمة المرور ؟</a>
                    </p>
                    <p class="bottom-description text-center">
                        ليس لديك حساب ؟
                        <a href="{{ route('register') }}">انشاء حساب جديد</a>
                    </p>
                </form>
            </div>
            <div class="banner-register">
                <div class="left-banner">
                    <img src="{{ asset('front/assets/img/images/h3_testimonial_img.jpg') }}" class="" />
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
