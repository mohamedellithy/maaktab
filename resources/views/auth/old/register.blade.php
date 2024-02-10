@extends('layouts.master_front')
@push('style')
<style>
    .register-form input{
        border-radius: 44px;
        text-align: right;
    }
    .field-phone select {
        width: 66%;
    }
    .register-form .btn {
        padding: 10px 18px;
        border-radius: 35px;
        margin: 10px 0px;
    }
</style>
@endpush
@section('content')
<section class="container register page-bg">
    <div class="row">
        <div class="d-flex register-form">
            <div class="form-login">
                <div class="heading">
                    <h4>انشاء حساب جديد</h4>
                    <p class="description">
                        يمكنك انشاء حساب جديد فى منصتنا و الاستفادة بخدماتنا و منتجاتنا الرقمية
                    </p>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">الاسم</label>
                                <input type="text" name="name"  value="{{ old('name') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الاسم" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>رقم الجوال</label>
                                <div class="field-phone d-flex">
                                    <select name="phone_code"  id="phone_code" class="form-control phone-cdoe" required>
                                        @foreach(CountriesPhonesCode() as $code => $phone_code)
                                            <option value="{{ $code }}" @if($code == (old('phone_code') ?: '966') ) selected @endif>{{ $phone_code }}</option>
                                        @endforeach
                                    </select>
                                    <input name="phone" placeholder="رقم الجوال" value="{{ old('phone') }}" type="tel" class="form-control" required/>
                                </div>
                                @error('phone')
                                    <span class="text-danger w-100 fs-6" style="color: #a21212 !important;">{{ $message }}</span>
                                @else
                                     <p id="frame_phone_alert" style="color:#ffc107;font-size:12px;">قم بكتابة رقم الجوال   <span id="phoneno">8</span>  أرقام بدون صفر مثل: 555555555</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">البريد الالكترونى</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الالكترونى" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">كلمة المرور</label>
                                <input type="password" name="password" value="{{ old('password') }}" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">تأكيد المرور</label>
                                <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" id="exampleInputPassword1" placeholder="تأكيد المرور" v>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">تذكرنى</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">انشاء حساب جديد</button>
                    <br/>
                    <p class="bottom-description text-center">
                        هل لديك حساب ؟
                        <a href="{{ route('login') }}">تسجيل الدخول</a>
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

@push('scripts')
<script>
    jQuery('document').ready(function(){
        let all_phones = @json(LengthCountriesPhonesNo());
        console.log(all_phones);
        jQuery('#phone_code').on('change',function(){
            jQuery('#phoneno').html(all_phones[jQuery(this).val()]);
            jQuery('#frame_phone_alert').show();
        });
    });
</script>
@endpush
