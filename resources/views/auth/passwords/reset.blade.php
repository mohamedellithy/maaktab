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
                        <h4 style="line-height: 3em;">ضبط كلمة المرور</h4>
                    </div>
                    <form method="post" action="{{ route('password.update') }}" class="ud-login-form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="ud-form-group">
                            <input
                            type="email"
                            name="email"
                            placeholder="البريد الالكترونى"
                            />
                        </div>
                        <div class="ud-form-group">
                            <input
                            type="password"
                            name="password"
                            placeholder="كلمة المرور"
                            />
                        </div>
                        <div class="ud-form-group">
                            <input
                            type="password"
                            name="password_confirmation"
                            placeholder="تأكيد كلمة المرور"
                            />
                        </div>
                        <div class="ud-form-group">
                            <button type="submit" class="ud-main-btn w-100">ضبط كلمة المرور</button>
                        </div>
                    </form>
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
