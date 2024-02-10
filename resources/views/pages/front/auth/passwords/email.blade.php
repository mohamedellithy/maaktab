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
                <h4 style="line-height: 3em;">اعادة ضبط كلمة المرور</h4>
            </div>
            <form method="post" action="{{ route('password.email')  }}" class="ud-login-form">
                @csrf
                <div class="ud-form-group">
                    <input
                    type="email"
                    name="email"
                    placeholder="البريد الالكترونى"
                    />
                </div>
                <div class="ud-form-group">
                    <button type="submit" class="ud-main-btn w-100">
                        ارسال رابط اعادة ضبط كلمة المرور
                    </button>
                </div>
            </form>
            <a class="forget-pass" href="{{ route('login') }}">
              تسجيل الدخول اذا كان لك حساب بالفعل 
            </a>
            <p class="signup-option">
              ليس لديك حساب مسجل ؟ <a href="{{ route('register') }}"> انشاء الحساب </a>
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

    .ud-login{
        margin-top:2%;
    }
    .ud-login-wrapper{
        padding: 35px;
        box-shadow: 0px 0px 0px 0px !important;
    }
</style>
@endpush
