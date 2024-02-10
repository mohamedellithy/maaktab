@extends('layouts.master_front')

@section('after_header')
@endsection
@section('content')
<!-- ====== Login Start ====== -->
 <section class="ud-login">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="ud-login-wrapper">
            <div class="ud-login-logo">
              <img src="{{ asset('m-logo.png') }}" alt="logo" style="width: 100px;"/>
              <h4 style="line-height: 3em;">انشاء الحساب</h4>
            </div>
            <form method="post" action="{{ route('register') }}" class="ud-login-form">
                @csrf
                <div class="ud-form-group">
                    <input type="name" name="name" value="{{ old('name') }}" placeholder="الاسم" />
                    @error('name')
                        <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="ud-form-group">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="البريد الالكترونى"/>
                    @error('email')
                        <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="ud-form-group">
                    <div class="field-phone d-flex">
                        <select name="phone_code"  id="phone_code" class="form-control phone-cdoe" required>
                            @foreach(CountriesPhonesCode() as $code => $phone_code)
                                <option value="{{ $code }}" @if($code == (old('phone_code') ?: '966') ) selected @endif>{{ $phone_code }}</option>
                            @endforeach
                        </select>
                        <input name="phone" placeholder="رقم الجوال" value="{{ old('phone') }}" type="tel" class="form-control phone" required/>
                    </div>
                    @error('phone')
                        <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                    @enderror
                </div>
              <div class="ud-form-group">
                <input type="password" name="password" placeholder="كلمة المرور"/>
                @error('password')
                    <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                @enderror
              </div>
              <div class="ud-form-group">
                <input type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور"/>
                @error('password')
                    <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                @enderror
              </div>
              <div class="ud-form-group">
                <button type="submit" class="ud-main-btn w-100">انشاء الحساب</button>
              </div>
            </form>

            {{-- <div class="ud-socials-connect">
              <p>انشاء الحساب باستخدام</p>

              <ul>
                <li>
                  <a href="javascript:void(0)" class="facebook">
                    <i class="lni lni-facebook-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="twitter">
                    <i class="lni lni-twitter-filled"></i>
                  </a>
                </li>
                <li>
                  <a href="javascript:void(0)" class="google">
                    <i class="lni lni-google"></i>
                  </a>
                </li>
              </ul>
            </div> --}}

            <p class="signup-option">
              هل لديك حساب بالفعل ؟ <a href="{{ route('login') }}"> تسجيل الدخول</a>
            </p>
          </div>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('front/assets/images/login.jpg') }}" />
        </div>
      </div>
    </div>
  </section>
  <!-- ====== Login End ====== -->
@endsection


@push('style')
<style>
    /* .ud-header{
        background-color:#24afe9;
    } */
    /* .sticky
    {
        background-color: rgba(255, 255, 255, 0.8) !important;
        color:#031244;
    } */
    .ud-login{
        margin-top:2%;
    }
    .ud-login-wrapper{
        padding: 35px;
        box-shadow: 0px 0px 0px 0px !important;
    }
    .phone-cdoe{
        width:19% !important;
        border-left: 0px !important;
        border-radius: 0px 6px 6px 0px !important;
    }
    .phone{
        border-radius: 6px 0px 0px 6px !important;
        direction: rtl;
    }
</style>
@endpush
