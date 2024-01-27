@extends('layouts.master_front')


@section('content')
    <!-- ====== Blog Details Start ====== -->
    <section class="ud-blog-details">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="ud-blog-details-content">
                <h2 class="ud-blog-details-title">
                  <i class="lni lni-layers"></i>
                  {{ $project->name }}
                </h2>
                <p class="ud-blog-details-para">
                  {!! $project->description !!}
                </p>
                @if($project->downloads)
                    <div class="ud-project-attachments">
                        <h4 style="line-height: 3em;">
                            <i class="lni lni-link"></i>
                            مرفقات المشروع
                        </h4>
                        <ul class="list-attachments">
                            <li class="attachments-list-item">
                                <h6>
                                    <i class="lni lni-link"></i>
                                    {{ $project->downloads->download_name }}
                                </h6>
                                @if($project->downloads->download_status == 'download')
                                    <a class="btn btn-dark btn-sm" href="{{ isset($project->downloads->download_link) ? $project->downloads->download_link : upload_assets($project->downloads->download_attachments_id,true) }}" download>
                                        تنزيل المرفقات
                                    </a>
                                @else
                                    <a class="btn btn-dark btn-sm" data-fslightbox="gallery" href="{{ isset($project->downloads->download_link) ? $project->downloads->download_link : upload_assets($project->downloads->download_attachments_id,true) }}">
                                        عرض المرفقات
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </div>
                @endif
                <div class="ud-blog-details-action">
                    <ul class="ud-blog-tags">
                        @if($project->main_category_id)
                            @php $main_category = \App\Models\Category::find($project->main_category_id) @endphp
                            @if($main_category)
                                <li>
                                    <a href="javascript:void(0)">{{  $main_category->name }}</a>
                                </li>
                            @endif
                        @endif
                        @if($project->child_category_id)
                            @php $child_category = \App\Models\Category::find($project->child_category_id) @endphp
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
                        <h3 class="ud-newsletter-title">
                            <i class="lni lni-thumbs-up"></i>
                        </h3>
                        <h3 class="ud-newsletter-title">هل هذا ما تبحث عنه !</h3>
                        <form class="ud-newsletter-form">
                            @if($project->price)
                                <span style="color:white">تكلفة المشروع</span>
                                <h2 class="project-cost">{!! html_price($project) !!}</h2>
                            @endif
                            <a href="{{ route('application_form',['application_id' => $project->application_id,'selected_id' => $project->id,'selected' => 'project']) }}" class="ud-main-btn">طلب مشروع مماثل</a>
                            <p class="ud-newsletter-note">يمكنك طلب مشروع مماثل مع بعض التغيرات</p>
                        </form>
                    </div>
                </div>
                @if($project->from && $project->to)
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
                            <h6 class="ud-newsletter-title">
                                <i class="lni lni-timer"></i>
                            </h6>
                            <h6 class="ud-newsletter-title ud-newsletter-title-2">مدة تنفيذ المشروع</h6>
                            <ul class="dates-lists">
                                <li>
                                    <label>من </label>
                                    <span>{{ $project->from }}</span>
                                </li>
                                <li>
                                    <label>الى </label>
                                    <span>{{ $project->to }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
                @if($project->attachments_id)
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
                        <h6 class="ud-newsletter-title">
                            <i class="lni lni-image"></i>
                        </h6>
                        <h6 class="ud-newsletter-title ud-newsletter-title-2">صور للمشروع</h6>
                        <ul class="lists-media">
                            @foreach(GetAttachments($project->attachments_id) as $attachment)
                                <li>
                                    <a data-fslightbox="gallery" href="{{ upload_assets($attachment) }}">
                                        <img src="{{ upload_assets($attachment) }}"  />
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
          </div>
        </div>
      </section>
      <!-- ====== Blog Details End ====== -->

      <!-- ====== Blog Start ====== -->
      {{-- <section class="ud-blog-grids ud-related-articles">
        <div class="container">
          <div class="row col-lg-12">
            <div class="ud-related-title">
              <h2 class="ud-related-articles-title">المشاريع المماثلة</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4 col-md-6">
              <div class="ud-single-blog">
                <div class="ud-blog-image">
                  <a href="blog-details.html">
                    <img src="{{ asset('front/assets/images/blog/blog-01.jpg') }}" alt="blog" />
                  </a>
                </div>
                <div class="ud-blog-content">
                  <span class="ud-blog-date">Dec 22, 2023</span>
                  <h3 class="ud-blog-title">
                    <a href="blog-details.html">
                      Meet AutoManage, the best AI management tools
                    </a>
                  </h3>
                  <p class="ud-blog-desc">
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> --}}
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
        padding-top: 120px;
    }
    .ud-newsletter-box{
        background-color: black;
    }
    .ud-newsletter-title-2{
        font-size: 16px !important;
        line-height: 3em;
    }
    .dates-lists li{
        display: flex;
        justify-content: space-between;
        color: white;
        background-color: #1a1a1a;
        padding: 10px;
        margin: 16px;
    }
    .lists-media{
        display: flex;
        flex-wrap: wrap;
    }
    .lists-media li{
        width: 43%;
        padding: 5px;
        background-color: orange;
        margin: 10px;
    }
    .ud-blog-sidebar,
    .ud-blog-details-content{
        padding-top: 0px;
    }
    .list-attachments li{
        background-color: #E3F2FD;
        padding: 14px;
        margin: 14px;
    }
    .ud-blog-details-title{
        font-size: 30px;
    }
    .attachments-list-item{
        display: flex;
        justify-content: space-between;
    }
</style>
@endpush


@push('script')
    <script type="text/javascript" src="{{ asset('front/assets/js/fslightbox.js') }}"></script>
@endpush
