@extends('layouts.master_front')

@php
$page = ActivePagesMenus(['slug','=','shop'])[0];
$order_by = request('order_by');
$search   = request('search');
@endphp

@section('meta_tags')
<meta name="description" content="{{ isset($page->meta_description) ? $page->meta_description : get_settings('meta_description') }} ">
<meta name="title" content="{{ isset($page->meta_title) ? $page->meta_title : get_settings('meta_title') }} ">
@endsection

@section('title')
 {{  $page->title ?: '' }}
@endsection

@section('content')
<!-- project-area -->
<section class="project-area project-bg page-bg" data-background="assets/img/bg/project_bg.jpg">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-8">
                <div class="section-title-two mb-50">
                    <span class="sub-title">
                        {{ isset($page['shop']['sub_heading']) ? $page['shop']['sub_heading'] : 'منتجاتنا الرقمية' }}
                    </span>
                    <h4 class="title">
                        {{ isset($page['shop']['heading']) ? $page['shop']['heading'] : 'توفر الخطوة الرائدة العديد من المنتجات الرقمية المتميزة' }}
                    </h4>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8">
                <form id="filter-form" method="get" action="" >
                    <div class="section-filters d-flex mb-50">
                        <div class="form-group">
                            <select name="order_by" onchange="document.getElementById('filter-form').submit()" class="form-control">
                                <option value="">ترتيب</option>
                                <option value="high-price" @isset($order_by) @if($order_by == 'high-price') selected @endif @endisset>الأعلى سعراً</option>
                                <option value="low-price"  @isset($order_by) @if($order_by ==  'low-price') selected @endif @endisset>الأقل سعراً</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="search" @isset($search) value="{{ $search }}" @endisset class="form-control" placeholder="البحث فى المنتجات"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row products-active">
            @forelse($products as $product)
                @include('partials.product_list_1')
            @empty
               empty
            @endforelse
            <div class="alert">
                <br/>
                {{ $products->links() }}
            </div>
        </div>
    </div>
</section>
<!-- project-area-two -->

@endsection
