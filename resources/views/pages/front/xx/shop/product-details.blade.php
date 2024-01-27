
@extends('layouts.master_front')
@section('title')
{{ $product->name }}
@endsection

@section('meta_tags')
<meta name="description" content="{{ $product->meta_description ?: get_settings('meta_description') }} ">
<meta name="title" content="{{ $product->meta_name ?: $product->name }} ">
@endsection


@section('content')
<!-- team-details-area -->
<section class="team-details-area pt-120 pb-120 page-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="team-details-info-wrap">
                    <div class="team-details-thumb">
                        <img src="{{ upload_assets($product->image_info) }}" alt="">
                    </div>
                    <div class="team-details-info">
                        <ul class="list-wrap d-flex">
                            @if($product->attachments_id)
                                @foreach(GetAttachments($product->attachments_id) as $attachment)
                                    <li>
                                        <img src="{{ upload_assets($attachment) }}"  />
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" style="position: relative;">

                <span class="badge bg-danger price-value" style="direction: ltr;background: linear-gradient(164deg, rgb(162, 2, 63) 11.2%, rgb(231, 62, 68) 53.6%, rgb(255, 129, 79) 91.1%);">
                    {!! html_price($product) !!} <br/> {{ convert_price_to_Omr(get_price_after_discount($product)) }}
                </span>

                <div class="team-details-content">
                    <h2 class="title">
                        {{ $product->name }}
                    </h2>
                    <span>
                        منتج رقمي
                    </span>
                        @include('partials.stars_list')
                        @include('partials.countdown')
                    <br/>
                    <b>نبذة عن المنتج</b>
                    <p>
                        {{ $product->short_description }}
                    </p>
                    <br/>
                    <b>نوع المنتج</b>
                    <p>
                        <span class="badge bg-info">
                           {{ $product->downloads ? ucfirst($product->downloads->download_type) : 'Not Selected' }}
                        </span>
                    </p>
                    <br/>
                    @if($coupon)
                        <form class="coupon-form-apply" action="#" method="post">
                            <div class="coupon-form">
                                <p>هل تمتلك كوبون خصم ؟ يمكن تطبيقه هنا</p>
                                <input class="form-control coupon_code" placeholder="الصق كود الخصم هنا" name="coupon_code" required/>
                                <button type="submit" class="btn btn-apply-code">تطبيق</button>
                            </div>
                        </form>
                    @endif
                    <form action="{{ route('buy_now') }}"" method="post">
                        @csrf
                        <input type="hidden" name="coupon_code" class="coupon_code_buy" />
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        <input type="hidden" name="qty"        value="1" />
                        <button type="submit" class="btns btns-secondary-color">
                                شراء الأن
                        </button>
                    </form>
                    <br/>
                    <br/>
                    <b>تفاصيل المنتج</b>
                    <p>
                       {!! $product->description !!}
                    </p>
                </div>
                <!-- reviews sections -->
                @if(get_settings('reviews_enable') && (get_settings('reviews_enable') == 'active'))
                    <div class="row">
                        @php $my_review = auth()->user() ? (auth()->user()->reviews()  ? auth()->user()->reviews()->where('product_id',$product->id)->first() : null) : null @endphp
                        @php $allow_review_product = customer_allow_to_review_product($product->id) @endphp
                        <div class="clients-reviews">
                            @if(auth()->user() && ($my_review))
                                <h5> يسعدنا تقيمك على المنتج</h5>
                                <div id="my-review-show" class="review-card-section my-review col-md-12">
                                    <div class="top-section-review">
                                        <div class="right-review">
                                            <img class="reviewer-avatar" src="{{ upload_assets(null,false,"assets/img/avatars/user_avatar.png") }}" />
                                            <span class="reviewr-name">
                                                {{ auth()->user()->name }}
                                            </span>
                                        </div>
                                        <div class="review-points">
                                            <div class="rating">
                                                @if($my_review->degree > 5)
                                                    @php $my_review->degree = 5 @endphp
                                                @endif

                                                ( {{ $my_review->degree }} )
                                                @for($i = 1;$i <= $my_review->degree;$i++)
                                                    <i class="fas fa-star active"></i>
                                                @endfor

                                                @for($i=1;$i <= 5-$my_review->degree;$i++)
                                                    <i class="fas fa-star"></i>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottom-section-review">
                                        <p>
                                            {{ $my_review->review }}
                                        </p>
                                    </div>
                                    <div class="give-me" style="text-align: left;padding: 15px 0px;">
                                        <button id="toggleEditReview" class="btn btn-info btn-sm" style="margin:auto">
                                            تعديل التقيم
                                        </button>
                                    </div>
                                </div>
                            @endif

                            @if((auth()->user() && !$my_review && $allow_review_product) || ($my_review))
                                <form id="form-review" action="{{ route('add_review_on_product',$product->id) }}#my-review-show" @if(auth()->user() && $my_review ) style="display:none" @endif method="post">
                                    @csrf
                                    <input type="hidden" @if(auth()->user() && $my_review) value="{{ $my_review->degree }}" @endif id="my-review-start" name="degree" required/>
                                    <div class="review-card-section col-md-12">
                                        <div class="top-section-review">
                                            <div class="right-review">
                                                <img class="reviewer-avatar" src="{{ upload_assets(null,false,"assets/img/avatars/user_avatar.png") }}" />
                                                <span class="reviewr-name">{{ auth()->user() ? auth()->user()->name : ''  }}</span>
                                            </div>
                                            <div class="review-points">
                                                <div class="rating give-rate">
                                                    @if(auth()->user() && $my_review)
                                                        @if($my_review->degree > 5)
                                                            @php $my_review->degree = 5 @endphp
                                                        @endif

                                                        ( {{ $my_review->degree }} )
                                                        @for($i = 1;$i <= $my_review->degree;$i++)
                                                            <i class="fas fa-star active"></i>
                                                        @endfor

                                                        @for($i=1;$i <= 5-$my_review->degree;$i++)
                                                            <i class="fas fa-star"></i>
                                                        @endfor
                                                    @else
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bottom-section-give" style="paading:0px">
                                            <textarea rows="5" name="review" class="form-control" required>@if(auth()->user() && $my_review) {{ $my_review->review }}  @endif</textarea>
                                        </div>
                                        <div class="give-me" style="text-align: left;padding: 15px 0px;">
                                            <button type="submit" class="btn btn-success btn-sm" style="margin:auto">
                                                اضافة تقيم
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                        <div class="clients-reviews list-client-reviews">
                            <h5> اراء العملاء</h5>
                            @forelse($reviews as $review)
                                @include('partials.reviews_list_1')
                            @empty
                            <div class="alert alert-warning">
                                التقيمات غير متوفرة على هذا المنتج
                            </div>
                            @endforelse
                        </div>
                        @if(!$reviews->isEmpty())
                            <div class="load-more" style="text-align: left;">
                                <button onClick="ajax_load_medias()" class="btn btn-warning btn-sm" style="margin:auto;margin-top: 13px;">
                                    تحميل المزيد
                                </button>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
<!-- team-details-area-end -->
@endsection

@push('style')
<style>
    .coupon-form{
        display: flex !important;
        background-color: #ff6f0042;
        padding: 12px;
        border-radius: 13px;
        margin: 15px 0px;
        border: 1px solid #eee;
        box-shadow: 0px 2px 14px 8px #eee;
        align-items: center;
    }
    .coupon-form .coupon_code{
        border-radius: 52px;
        background-color: #f2f2f2d6;
        height: 45px;
    }
    .coupon-form .btn-apply-code{
        background-color: #000000;
        color: white;
        padding: 0px 14px;
        margin: 5px;
        height: 40px;
    }
    .countdown-all{
        border-radius: 40px;
        padding: 10px 0px;
        font-weight: bold;
        color: orange;
        font-size: 25px;
    }
    #countdown{
        color: black;
        padding: 33px;
    }
</style>
@endpush

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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

    jQuery('.coupon-form-apply').submit(function(e){
        e.preventDefault();
        let coupon_code = jQuery('.coupon_code').val();
        jQuery('.btn-apply-code').attr('disabled',true);
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax-apply-coupon') }}",
            data: {
                product_id:"{{ $product->id }}",
                coupon_code: coupon_code
            },
            success: function(data) {
                console.log(data);
                jQuery('.btn-apply-code').attr('disabled',false);
                jQuery('.btn-apply-code').hide(100);
                if(data.result !=null){
                    jQuery('.coupon_code_buy').val(coupon_code);
                    jQuery('.coupon_code').attr('disabled',true);
                    jQuery('.coupon-form').append('<i class="fas fa-check-circle success-message" style="padding:10px;color:green;font-size: 18px;"></i>');
                    jQuery('.price-value').html(`
                        <b style="text-decoration:line-through gray;padding: 14px;color:#00194c">${data.result.USD_amount}</b><b>${data.result.USD_rest_amount}</b> <br/>
                        <b style="text-decoration:line-through gray;padding: 14px;color:#00194c">${data.result.OMR_amount}</b><b>${data.result.OMR_rest_amount}</b>
                    `);
                } else {
                    jQuery('.coupon-form').append('<i class="fas fa-times error-message" style="padding:10px;color:red;font-size: 18px;"></i>');
                    setTimeout(() => {
                        jQuery('.error-message').hide(100);
                        jQuery('.btn-apply-code').fadeIn(1000);
                    }, 3000);
                }

            }
        });
    });
</script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // ajax call
    let offset = 5;
    function ajax_load_medias(data = {}) {
        offset +=5;
        $.ajax({
            type: 'GET',
            url: "{{ route('ajax-paginate-review-lists') }}",
            data: {
                product_id:"{{ $product->id }}",
                offset: offset
            },
            success: function(data) {
                jQuery('.list-client-reviews').append(data._result);
                if (data._result.length == 0) {
                    jQuery('.load-more').hide();
                }
            }
        });
    }
</script>


@endpush
