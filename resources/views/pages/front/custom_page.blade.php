@extends('layouts.master_front')

@section('meta_tags')
<meta name="description" content="{{ isset($page->meta_description) ? $page->meta_description : get_settings('meta_description') }} ">
<meta name="title" content="{{ isset($page->meta_title) ? $page->meta_title : get_settings('meta_title') }} ">
@endsection

@section('title')
 {{  $page->title }}
@endsection

@section('content')
<section class="about-area about-bg" style="margin-top:50px">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            @if(!$page)
                <!-- Error -->
                <div class="container-xxl container-p-y" style="text-align: center;">
                    <div class="misc-wrapper">
                        <h2 class="mb-2 mx-2">الصفحة غير موجودة</h2>
                        <p class="mb-4 mx-2">الصفحة التى تحاول الوصول اليها غير موجود</p>
                        {{-- <a href="index.html" class="btn btn-primary">Back to home</a> --}}
                        <div class="mt-3">
                            <img
                            src="../assets/img/illustrations/page-misc-error-light.png"
                            alt="page-misc-error-light"
                            width="500"
                            class="img-fluid"
                            data-app-dark-img="illustrations/page-misc-error-dark.png"
                            data-app-light-img="illustrations/page-misc-error-light.png"
                            />
                        </div>
                    </div>
                </div>
                <!-- /Error -->
            @else
                <div class="col-lg-6">
                    <div class="choose-content-two">
                        <div class="section-title-two white-title">
                            <span class="sub-title" data-aos="fade-down" data-aos-delay="0">
                                {{ isset($page->title) ? $page->title : '' }}
                            </span>
                            <h2 class="title" data-aos="fade-up" data-aos-delay="10" style="color: #1e3668;">
                                {{ isset($page->title) ? $page->title : '' }}
                            </h2>
                        </div>
                        <br/>
                        <div class="content-custom-page" data-aos="fade-in" data-aos-delay="30">
                            {!! isset($page->content) ? $page->content : '' !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8 thumbnail-custom-page" data-aos="fade-right" data-aos-delay="0">
                    <div class="about-img-wrap-four">
                        <div class="mask-img-wrap">
                            <img  src="{{ isset($page->thumbnail_id) ? upload_assets($page->thumbnail_id,true) : asset('front/assets/img/images/h3_about_img01.jpg') }}" alt="">
                        </div>
                        <div class="icon"><i class="flaticon-business-presentation"></i></div>
                        {{-- <img src="{{ asset('front/assets/img/images/h3_about_img02.jpg') }}" alt="" class="img-two"> --}}
                        <div class="about-shape-wrap-three">
                            <img src="assets/img/images/h3_about_shape01.png" alt="">
                            <img src="assets/img/images/h3_about_shape02.png" alt="">
                            <img src="assets/img/images/h3_about_shape03.png" alt="">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    {{-- <div class="choose-shape">
        <img src="{{ asset('front/assets/img/images/choose_shape.png') }}" alt="" data-aos="fade-right" data-aos-delay="200">
    </div> --}}
</section>
@endsection