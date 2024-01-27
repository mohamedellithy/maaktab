@extends('layouts.master_front')
@php
$page = ActivePagesMenus(['slug','=','/'])[0];
@endphp

@section('meta_tags')
<meta name="description" content="{{ isset($page->meta_description) ? $page->meta_description : get_settings('meta_description') }} ">
<meta name="title" content="{{ isset($page->meta_title) ? $page->meta_title : get_settings('meta_title') }} ">
@endsection

@section('title')
 {{  $page->title }}
@endsection

@section('content')

@if(isset($page->content['slider_banner']['enable']) && $page->content['slider_banner']['enable'] == 'active')
<!-- banner-area -->
<section class="banner-area-two banner-bg-two" data-background="assets/img/banner/h2_banner_bg.jpg') }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-content-two">
                    <span class="sub-title" data-aos="fade-up" data-aos-delay="0">
                        {{ isset($page->content['slider_banner']['sub_heading']) ? $page->content['slider_banner']['sub_heading']  : 'نحن خبراء في هذا المجال' }}
                    </span>
                    <h2 class="title " data-aos="fade-up" data-aos-delay="300">
                        {{ isset($page->content['slider_banner']['heading']) ? $page->content['slider_banner']['heading']  : 'الخطوة الرائدة للتجارة و الاستثمار' }}
                    </h2>
                    <p data-aos="fade-up" data-aos-delay="500">
                        {{ isset($page->content['slider_banner']['description']) ? $page->content['slider_banner']['description']  : 'تمتلك وكالة الخطوة الرائدة للتجارة و الاستثمار امكانيات فريدة و متميزة لتحقيق النتائج السريعة و تحقيق أعلى مكاسب' }}
                    </p>
                    <div class="banner-btn">
                        <a href="{{ route('services') }}" class="btns" data-aos="fade-left" data-aos-delay="700">خدماتنا</a>
                        <a href="{{ isset($page->content['slider_banner']['video_link']) ? $page->content['slider_banner']['video_link']  : (isset($page->content['slider_banner']['video_id']) ? upload_assets($page->content['slider_banner']['video_id'],true) : '#') }}" class="play-btns popup-video" data-aos="fade-right" data-aos-delay="700"><i class="fas fa-play"></i> <span>مشاهدة الفيديو التعريفي</span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-img text-center">
                    <img src="{{ isset($page->content['slider_banner']['thumbnail_id']) ? upload_assets($page->content['slider_banner']['thumbnail_id'],true) : asset('front/assets/img/banner/arabic-businessman-traditional-small.png') }}" alt="" data-aos="fade-right" data-aos-delay="400">
                </div>
            </div>
        </div>
    </div>
    <div class="banner-shape-wrap">
        <img src="{{ asset('front/assets/img/banner/h2_banner_shape01.png') }}" alt="">
        <img src="{{ asset('front/assets/img/banner/h2_banner_shape02.png') }}" alt="">
        <img src="{{ asset('front/assets/img/banner/h2_banner_shape03.png') }}" alt="" data-aos="zoom-in-up" data-aos-delay="800">
    </div>
</section>
<!-- banner-area-end -->
@endif

<!-- brand-area -->
@if(isset($page->content['partner_banner']['enable']) && $page->content['partner_banner']['enable'] == 'active')
<section class="brand-aera-two">
    <div class="container">
        <br/>
        <div class="brand-item-wrap">
            <h6 class="title">
                {{ isset($page->content['partner_banner']['sub_heading']) ? $page->content['partner_banner']['sub_heading'] : 'موثوق به من قبل أكثر من 10000 شركة حول العالم' }}
            </h6>
            <div class="row brand-active">
                @isset($page->content['partner_banner']['thumbnails_id'])
                    @foreach(GetAttachments($page->content['partner_banner']['thumbnails_id']) as $attachment)
                        <div class="col-lg-12">
                            <div class="brand-item">
                                @php $media = upload_assets($attachment) @endphp
                                <a href="{{ $media }}" class="popup-image">
                                    <img src="{{ $media }}"  alt="">
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-12">
                        <div class="brand-item">
                            <img src="{{ asset('front/assets/img/brand/brand_img01.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="brand-item">
                            <img src="{{ asset('front/assets/img/brand/brand_img02.png') }}" class="popup-image" alt="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="brand-item">
                            <img src="{{ asset('front/assets/img/brand/brand_img03.png') }}" class="popup-image" alt="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="brand-item">
                            <img src="{{ asset('front/assets/img/brand/brand_img04.png') }}" class="popup-image" alt="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="brand-item">
                            <img src="{{ asset('front/assets/img/brand/brand_img05.png') }}" class="popup-image" alt="">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="brand-item">
                            <img src="{{ asset('front/assets/img/brand/brand_img03.png') }}" class="popup-image" alt="">
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</section>
@endif
<!-- brand-area-end -->

<!-- about-area -->
@if(isset($page->content['about_banner']['enable']) && $page->content['about_banner']['enable'] == 'active')
<section class="about-area-three">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 col-md-9">
                <div class="about-img-wrap-three">
                    <img src="{{ isset($page->content['about_banner']['thumbnail_id_big']) ? upload_assets($page->content['about_banner']['thumbnail_id_big'],true) : asset('front/assets/img/images/h2_about_img01.jpg') }}" alt="" data-aos="fade-down-right" data-aos-delay="0">
                    <img src="{{ isset($page->content['about_banner']['thumbnail_id_small']) ? upload_assets($page->content['about_banner']['thumbnail_id_small'],true) : asset('front/assets/img/images/h2_about_img02.jpg') }}" alt="" data-aos="fade-left" data-aos-delay="400">
                    <div class="experience-wrap" data-aos="fade-up" data-aos-delay="300">
                        <h2 class="title">{{ isset($page->content['about_banner']['expereince_years']) ? $page->content['about_banner']['expereince_years'] : '25' }} <span>عام</span></h2>
                        <p> {{ isset($page->content['about_banner']['expereince_description']) ? $page->content['about_banner']['expereince_description'] : ''  }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-content-three">
                    <div class="section-title-two mb-20">
                        <span class="sub-title">
                            {{ isset($page->content['about_banner']['sub_heading']) ? $page->content['about_banner']['sub_heading']  : 'تعرف علينا' }}
                        </span>
                        <h2 class="title" data-aos="fade-up" data-aos-delay="300">
                            {{ isset($page->content['about_banner']['heading']) ? $page->content['about_banner']['heading']  : 'الخطوة الرائدة للتجارة و الاستثمار فى الشرق الأوسط' }}
                        </h2>
                    </div>
                    <p class="info-one">
                        {!! isset($page->content['about_banner']['description']) ? $page->content['about_banner']['description']  : 'النص هنا'  !!}
                    </p>

                    <div class="about-author-info">
                        <div class="thumb">
                            <img src="{{ isset($page->content['about_banner']['thumbnail_ceo_id']) ?  upload_assets($page->content['about_banner']['thumbnail_ceo_id'],true) : asset('front/assets/img/images/about_author.png') }}" alt="">
                        </div>
                        <div class="content">
                            <h2 class="title">{{ isset($page->content['about_banner']['ceo_name']) ? $page->content['about_banner']['ceo_name'] : '' }}</h2>
                            <span>{{ isset($page->content['about_banner']['ceo_position']) ? $page->content['about_banner']['ceo_position'] : '' }}</span>
                        </div>
                        <div class="signature">
                            <img src="{{ isset($page->content['about_banner']['thumbnail_signature_id']) ?  upload_assets($page->content['about_banner']['thumbnail_signature_id'],true) : asset('front/assets/img/images/signature.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="about-shape-wrap-two">
        <img src="{{ asset('front/assets/img/images/h2_about_shape01.png') }}" alt="">
        <img src="{{ asset('front/assets/img/images/h2_about_shape02.png') }}" alt="">
        <img src="{{ asset('front/assets/img/images/h2_about_shape03.png') }}" alt="" data-aos="fade-left" data-aos-delay="500">
    </div>
</section>
@endif
<!-- about-area-end -->

<!-- services-area -->
@if(isset($page->content['services_banner']['enable']) && $page->content['services_banner']['enable'] == 'active')
<section class="services-area services-bg" data-background="{{ asset('front/assets/img/bg/services_bg.jpg') }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title white-title text-center mb-50">
                    <span class="sub-title">
                        {{ isset($page->content['services_banner']['sub_heading']) ? $page->content['services_banner']['sub_heading']  : 'خدماتنا المخصصة' }}
                    </span>
                    <h2 class="title">
                        {{ isset($page->content['services_banner']['heading']) ? $page->content['services_banner']['heading']  : 'تسليط الضوء على البعض الخدمات المهمة لدينا' }}
                    </h2>
                    <p>
                        {{ isset($page->content['services_banner']['description']) ? $page->content['services_banner']['description']  : 'تقدم وكالة الخطوة الرائدة للتجارة و الاستثمار خدمات فريدة و متنوعة' }}
                    </p>
                </div>
            </div>
        </div>
        <div class="row services-active">
            {{-- <div class="col-lg-4">
                <div class="services-item">
                    <div class="services-content">
                        <div class="content-top">
                            <div class="icon">
                                <i class="flaticon-briefcase"></i>
                            </div>
                            <h2 class="title">Business Analysis</h2>
                        </div>
                        <div class="services-thumb">
                            <img src="{{ asset('front/assets/img/services/services_img01.jpg') }}" alt="">
                            <a href="services-details.html" class="btns transparent-btns">عرض الخدمة</a>
                        </div>
                        <div class="list-wrap text-right">
                            <h6>تقدم وكالة الخطوة الرائدة للتجارة و الاستثمار خدمات</h6>
                        </div>
                    </div>
                </div>
            </div> --}}
            @forelse($services as $service)
                @include('partials.services_list_card_1')
            @empty
            @endforelse

        </div>
    </div>
</section>
@endif
<!-- services-area-end -->

<!-- about-area -->
@if(isset($page->content['introduce_banner']['enable']) && $page->content['introduce_banner']['enable'] == 'active')
<section class="about-area about-bg" data-background="{{ asset('front/assets/img/bg/about_bg.jpg') }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="about-img-wrap">
                    <img src="{{ isset($page->content['introduce_banner']['thumbnail_id']) ? upload_assets($page->content['introduce_banner']['thumbnail_id'],true) : asset('front/assets/img/images/about_img01.png') }}" data-aos="fade-right" data-aos-delay="0" alt="" class="main-img">
                    <img src="{{ asset('front/assets/img/images/about_img_shape01.png') }}" alt="">
                    <img src="{{ asset('front/assets/img/images/about_img_shape02.png') }}" alt="">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content">
                    <div class="section-title mb-25">
                        <span class="sub-title">
                            {{ isset($page->content['introduce_banner']['sub_heading']) ? $page->content['introduce_banner']['sub_heading'] : 'ماذا نحن نقدم' }}
                        </span>
                        <h2 class="title" data-aos="fade-in" data-aos-delay="0">
                            {{ isset($page->content['introduce_banner']['heading']) ? $page->content['introduce_banner']['heading'] : 'تغيير طريقة العمل لأفضل حلول الأعمال' }}
                        </h2>
                    </div>
                    <p data-aos="fade-up" data-aos-delay="10">
                        {!! isset($page->content['introduce_banner']['description']) ? $page->content['introduce_banner']['description'] : 'تغيير طريقة العمل لأفضل حلول الأعمال' !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- about-area-end -->

<!-- project-area -->
@if(isset($page->content['products_banner']['enable']) && $page->content['products_banner']['enable'] == 'active')
<section class="project-area slider project-bg" data-background="{{ asset('front/assets/img/bg/project_bg.jpg') }}">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6 col-md-8">
                <div class="section-title-two mb-50">
                    <span class="sub-title">
                        {{ isset($page->content['products_banner']['sub_heading']) ? $page->content['products_banner']['sub_heading'] : 'منتجاتنا الرقمية' }}
                    </span>
                    <h4 class="title">
                        {{ isset($page->content['products_banner']['heading']) ? $page->content['products_banner']['heading'] : 'توفر الخطوة الرائدة العديد من المنتجات الرقمية المتميزة' }}
                    </h4>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6 col-md-4">
                <div class="view-all-btns text-end mb-30">
                    <a href="{{ route('shop') }}" class="btns btns-secondary-color">عرض كل المنتجات</a>
                </div>
            </div>
        </div>
        <div class="row products-active slide">
            @forelse($products as $product)
                {{-- <div class="col-lg-4">
                    <div class="services-item">
                        <div class="services-content">
                            <!-- <div class="content-top">
                                <div class="icon">
                                    <i class="flaticon-briefcase"></i>
                                </div>
                                <h2 class="title">Business Analysis</h2>
                            </div> -->
                            <div class="services-thumb">
                                <img src="{{ asset('front/assets/img/services/services_img01.jpg') }}" alt="">
                                <a href="services-details.html" class="btns transparent-btn">
                                    Purchase Now
                                </a>
                            </div>
                            <div class="list-wrap">
                                <h6 class="title">Tax Strategy</h6>
                                <div class="bottom-content d-flex">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <span style="color:black">
                                            ( 12 )
                                        </span>
                                    </div>
                                    <b>
                                        1234.23 USD
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                @include('partials.product_list_1')
            @empty
            @endforelse
        </div>
    </div>
</section>
@endif
<!-- project-area-two -->

<!-- request-area -->
@if(isset($page->content['contact_banner']['enable']) && $page->content['contact_banner']['enable'] == 'active')
<section class="request-area-two">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="request-content-two">
                    <div class="section-title-two white-title mb-15">
                        <h2 class="title">
                            {{ isset($page->content['contact_banner']['heading']) ? $page->content['contact_banner']['heading'] : 'قم بتواصل معنا' }}
                        </h2>
                    </div>
                    <p>
                        {{ isset($page->content['contact_banner']['description']) ? $page->content['contact_banner']['description'] : 'تعتمد الوكالة على التواصل مع عملائها و متابعيها بشكل دائم من اجل حل مشاكلهم و الاطلاع على استفساراتهم و ملاحظاتهم' }}
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="request-form-wrap">
                    <form action="#">
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-grp">
                                    <input type="text" placeholder="Name *">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-grp">
                                    <input type="email" placeholder="E-mail *">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-grp">
                                    <input type="number" placeholder="Phone *">
                                </div>
                            </div> --}}
                            <div class="col-md-12" style="text-align: left;">
                                <a class="btn btn-warning contact-us-index-button" href="{{ url('contact-us') }}">تواصل معنا</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="request-shape-wrap">
        <img src="{{ asset('front/assets/img/images/h2_request_shape01.png') }}" alt="">
        <img src="{{ asset('front/assets/img/images/h2_request_shape02.png') }}" alt="" data-aos="fade-left" data-aos-delay="200">
    </div>
</section>
@endif
<!-- request-area-end -->

<!-- choose-area -->
@if(isset($page->content['why_choice_us_banner']['enable']) && $page->content['why_choice_us_banner']['enable'] == 'active')
<section class="choose-area-two">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="about-img-wrap-four">
                    <div class="mask-img-wrap">
                        <img src="{{ isset($page->content['why_choice_us_banner']['thumbnail_id']) ? upload_assets($page->content['why_choice_us_banner']['thumbnail_id'],true) : asset('front/assets/img/images/h3_about_img01.jpg') }}" alt="">
                    </div>
                    <div class="icon"><i class="flaticon-business-presentation"></i></div>
                    <img src="{{ asset('front/assets/img/images/h3_about_img02.jpg') }}" alt="" class="img-two">
                    <div class="about-shape-wrap-three">
                        <img src="assets/img/images/h3_about_shape01.png" alt="">
                        <img src="assets/img/images/h3_about_shape02.png" alt="">
                        <img src="assets/img/images/h3_about_shape03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-content-two">
                    <div class="section-title-two white-title mb-30">
                        <span class="sub-title">
                            {{ isset($page->content['why_choice_us_banner']['sub_heading']) ? $page->content['why_choice_us_banner']['sub_heading'] : 'لماذا نحن أفضل اختيار لك' }}
                        </span>
                        <h2 class="title" data-aos="fade-up" data-aos-delay="0">
                            {{ isset($page->content['why_choice_us_banner']['heading']) ? $page->content['why_choice_us_banner']['heading'] : 'لدى الخطوة الرائدة العديد من المزايا و الخدمات المهمة و المفيدة' }}
                        </h2>
                    </div>
                    <p data-aos="fade-in" data-aos-delay="2">
                        {!! isset($page->content['why_choice_us_banner']['description']) ? $page->content['why_choice_us_banner']['description'] : '' !!}
                    </p>
                    <div class="choose-circle-wrap">
                        <div class="circle-item">
                            <div class="chart" data-percent="{{ isset($page->content['why_choice_us_banner']['percentage_number'][0]) ? $page->content['why_choice_us_banner']['percentage_number'][0] : 100 }}">
                                <div class="circle-content">
                                    <span class="percentage">{{ isset($page->content['why_choice_us_banner']['percentage_number'][0]) ? $page->content['why_choice_us_banner']['percentage_number'][0] : 100 }}%</span>
                                    <p>
                                        {{ isset($page->content['why_choice_us_banner']['percentage_title'][0]) ? $page->content['why_choice_us_banner']['percentage_title'][0] : 100 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="circle-item">
                            <div class="chart" data-percent="{{ isset($page->content['why_choice_us_banner']['percentage_number'][1]) ? $page->content['why_choice_us_banner']['percentage_number'][1] : 100 }}">
                                <div class="circle-content">
                                    <span class="percentage">{{ isset($page->content['why_choice_us_banner']['percentage_number'][1]) ? $page->content['why_choice_us_banner']['percentage_number'][1] : 100 }}%</span>
                                    <p>
                                        {{ isset($page->content['why_choice_us_banner']['percentage_title'][1]) ? $page->content['why_choice_us_banner']['percentage_title'][1] : 100 }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="circle-item">
                            <div class="chart" data-percent="{{ isset($page->content['why_choice_us_banner']['percentage_number'][2]) ? $page->content['why_choice_us_banner']['percentage_number'][2] : 100 }}">
                                <div class="circle-content">
                                    <span class="percentage">{{ isset($page->content['why_choice_us_banner']['percentage_number'][2]) ? $page->content['why_choice_us_banner']['percentage_number'][2] : 100 }}%</span>
                                    <p>
                                        {{ isset($page->content['why_choice_us_banner']['percentage_title'][2]) ? $page->content['why_choice_us_banner']['percentage_title'][2] : 100 }}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="choose-shape">
        <img src="{{ asset('front/assets/img/images/choose_shape.png') }}" alt="" data-aos="fade-right" data-aos-delay="200">
    </div>
</section>
@endif
<!-- choose-area-end -->

<!-- testimonial-area -->
@if(isset($page->content['our_reviews_banner']['enable']) && $page->content['our_reviews_banner']['enable'] == 'active')
<section class="testimonial-area-five">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="testimonial-img-five">
                    <img src="{{ isset($page->content['our_reviews_banner']['thumbnail_id']) ? upload_assets($page->content['our_reviews_banner']['thumbnail_id'],true) : asset('front/assets/img/images/h5_testimonial_img.png') }}" alt="">
                    <img src="{{ asset('front/assets/img/images/h5_testimonial_shape01.png') }}" alt="" class="shape-one">
                    <img src="{{ asset('front/assets/img/images/h5_testimonial_shape02.png') }}" alt="" class="shape-two">
                    <img src="{{ asset('front/assets/img/images/h5_testimonial_shape03.png') }}" alt="" class="shape-three">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="testimonial-content-five">
                    <div class="section-title title-three mb-50">
                        <span class="sub-title">
                            {{ isset($page->content['our_reviews_banner']['sub_heading']) ? $page->content['our_reviews_banner']['sub_heading'] : 'تجارب عملائنا و ارائهم' }}
                        </span>
                        <h2 class="title">
                            {{ isset($page->content['our_reviews_banner']['heading']) ? $page->content['our_reviews_banner']['heading'] : 'تهتم دائما منصتنا على تحسين خدماتها لتنول رضا عملائها ' }}
                        </h2>
                    </div>
                    <div class="testimonial-item-wrap-five">
                        <div class="testimonial-active-five">
                            @isset($page->content['our_reviews_banner']['reviewer_name'])
                                @if(count($page->content['our_reviews_banner']['reviewer_name']) > 0)
                                    @for($i = 0; $i < count($page->content['our_reviews_banner']['reviewer_name']);$i++)
                                        <div class="testimonial-item">
                                            <div class="testimonial-content">
                                                <div class="content-top">
                                                    <div class="rating">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    </div>
                                                    <div class="testimonial-quote">
                                                        <img src="{{ asset('front/assets/img/icons/quote.svg') }}" alt="">
                                                    </div>
                                                </div>
                                                <p>“ {{ isset($page->content['our_reviews_banner']['reviewer_description'][$i]) ? $page->content['our_reviews_banner']['reviewer_description'][$i] : '-' }}</p>
                                                <div class="testimonial-avatar">
                                                    <div class="avatar-thumb">
                                                        <img src="{{ asset('front/assets/img/user_avatar.png') }}" alt="">
                                                    </div>
                                                    <div class="avatar-info">
                                                        <h2 class="title">{{ isset($page->content['our_reviews_banner']['reviewer_name'][$i]) ? $page->content['our_reviews_banner']['reviewer_name'][$i] : '-' }}</h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                @endif
                            @endisset
                        </div>
                        <div class="testimonial-nav-five"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- testimonial-area-end -->
@endsection
