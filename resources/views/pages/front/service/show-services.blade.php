@extends('layouts.master_front')

@section('content')
{{-- <section class="ud-page-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-banner-content">
            <h1>خدماتنا</h1>
          </div>
        </div>
      </div>
    </div>
  </section> --}}

  <section class="ud-blog-grids">
    <div class="container">
        <div class="row">
            <div class="top-layout">
                <div class="form-group">
                    <h4>تصفح خدماتنا </h4>
                    <hr class="line-isolate"/>
                </div>
                <div class="left-section d-flex">
                    <div class="form-group" style="margin:auto 10px;">
                        <input type="text" placeholder="البحث فى الخدمات" class="form-control"/>
                    </div>
                    <div class="form-group" style="margin:auto 10px;">
                        <select class="form-control">
                            <option value="">الترتيب</option>
                            <option vlaue="20">20</option>
                            <option vlaue="40">40</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($services as $service)
                <div class="col-lg-4 col-md-6">
                    <div class="ud-single-blog">
                        <div class="ud-blog-image">
                        <a href="{{ url('service/'.$service->slug) }}">
                            <img src="{{ upload_assets($service->image_info) }}" alt="blog">
                        </a>
                        </div>
                        <div class="ud-blog-content">
                        <h3 class="ud-blog-title">
                            <a href="{{ url('service/'.$service->slug) }}">
                              {{ $service->name }}
                            </a>
                        </h3>
                        <p class="ud-blog-desc">
                            {{ TrimLongText($service->description,50) }}
                        </p>
                        <a href="{{ url('service/'.$service->slug) }}" class="btn btn-dark btn-sm">
                            تفاصيل الخدمة
                        </a>
                        @if($service->application_id)
                            <a href="{{ route('application_form',['application_id' => $service->application_id,'selected_id' => $service->id,'selected' => 'service' ]) }}" class="btn btn-primary btn-sm" style="background-color:#692b91;bordeR:1px solid #692b91">
                                طلب الخدمة
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
  </section>
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
    .sticky .navbar-nav .nav-item a,
    .sticky .navbar-btn .ud-main-btn.ud-login-btn{
        color:white;
    }
    .ud-blog-grids{
        padding-top: 25px;
    }
    .ud-page-banner{
        margin-top: -36px;
        background-color: #031244;
    }
    .ud-single-blog{
        background-color: #1283f308;
        padding: 27px;
    }
    .top-layout{
        padding: 20px 10px;
        padding-top:6%;
        display: flex;
        justify-content: space-between;
    }
    .ud-single-blog {
        background-color: #692b9112;
        padding: 45px;
        border-radius: 10% 0% 10% 0%;
        box-shadow: -6px 8px 0px 6px #692b9129;
    }
    .ud-single-blog .ud-blog-desc{
        padding-bottom: 20px;
    }
</style>
@endpush
