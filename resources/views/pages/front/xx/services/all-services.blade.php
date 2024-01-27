@extends('layouts.master_front')

@php
$page = ActivePagesMenus(['slug','=','services'])[0];
@endphp

@section('title')
 {{  $page->name  ?: '' }}
@endsection

@section('meta_tags')
<meta name="description" content="{{ isset($page->meta_description) ? $page->meta_description : get_settings('meta_description') }} ">
<meta name="title" content="{{ isset($page->meta_title) ? $page->meta_title : get_settings('meta_title') }} ">
@endsection

@section('content')
<!-- breadcrumb-area -->
<section class="breadcrumb-area breadcrumb-bg page-bg" data-background="{{ asset('front/assets/img/bg/breadcrumb_bg.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <h2 class="title">خدماتنا</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">الرئيسية</a></li>
                            <li class="breadcrumb-item active" aria-current="page">خدماتنا</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumb-shape-wrap">
        <img src="{{ asset('assets/img/images/breadcrumb_shape01.png') }}" alt="">
        <img src="{{ asset('assets/img/images/breadcrumb_shape02.png') }}" alt="">
    </div>
</section>
<!-- breadcrumb-area-end -->


<!-- services-area -->
<section class="services-area-six">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="section-title-two mb-60">
                    <span class="sub-title">
                        {{  isset($page->content['services']['sub_heading']) ? $page->content['services']['sub_heading'] : 'خدماتنا' }}
                    </span>
                    <h2 class="title">
                        {{  isset($page->content['services']['heading']) ? $page->content['services']['heading'] : 'تصفح خدماتنا و استفد من مميزات عديدة' }}
                    </h2>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8">
                <form id="filter-form" method="get" action="" >
                    <div class="section-filters d-flex mb-50">
                        <div class="form-group">
                            <input name="search" @isset($search) value="{{ $search }}" @endisset class="form-control" placeholder="البحث فى الخدمات"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @forelse($services as $service)
                @include('partials.services_list_card_1')
            @empty
            @endforelse
            <div class="alert">
                <br/>
                {{ $services->links() }}
            </div>
        </div>
    </div>
</section>
<!-- services-area-end -->

@endsection

@push('scripts')
<style>
    .page-bg{
        margin-top: 140px !important;
    }
</style>
@endpush
