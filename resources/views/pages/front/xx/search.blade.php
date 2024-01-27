@extends('layouts.master_front')

@section('meta_tags')
<meta name="description" content="{{ isset($page->meta_description) ? $page->meta_description : get_settings('meta_description') }} ">
<meta name="title" content="{{ isset($page->meta_title) ? $page->meta_title : get_settings('meta_title') }} ">
@endsection

@section('title')
نتائج البحث عن " {{  $search }} "
@endsection

@section('content')
<section class="about-area about-bg" style="margin-top:50px">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            @if($search)
                <div class="col-lg-12">
                    <div class="choose-content-two">
                        <div class="section-title-two white-title">
                            <span class="sub-title" data-aos="fade-down" data-aos-delay="0">
                                {{ 'صفحة البحث' }}
                            </span>
                            <h2 class="title" data-aos="fade-up" data-aos-delay="10" style="color: #1e3668;">
                                نتائج البحث عن " {{ isset($search) ? $search : '' }} "
                            </h2>
                        </div>
                        <br/>
                        <div class="content-custom-page" data-aos="fade-in" data-aos-delay="30">
                            @include('partials.search_results')
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
