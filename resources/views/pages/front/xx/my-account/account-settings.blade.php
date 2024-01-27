@extends('layouts.master_front')

@push('style')
<style>
    .dashboard input{
        border-radius: 44px;
        text-align: right;
    }
    .field-phone select {
        width: 66%;
    }
    .dashboard .btn {
        padding: 10px 18px;
        border-radius: 35px;
        margin: 10px 0px;
    }
</style>
@endpush

@section('title')
 {{ 'اعدادات الحساب' }}
@endsection

@section('content')
 <!-- project-details-area -->
 <section class="project-details-area pt-120 pb-120 page-bg">
    <div class="container">
        <div class="row">
            <div class="dashboard login-form d-flex">
                <div class="menu-account">
                    @include('inc.customer_menu')
                </div>
                <div class="content-page">
                    <h4>مرجبا {{ auth()->user()->name }}</h4>
                    <p style="width: 80%;">
                        يمكنك تعديل حسابك من خلال هذة اللوحة
                    </p>
                    <div class="form-login">
                        <form method="POST" action="{{ route('update-account') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم</label>
                                        <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الاسم">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>رقم الجوال</label>
                                        <div class="field-phone d-flex">
                                            <select name="phone_code" id="phone_code" class="form-control phone-cdoe" required>
                                                @foreach(CountriesPhonesCode() as $code => $phone_code)
                                                    <option value="{{ $code }}" @if($code == auth()->user()->phone_code) selected @endif>{{ $phone_code }}</option>
                                                @endforeach
                                            </select>
                                            <input name="phone" placeholder="رقم الجوال" @auth value="{{ auth()->user()->phone }}" @endauth type="tel" class="form-control" required/>
                                        </div>
                                        @error('phone')
                                            <span class="text-danger w-100 fs-6" style="color: #a21212 !important;">{{ $message }}</span>
                                        @else
                                          <p id="frame_phone_alert" style="color:#ffc107;font-size:12px;">قم بكتابة رقم الجوال مكون من  <span id="phoneno">8</span> أرقام</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">البريد الالكترونى</label>
                                        <input type="email" value="{{ auth()->user()->email }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الالكترونى" readonly>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">كلمة المرور</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="كلمة المرور">
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
                                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="تأكيد المرور">
                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                           
                            <button type="submit" class="btn btn-success btn-sm">
                                تعديل الحساب
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- project-details-area-end -->
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