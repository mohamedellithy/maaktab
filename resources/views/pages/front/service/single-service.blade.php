@extends('layouts.master_front')


@section('content')
    <!-- ====== Blog Details Start ====== -->
    <section class="ud-blog-details">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="ud-blog-details-content">
                <h2 class="ud-blog-details-title">
                    <i class="lni lni-bookmark"></i>
                  {{ $service->name }}
                </h2>
                <p class="ud-blog-details-para">
                  {!! $service->description !!}
                </p>
                <div class="ud-blog-details-action">
                  <ul class="ud-blog-tags">
                    @if($service->main_category_id)
                        @php $main_category = \App\Models\Category::find($service->main_category_id) @endphp
                        @if($main_category)
                            <li>
                                <a href="javascript:void(0)">{{  $main_category->name }}</a>
                            </li>
                        @endif
                    @endif
                    @if($service->child_category_id)
                        @php $child_category = \App\Models\Category::find($service->child_category_id) @endphp
                        @if($child_category)
                            <li>
                                <a href="javascript:void(0)">{{  $child_category->name }}</a>
                            </li>
                        @endif
                    @endif
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="ud-blog-sidebar">
                <div class="ud-newsletter-box">
                    <img
                        src="{{ asset('front/assets/images/blog/dotted-shape.svg') }}"
                        alt="shape"
                        class="shape shape-1"
                    />
                    <img
                        src="{{ asset('front/assets/images/blog/dotted-shape.svg') }}"
                        alt="shape"
                        class="shape shape-2"
                    />
                    <h3 class="ud-newsletter-title">هل هذا ما تبحث عنه !</h3>
                    <form class="ud-newsletter-form">
                        <a href="{{ route('application_form',['application_id' => $service->application_id,'selected_id' => $service->id,'selected' => 'service']) }}" class="ud-main-btn ud-main-btn-orange">طلب الخدمة</a>
                    </form>
                    @if($service->whatsapStatus == 1)
                        <form class="ud-newsletter-form">
                            <p class="ud-newsletter-note">يمكنك ايضا </p>
                            <a target="_blank" href="{{ 'https://wa.me/'.$service->whatsapNumber.'?text='.urlencode(' أريد طلب خدمة  ' .$service->name ) }}" class="ud-main-btn">تواصل على الواتس</a>
                        </form>
                    @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ====== Blog Details End ====== -->

      <!-- ====== Blog Start ====== -->
      <section class="ud-blog-grids ud-related-articles">
        <div class="container">
          <div class="row col-lg-12">
            <div class="ud-related-title">
              <h2 class="ud-related-articles-title">خدمات اخري</h2>
            </div>
          </div>
          <div class="row">
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
          </div>
        </div>
      </section>
      <!-- ====== Blog End ====== -->
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
    .ud-related-articles-title::after{
        right: 0;
        left:auto !important;
    }
    .project-cost{
        color: orange;
        line-height: 2em;
    }
    .ud-blog-details-action{
        padding: 30px 0px;
    }
    .ud-blog-tags,.ud-blog-share-links{
        flex-direction: row-reverse;
    }
    .ud-blog-details {
        padding-top: 80px;
    }
    .ud-single-blog {
        background-color: #692b9112;
        padding: 45px;
    }
    .ud-newsletter-form p{
        line-height: 3em !important;
    }
    .ud-newsletter-box {
        background: #1e1c1f;
    }
    .ud-single-blog .ud-blog-desc{
        padding-bottom: 20px;
    }
    .ud-main-btn-orange{
        background-color: orange !important;
    }
</style>
@endpush
