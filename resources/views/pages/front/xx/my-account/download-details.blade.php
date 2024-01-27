@extends('layouts.master_front')

@push('style')
<link rel="stylesheet" href="{{ asset('front/assets/css/videojs.css') }}" />
@endpush

@section('content')
 <!-- project-details-area -->
 <section class="project-details-area pt-120 pb-120 page-bg">
    <div class="container">
        <div class="row">
            <div class="dashboard d-flex">
                <div class="menu-account">
                    @include('inc.customer_menu')
                </div>
                <div class="content-page">
                    <div class="right-thank">
                        <h4>مرفقات المنتج</h4>
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
                                @if($order->order_items->product->downloads->download_type == 'zoom')
                                    <tr>
                                        <th> رابط الانضمام</th>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{ $order->order_items->product->downloads->download_link }}" >
                                               الانضمام
                                            </a>
                                        </td>
                                    </tr>
                                @else
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
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- project-details-area-end -->

<!-- header-search -->
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
<!-- header-search-end -->
@endsection


@push('scripts')
    <style>
        .services-application-form{
            overflow: auto !important;
        }
        .accordion-button.collapsed{
            background-color: var(--bs-orange);
            color:black;
        }
        .accordion-button:not(.collapsed) {
            background-color: var(--tg-metallic-blue);
            color: white;
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
