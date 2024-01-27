@extends('layouts.master_front')


@section('meta_tags')
<meta name="description" content="{{ isset($page->meta_description) ? $page->meta_description : get_settings('meta_description') }} ">
<meta name="title" content="{{ isset($page->meta_title) ? $page->meta_title : get_settings('meta_title') }} ">
@endsection

@section('title')
 {{  $page->title }}
@endsection

@push('style')
<style>
    .register-form input,
    .register-form textarea{
        border-radius: 44px;
        text-align: right;
        background-color: #eee;
    }
    .field-phone select {
        width: 66%;
        background-color: #eee;
    }
    .register-form .btn {
        padding: 10px 18px;
        border-radius: 35px;
        margin: 10px 0px;
    }
    .register-form .form-group {
        padding: 0px 0px 0px 0px;
    }
    .about-area.about-bg{
        margin-top: 30px;
    }
    .section-title-two.white-title .title{
        padding-bottom: 12px;
    }
</style>
@endpush

@section('content')
<section class="about-area about-bg" style="margin-top:50px">
    <div class="container">
        <div class="row align-items-center justify-content-center register-form">
            <div class="col-lg-6">
                <div class="choose-content-two">
                     <div class="section-title-two white-title">
                        <span class="sub-title" data-aos="fade-down" data-aos-delay="0" >
                            {{ isset($page->title) ? $page->title : '' }}
                        </span>
                        <h2 class="title" data-aos="fade-up" data-aos-delay="10" style="color: #1e3668;">
                            {{ isset($page->title) ? $page->title : '' }}
                        </h2>
                    </div>
                    <div data-aos="fade-in" data-aos-delay="20">
                        {!! isset($page->content) ? $page->content : '' !!}
                    </div>
                    <div class="form-login">
                        <form method="POST" action="{{ route('send-email') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم الاول</label>
                                        <input type="text" name="firstname"  value="{{ old('firstname') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الاسم" required>
                                        @error('firstname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">الاسم الثانى</label>
                                        <input type="text" name="lastname"  value="{{ old('lastname') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="الاسم" required>
                                        @error('lastname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class='col-md-12'>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">البريد الالكترونى</label>
                                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الالكترونى" required>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">نص الرسالة</label>
                                        <textarea name="description" class="form-control" id="exampleInputPassword1" placeholder="نص الرسالة المتروكة" required>{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm">ارسال</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-8" data-aos="fade-right" data-aos-delay="40">
                <div class="about-img-wrap-four">
                    @if(isset($page->thumbnail_id))
                        <div>
                            <img src="{{ upload_assets($page->thumbnail_id,true) }}" alt="">
                        </div>
                    @else
                        <div class="mask-img-wrap">
                            <img src="{{ asset('front/assets/img/images/h3_about_img01.jpg') }}" alt="">
                        </div>
                    @endif
                    <div class="icon"><i class="flaticon-business-presentation"></i></div>
                    {{-- <img src="{{ asset('front/assets/img/images/h3_about_img02.jpg') }}" alt="" class="img-two"> --}}
                    <div class="about-shape-wrap-three">
                        <img src="assets/img/images/h3_about_shape01.png" alt="">
                        <img src="assets/img/images/h3_about_shape02.png" alt="">
                        <img src="assets/img/images/h3_about_shape03.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@if(get_settings('website_location_map'))
    <div class="contact-map">
        {!! get_settings('website_location_map') ?: '' !!}
        {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3152.332792000835!2d144.96011341744386!3d-37.805673299999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sen!2sbd!4v1685027435635!5m2!1sen!2sbd" allowfullscreen="" loading="lazy"></iframe> --}}
    </div>
@endif
@endsection
