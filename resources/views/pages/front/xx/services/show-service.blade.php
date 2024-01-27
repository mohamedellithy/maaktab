@extends('layouts.master_front')

@section('title')
 {{  $service->title  ?: '' }}
@endsection

@section('content')
<!-- project-details-area -->
<section class="project-details-area pt-120 pb-120 page-bg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="project-details-wrap">
                    <div class="row">
                        <div class="col-71">
                            <div class="project-details-thumb service-details-thumb">
                                <img src="{{ upload_assets($service->image_info) }}" alt="">
                            </div>
                        </div>
                        <div class="col-29">
                            <div class="project-details-info">
                                <h6 class="title">تفاصيل الخدمة </h6>
                                <ul class="list-wrap">
                                    <li class="first-list">
                                        <strong> {{ $service->name }} </strong>
                                    </li>
                                    <li>
                                        @if($service->loginStatus == 1)
                                            @auth
                                                <button id="subscrib_on_service" class="btns btns-secondary-color btn-sm">
                                                    طلب تسعير خدمة
                                                </button>
                                            @endauth
                                            @guest
                                                <a href="{{ route('login') }}" class="btns btns-secondary-color btn-sm">
                                                    طلب تسعير خدمة
                                                </a>
                                            @endguest
                                        @else
                                            <button id="subscrib_on_service" class="btns btns-secondary-color btn-sm">
                                                طلب تسعير خدمة
                                            </button>
                                        @endif
                                    </li>
                                    @if($service->whatsapStatus == 1)
                                        <li>
                                            <a href="{{ 'https://wa.me/'.get_settings('website_whastapp').'?text='.urlencode(' طلب استفسار بخصوص خدمة ' . $service->name) }}" id="subscrib_on_service" class="btns btns-warning btn-sm">
                                                تواصل معنا عبر الواتساب
                                            </a>
                                        </li>
                                    @endif
                                    <li class="social">
                                        <label> مشاركة على روابط التواصل الاجتماعي :</label>
                                        <ul class="list-wrap">
                                            <li><a href="{{ "https://www.facebook.com/sharer/sharer.php?u=".url('service/',$service->slug) }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="{{ "https://twitter.com/intent/tweet?text=".url('service/',$service->slug) }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="{{ "https://wa.me/?text=".$service->slug.'%0A'.'رابط الخدمة'.'%0A%20%20%20'.url('service/',$service->slug) }}" target="_blank"><i class="fab fa-whatsapp"></i></a></li>
                                            <li><a href="{{ "https://pinterest.com/pin/create/button/?url=".url('service/',$service->slug).'&media='.upload_assets($service->image_info).'&description='.$service->name }}" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="project-details-content">
                        <h5 class="title">{{ $service->name }}</h5>
                        <div class="section-title-two mb-20 tg-heading-subheading animation-style3">
                            <span class="sub-title">تفاصيل الخدمة</span>
                        </div>
                        <p>
                            {!! $service->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- project-details-area-end -->


<!-- header-search -->
<div class="services-application-form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="services-application-close">
        <span><i class="fas fa-times"></i></span>
    </div>
    <div class="search-wrap text-center">
        <div class="container">
            <div class="row">
                <div class="col-6 application-inner">
                    <form action="{{ route('application-submit',$service->id) }}" method="post">
                        @csrf
                        <div class="heading">
                            <h4 class="title text-center"> طلب تسعير خدمة</h4>
                            <h6 class="sub-title text-center"> {{ $service->name }}</h6>
                        </div>
                        <div class="form-group">
                            <label>اسم المشترك</label>
                            <input name="name" @auth value="{{ auth()->user()->name }}" @endauth type="text" class="form-control" required/>
                            @error('name')
                                <span class="text-danger w-100 fs-6" style="color: #a21212 !important;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>البريد الالكترونى</label>
                            <input name="email"  @auth value="{{ auth()->user()->email }}" @endauth type="email" class="form-control" required/>
                            @error('email')
                                <span class="text-danger w-100 fs-6" style="color: #a21212 !important;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>رقم الجوال</label>
                            <div class="field-phone d-flex">
                                <select name="phone_code" id="phone_code" class="form-control phone-cdoe" required>
                                    @foreach(CountriesPhonesCode() as $code => $phone_code)
                                        <option value="{{ $code }}" @if($code == '966') selected @endif>{{ $phone_code }}</option>
                                    @endforeach
                                </select>
                                <input name="phone" placeholder="رقم الجوال" @auth value="{{ auth()->user()->phone }}" @endauth type="tel" class="form-control" required/>
                            </div>
                            @error('phone')
                                <span class="text-danger w-100 fs-6" style="color: #a21212 !important;">{{ $message }}</span>
                            @else
                              <p id="frame_phone_alert" style="color:#ffc107;font-size:12px;">قم بكتابة رقم الجوال   <span id="phoneno">8</span>  أرقام بدون صفر مثل: 555555555</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>تفاصيل الخدمة المطلوبة</label>
                            <textarea name="subscriber_notic" rows="3" name="" class="form-control" required></textarea>
                            @error('subscriber_notic')
                                <span class="text-danger w-100 fs-6" style="color: #a21212 !important;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group text-center" style="padding: 27px;">
                            <button type="submit" class="btns btns-warning">ارسال</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- header-search-end -->
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
