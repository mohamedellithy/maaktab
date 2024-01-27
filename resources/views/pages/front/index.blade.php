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
    <!-- ====== Hero Start ====== -->
    <section class="banner-top">
        <div class="container-fluid">
            <div class="row ">
                @if(isset($page->content['slider_banner']['enable']) && $page->content['slider_banner']['enable'] == 'active')
                    <img src="{{ isset($page->content['slider_banner']['thumbnail_id']) ? upload_assets($page->content['slider_banner']['thumbnail_id'],true) : asset('front/assets/images/banner/banner-2.png') }}" />
                @else
                   <img style="height: 700px;" src="{{ asset('front/assets/images/banner/default-banner-slider.jpg') }}" />
                @endif
            </div>
        </div>
    </section>
    <!-- ====== Hero End ====== -->
    <!-- brand-area -->
    @if(isset($page->content['partner_banner']['enable']) && $page->content['partner_banner']['enable'] == 'active')
        <div class="ud-features" style="padding-bottom: 10px;">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12 ">
                        <div class="ud-brands">
                            <div class="ud-title wow fadeIn">
                                <h5 style="color: #692b91;">
                                    {{ isset($page->content['partner_banner']['sub_heading']) ? $page->content['partner_banner']['sub_heading'] : 'موثوق به من قبل أكثر من 1000 شركة فى منظقة الشرق الأوسط' }}
                                </h5>
                            </div>
                            <div class="ud-brands-logo " style="justify-content: space-between;">
                                @isset($page->content['partner_banner']['thumbnails_id'])
                                    @php $animation_delay = 0 @endphp
                                    @foreach(GetAttachments($page->content['partner_banner']['thumbnails_id']) as $attachment)
                                        @php $animation_delay +=1 @endphp
                                        @php $media = upload_assets($attachment) @endphp
                                        <div class="ud-single-logo" >
                                            <img class="wow fadeInUp" data-wow-delay=".{{ $animation_delay }}s" src="{{ $media }} " alt="ayroui " />
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- ======== about ==========-->
    @if(isset($page->content['about_banner']['enable']) && $page->content['about_banner']['enable'] == 'active')
        <section id="about" class="ud-about-us">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="about-us-inner">
                            <img class="shape shape-2 wow fadeInDown" data-wow-delay=".5s " src="{{ asset('front/assets/images/team/dotted-shape.svg') }}" />
                            <span class="section-sub">
                                {{ isset($page->content['about_banner']['sub_heading']) ? $page->content['about_banner']['sub_heading']  : 'تعرف علينا' }}
                            </span>
                            <h4 class="wow fadeInDown" data-wow-delay=".5s ">
                                {{ isset($page->content['about_banner']['heading']) ? $page->content['about_banner']['heading']  : 'الخطوة الرائدة للتجارة و الاستثمار فى الشرق الأوسط' }}
                            </h4>
                            <p class="wow fadeIn" data-wow-delay=".9s ">
                                {!! $page->content['about_banner']['description'] !!}
                            </p>
                            <img class="shape shape-1 wow fadeInUp" data-wow-delay=".3s " src="{{ asset('front/assets/images/team/dotted-shape.svg') }}" />
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="shap-image">
                            <div class="main-shap">
                                <img src="{{ isset($page->content['about_banner']['thumbnail_id_big']) ? upload_assets($page->content['about_banner']['thumbnail_id_big'],true) : asset('front/assets/img/images/h2_about_img01.jpg') }}" class="wow fadeIn" data-wow-delay=".1s " />
                            </div>
                            <img class="shape shape-1 wow fadeInDown" data-wow-delay=".2s "  src="{{ asset('front/assets/images/team/dotted-shape.svg') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ======== ==========-->
    @endif

    <!-- ====== Features Start ====== -->
    @if(isset($page->content['introduce_banner']['enable']) && $page->content['introduce_banner']['enable'] == 'active')
        <section id="features " class="ud-features" style="padding-top:50px">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-12 ">
                        <div class="ud-section-title text-center" style="margin: 70px auto;">
                            <span>
                                {{ isset($page->content['introduce_banner']['heading']) ? $page->content['introduce_banner']['heading'] : 'تغيير طريقة العمل لأفضل حلول الأعمال' }}
                            </span>
                            <h2>
                                {{ isset($page->content['introduce_banner']['sub_heading']) ? $page->content['introduce_banner']['sub_heading'] : 'ماذا نحن نقدم' }}
                            </h2>
                            <p>
                                {{ isset($page->content['introduce_banner']['description']) ? $page->content['introduce_banner']['description'] : 'تغيير طريقة العمل لأفضل حلول الأعمال' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row ">
                    @if(isset($page->content['introduce_banner']['feature_title']) && count($page->content['introduce_banner']['feature_title']) > 0)
                        @php $counter = 0  @endphp
                        @for($item = 0; $item < 4; $item++)
                            @php $counter += 2  @endphp
                            <div class="col-xl-3 col-lg-3 col-sm-6 ">
                                <div class="ud-single-feature wow fadeInUp " data-wow-delay=".{{ $counter }}s ">
                                    <div class="ud-feature-icon ">
                                        <i class="lni lni-layers "></i>
                                    </div>
                                    <div class="ud-feature-content ">
                                        <h3 class="ud-feature-title ">
                                            {{ isset($page->content['introduce_banner']['feature_title'][$item]) ? $page->content['introduce_banner']['feature_title'][$item] : 'تغيير طريقة العمل لأفضل حلول الأعمال' }}
                                        </h3>
                                        <p class="ud-feature-desc ">
                                            {{ isset($page->content['introduce_banner']['feature_description'][$item]) ? $page->content['introduce_banner']['feature_description'][$item] : 'ماذا نحن نقدم' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
            </div>
        </section>
    @endif
    <!-- ====== Features End ====== -->


    <!-- ====== Testimonials Start ====== -->
    @if(isset($page->content['our_reviews_banner']['enable']) && $page->content['our_reviews_banner']['enable'] == 'active')
        <section id="testimonials " class="ud-testimonials " style="padding-top:40px">
            <div class="container ">
                <div class="row ">
                    <div class="col-lg-12 ">
                        <div class="ud-section-title mx-auto text-center ">
                            <span>
                                {{ isset($page->content['our_reviews_banner']['heading']) ? $page->content['our_reviews_banner']['heading'] : 'تهتم دائما منصتنا على تحسين خدماتها لتنول رضا عملائها ' }}
                            </span>
                            <h2>
                                {{ isset($page->content['our_reviews_banner']['sub_heading']) ? $page->content['our_reviews_banner']['sub_heading'] : 'تجارب عملائنا و ارائهم' }}
                            </h2>
                            <p>
                                {{ isset($page->content['our_reviews_banner']['description']) ? $page->content['our_reviews_banner']['description'] : 'تهتم دائما منصتنا على تحسين خدماتها لتنول رضا عملائها ' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    @if(isset($page->content['our_reviews_banner']['reviewer_name']) && count($page->content['our_reviews_banner']['reviewer_name']) > 0)
                        @php
                            $animations = [
                                "fadeIn",
                                "fadeInUp",
                                "fadeInRight"
                            ];
                            $animations_delay = [
                                9,
                                5,
                                1
                            ];
                        @endphp
                        @for($item = 0; $item < count($page->content['our_reviews_banner']['reviewer_name']);$item++)
                            <div class="col-lg-4 col-md-6 ">
                                <div class="ud-single-testimonial wow {{ $animations[$item] }}" data-wow-delay=".{{ $animations_delay[$item] }}s ">
                                    <div class="ud-testimonial-ratings ">
                                        <i class="lni lni-star-filled "></i>
                                        <i class="lni lni-star-filled "></i>
                                        <i class="lni lni-star-filled "></i>
                                        <i class="lni lni-star-filled "></i>
                                        <i class="lni lni-star-filled "></i>
                                    </div>
                                    <div class="ud-testimonial-content ">
                                        <p>
                                            @isset($page->content['our_reviews_banner']['reviewer_description'][$item])
                                                “ {{ $page->content['our_reviews_banner']['reviewer_description'][$item] }}
                                            @endisset
                                        </p>
                                    </div>
                                    <div class="ud-testimonial-info ">
                                        <div class="ud-testimonial-image ">
                                            @isset($page->content['our_reviews_banner']['thumbnail_id'][$item])
                                                @php $media = upload_assets($page->content['our_reviews_banner']['thumbnail_id'][$item],true) @endphp
                                                <img src="{{ $media }}" alt="author " />
                                            @else
                                                <img src="{{ asset('front/assets/images/testimonials/author-01.png') }}" alt="author " />
                                            @endif
                                        </div>
                                        <div class="ud-testimonial-meta ">
                                            @isset($page->content['our_reviews_banner']['reviewer_name'][$item])
                                                <h4>
                                                    {{ $page->content['our_reviews_banner']['reviewer_name'][$item] }}
                                                </h4>
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
            </div>
        </section>
    @endif
    <!-- ====== Testimonials End ====== -->

    <!-- ====== Contact Start ====== -->
    @if(isset($page->content['contact_banner']['enable']) && $page->content['contact_banner']['enable'] == 'active')
        <section id="contact " class="ud-contact ">
            <div class="container ">
                <div class="row align-items-center ">
                    <div class="col-xl-8 col-lg-7 ">
                        <div class="ud-contact-content-wrapper ">
                            <div class="ud-contact-title ">
                                <span>
                                    تواصل معنا
                                </span>
                                <h2>
                                    {{ isset($page->content['contact_banner']['heading']) ? $page->content['contact_banner']['heading'] : 'قم بتواصل معنا' }}
                                </h2>
                                <p>
                                    {{ isset($page->content['contact_banner']['description']) ? $page->content['contact_banner']['description'] : '' }}
                                </p>
                            </div>
                            <div class="ud-contact-info-wrapper ">
                                <div class="ud-single-info ">
                                    <div class="ud-info-icon ">
                                        <i class="lni lni-map-marker "></i>
                                    </div>
                                    <div class="ud-info-meta ">
                                        <h5>عنوانا</h5>
                                        <p>
                                            {{ isset($page->content['contact_banner']['location']) ? $page->content['contact_banner']['location'] : '' }}
                                        </p>
                                    </div>
                                </div>
                                <div class="ud-single-info ">
                                    <div class="ud-info-icon ">
                                        <i class="lni lni-envelope "></i>
                                    </div>
                                    <div class="ud-info-meta ">
                                        <h5>كيف نستطيع مساعداتك ؟</h5>
                                        <p>
                                            {{ isset($page->content['contact_banner']['emails']) ? $page->content['contact_banner']['emails'] : '' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 ">
                        <div class="ud-contact-form-wrapper wow fadeInUp " data-wow-delay=".2s ">
                            <h3 class="ud-contact-form-title ">
                                تواصل معنا
                            </h3>
                            <form class="ud-contact-form ">
                                <div class="ud-form-group ">
                                    <label for="fullName ">الاسم بالكامل *</label>
                                    <input type="text " name="fullName " placeholder="Adam Gelius " />
                                </div>
                                <div class="ud-form-group ">
                                    <label for="email ">البريد الالكترونى *</label>
                                    <input type="email " name="email " placeholder="example@yourmail.com " />
                                </div>
                                <div class="ud-form-group ">
                                    <label for="phone ">رقم الجوال *</label>
                                    <input type="text " name="phone " placeholder="+885 1254 5211 552 " />
                                </div>
                                <div class="ud-form-group ">
                                    <label for="message ">الرسالة *</label>
                                    <textarea name="message " rows="1 " placeholder="type your message here "></textarea>
                                </div>
                                <div class="ud-form-group mb-0 ">
                                    <button type="submit " class="ud-main-btn ">
                                        ارسال الرسالة
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- ====== Contact End ====== -->
@endsection


@push('style')
    <style>
        .ud-header {
            background-color: transparent;
        }
        .sticky {
            position: fixed;
            z-index: 99;
            background-color: rgba(255, 255, 255, 0.8);
            -webkit-backdrop-filter: blur(5px);
            backdrop-filter: blur(5px);
            -webkit-box-shadow: inset 0 -1px 0 0 rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 -1px 0 0 rgba(0, 0, 0, 0.1);
            -webkit-transition: all 0.3s ease-out 0s;
            transition: all 0.3s ease-out 0s;
        }

        .ud-features{
            padding-top: 110px;
        }
        .ud-single-feature .ud-feature-icon{
            margin: 40px auto;
        }
        .ud-single-feature .ud-feature-content {
            text-align: center;
        }
        .ud-section-title h2{
            font-size: 32px;
        }
        .ud-single-testimonial .ud-testimonial-info .ud-testimonial-image{
            margin-left: 20px
        }
        .shap-image{
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            text-align: center;
            box-shadow: -27px 29px 0px 0px #692b91;
            position: relative;
        }
        .shap-image .main-shap{
            margin: auto;
            text-align: center;
            padding: 6px;
        }

        .shap-image .main-shap img{
            width: 100%;
        }

        .shap-image img.shape-1{
            position: absolute;
            right: -46px;
            z-index: -1;
            top: -34px;
        }
        .ud-about-us{
            margin-top: 5%;
            //background-color: #fafafe;
            padding: 6%;
        }
        .about-us-inner{
            position: relative;
        }
        .about-us-inner h4{
            font-weight: bold;
            font-size: 30px;
            line-height: 2em;
            color: #633382;
        }

        .about-us-inner p{
            padding: 2% 1% 6% 14%;
            font-size: 17px;
            line-height: 2.1em;
            color: #312e2e;
            font-weight: 400;
            text-align: justify;
        }
        .about-us-inner .section-sub{
            color: black;
            font-weight: bolder;
        }
        .about-us-inner img.shape-1{
            position: absolute;
            left: 10%;
            z-index: -1;
            bottom: -34px;
        }
        .about-us-inner img.shape-2{
            position: absolute;
            right: 1%;
            z-index: -1;
            top: -100px;
        }
        .ud-contact-info-wrapper .ud-info-icon{
            margin-left: 24px;
            margin-right: unset;
        }


    </style>
@endpush

