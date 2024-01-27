@extends('layouts.master_front')

@push('style')
<link rel="stylesheet" href="{{ asset('front/assets/css/videojs.css') }}" />
@endpush

@section('title')
 {{  'اكتمال الطلب #'.$order->order_no  ?: '' }}
@endsection

@section('content')
   <section class="project-details-area pt-120 pb-120 page-bg">
    <div class="container">
        <div class="row">
            <div class="alert alert-success alert-info-success">
                تم اكتمال الطلب رقم
                <span class="badge bg-info">#{{ $order->order_no }}</span>
                يمكنك الاستفادة من مشاهد و تحميل المرفقات الخاصة بالمنتج
            </div>
        </div>
        <div class="row">
            <div class="container-thanks d-flex">
                <div class="right-thank">
                    <h4>ملفات التحميل</h4>
                    <table class="table table-light">
                        <tr>
                            <th>اسم الملف</th>
                            <td>{{ $order->order_items->product->downloads ? $order->order_items->product->downloads->download_name : $order->order_items->product->name }}</td>
                        </tr>
                        <tr>
                            <th>نوع الملف</th>
                            <td>
                                <span class="badge bg-danger">
                                    {{ $order->order_items->product->downloads ? $order->order_items->product->downloads->download_type : 'NOT SELECTED' }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>وصف الملف </th>
                            <td>
                                {!! $order->order_items->product->downloads ? $order->order_items->product->downloads->download_description : 'NOT ADDED' !!}
                            </td>
                        </tr>
                        @if($order->order_items->product->downloads)
                            @if($order->order_items->product->downloads->download_status == 'download')
                                <tr>
                                    <th> رابط تحميل الملف</th>
                                    <td>
                                        <form method="post" action="{{ route('download_attachments') }}" >
                                            <input name="order_id" type="hidden" value="{{ $order->id }}"/>
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" id="download_files">
                                                تحميل الملف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @elseif($order->order_items->product->downloads->download_status == 'without_download')
                                <tr>
                                    <th> مشاهدة المحتوي الملف</th>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm show_attachments" data-id="{{ $order->order_items->product->downloads->download_attachments_id }}">
                                            الاطلاع على الملفات
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        @endif
                    </table>
                </div>
                <div class="">
                    <div class="order_details">
                        <table class="table table-warning">
                            <tr>
                                <th>رقم الطلب</th>
                                <td># {{ $order->order_no }}</td>
                            </tr>
                            <tr>
                                <th>تكلفة الطلبية</th>
                                <td>{{ formate_price($order->order_total) }}</td>
                            </tr>
                            <tr>
                                <th>اسم المنتج</th>
                                <td>{{ $order->order_items->product->name }}</td>
                            </tr>
                            <tr>
                                <th>كمية</th>
                                <td>{{ $order->order_items->quantity }}</td>
                            </tr>
                            <tr>
                                <th>بوابة الدفع</th>
                                <td>{{ $order->payment->getaway }}</td>
                            </tr>
                            <tr>
                                <th>حالة الطلب</th>
                                <td>{{ $order->order_status }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </section>
<!-- --------------------------------------------------------------------------------------------->
<!-- --------------------------------------------------------------------------------------------->
<!-- --------------------------------------------------------------------------------------------->
   <!-- Downloads -->
<div class="services-application-form" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="services-application-close">
        <span class="close-frame"><i class="fas fa-times"></i></span>
    </div>
    <div class="search-wrap text-center">
        <div class="container">
            <div class="row" id="nb">
                <div class="accordion" id="accordionExample">
                    @include('partials.downloads_lists')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- --------------------------------------------------------------------------------------------->
<!-- --------------------------------------------------------------------------------------------->
<!-- --------------------------------------------------------------------------------------------->
<!-- --------------------------------------------------------------------------------------------->
<!-- review -->
@if(get_settings('reviews_enable') && (get_settings('reviews_enable') == 'active'))
    @if(auth()->user() && (!$my_review = auth()->user()->reviews()->where('product_id',$order->order_items->product->id)->first()))
        <div class="review-popup-form" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="review-popup-form-close">
                <span class="close-frame"><i class="fas fa-times"></i></span>
            </div>
            <div class="search-wrap text-center">
                <div class="container">
                    <div class="row" id="nb">
                        <div class="heading">
                            <h5 class="title text-center" style="margin: 0 0 15px 0;">تقيمات المنتج</h5>
                            <div class="rating">
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                                <i class="fas fa-star active"></i>
                            </div>
                            <h6 class="sub-title text-center">يمكنك مساعدة الاخرين باعطاء رايك فى هذا المنتج</h6>
                        </div>
                        <form id="form-review" action="{{ route('add_review_on_product',$order->order_items->product->id) }}" method="post">
                            @csrf
                            <input type="hidden" @if(auth()->user()) value="0" @endif id="my-review-start" name="degree" required/>
                            <div class="review-card-section col-md-12">
                                <div class="top-section-review">
                                    <div class="right-review">
                                        <img class="reviewer-avatar" src="{{ upload_assets(null,false,"assets/img/avatars/user_avatar.png") }}" />
                                        <span class="reviewr-name">{{ auth()->user() ? auth()->user()->name : ''  }}</span>
                                    </div>
                                    <div class="review-points">
                                        <div class="rating give-rate">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom-section-give" style="paading:0px">
                                    <textarea rows="5" name="review" class="form-control" required>@if(auth()->user()) {{ old('review') }}  @endif</textarea>
                                </div>
                                <div class="give-me" style="text-align: left;padding: 15px 0px;">
                                    <button type="submit" class="btn btn-success btn-sm" style="margin:auto">
                                        اضافة تقيم
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
@endsection

@push('scripts')
    <script>
        jQuery('document').ready(function(){
            setTimeout(() => {
                jQuery('.review-popup-form').slideDown(500);
            }, 2000);

            jQuery('.review-popup-form-close .close-frame').on('click',function(){
                jQuery('.review-popup-form').slideUp(500);
            });
        });
    </script>
    <script>
        jQuery(document).ready(function(){
            jQuery('.rating.give-rate i').on('mouseover',function(){
                jQuery(this).toggleClass('active');
                jQuery(this).prevAll().addClass('active');
                jQuery(this).nextAll().removeClass('active');
            });
            jQuery('.rating.give-rate i').on('mouseout',function(){
                jQuery('#my-review-start').val(jQuery('.rating.give-rate i.active').length);
            });
            jQuery('#toggleEditReview').on('click',function(){
                jQuery('.review-card-section.my-review').slideUp(100);
                jQuery('#form-review').slideDown(100);
            });
        });
    </script>
    <style>
        .services-application-form{
            overflow: auto !important;
        }
        .accordion-button.collapsed{
            background-color: #eee;
            color:black;
        }
        .accordion-button:not(.collapsed) {
            background-color: #aaefc9;
            color:green;
        }
    </style>
  <script>
    jQuery('document').ready(function(){
        jQuery('.show_attachments').click(function(){
            let attachment_id = jQuery(this).attr('data-id');
            jQuery(".services-application-form").slideToggle();
        });
    });

    $(".services-application-form").on('click', '.services-application-close span.close-frame', function() {
        $(".services-application-form").slideUp(500);
        var player = videojs('my-video', {
            controls: true,
        });

        player.on('contextmenu', function(event) {
            event.preventDefault();
        });
        player.currentTime(0);
        player.pause();
    });


  </script>

  <script src="{{ asset('front/assets/js/videojs.min.js') }}"></script>
@endpush
