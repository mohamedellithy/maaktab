@extends('layouts.master_front')

@section('content')
<div class="container">
    <div class="row page-layout">
        <div class="col-md-9">
            <div class="container-orders">
                <div class="form-group">
                    <h4>
                        <i class="lni lni-layers"></i>
                        طلباتى
                    </h4>
                    <hr class="line-isolate"/>
                </div>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    @foreach($orders as $order)
                        <div class="accordion-item">
                            <div class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $order->id }}" aria-expanded="false" aria-controls="flush-collapseOne">
                                    <h5>
                                        <i class="lni lni-paperclip"></i>
                                        @if($order->modelable)
                                            @if($order->modelable_type == "App\Models\Project")
                                                مشروع مماثل ل ({{ $order->modelable->name }})
                                            @else
                                                طلب خدمة  ( {{ $order->modelable->name }} )
                                            @endif
                                        @endif
                                    </h5>
                                </button>
                            </div>
                            <div id="flush-collapse{{ $order->id }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <ul class="project-details">
                                        @foreach($order->order_attachments as $order_attachment)
                                            <li>
                                                <strong>{{ str_replace("_"," ",$order_attachment->name) }}</strong>
                                                @if($order_attachment->type == 'media')
                                                    <a class="btn btn-success btn-sm" data-fslightbox="gallery" href="{{ upload_assets($order_attachment->value,true) }}">
                                                        المرفق
                                                    </a>
                                                @else
                                                    <span>{{ $order_attachment->value }}</span>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                    {{-- <a href="#" class="btn btn-info btn-sm">
                                        <i class="lni lni-pencil-alt"></i>
                                        تعديل النموذج
                                    </a> --}}
                                </div>
                            </div>
                            <div class="accordion-footer">
                                <ul>
                                    <li>
                                        <b>
                                            <i class="lni lni-timer"></i>
                                            تاريخ طلب
                                        </b>
                                        <b>( {{ $order->created_at }} )</b>
                                    </li>
                                    <li>
                                        <b>
                                            <i class="lni lni-timer"></i>
                                            حالة المشروع
                                        </b>
                                        {!! get_status_html($order->order_status) !!}
                                    </li>
                                    <li>
                                        <b>
                                            <i class="lni lni-timer"></i>
                                            سعر المشروع
                                        </b>
                                        @if($order->order_total)
                                            {!! formate_price($order->order_total) !!}
                                        @else
                                            لم يحدد بعد
                                        @endif
                                    </li>
                                </ul>
                                <a href="{{ route('order-single',['order_id' => $order->id]) }}" class="btn btn-sm" style="color:white;background-color: #ff775e;border: 1px solid #ff775e;">
                                    تفاصيل الطلب
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="container-orders">
                <div class="avatar-image">
                    <img src="{{ asset('front\assets\images\user_avatar.png') }}" />
                </div>
                <p class="profile-name">
                    <label>
                        {{ auth()->user()->name }}
                    </label>
                    <strong>{{ auth()->user()->email }}</strong>
                </p>
                <div class="text-center">
                    <a href="{{ route('setting-account') }}" class="btn btn-dark btn-settings btn-sm">
                        <i class="lni lni-cog"></i>
                        اعدادات الحساب
                    </a>
                </div>
                <br/>
                <ul class="profile-info">
                    <li>
                        <span>
                            <i class="lni lni-bookmark"></i>
                            عدد المشاريع
                        </span>
                        <span class="badge bg-dark">
                            {{ auth()->user()->orders() ? auth()->user()->orders()->count() : 0 }}
                        </span>
                    </li>
                    <li>
                        <span>
                            <i class="lni lni-bookmark"></i>
                            عدد المشاريع مفتوحة
                        </span>
                        <span class="badge bg-dark">
                            {{ auth()->user()->orders() ? auth()->user()->orders()->where('order_status','pending')->count() : 0 }}
                        </span>
                    </li>
                    <li>
                        <span>
                            <i class="lni lni-bookmark"></i>
                            عدد المشاريع قيد التنفيذ
                        </span>
                        <span class="badge bg-dark">
                            {{ auth()->user()->orders() ? auth()->user()->orders()->where('order_status','progress')->count() : 0 }}
                        </span>
                    </li>
                    <li>
                        <span>
                            <i class="lni lni-bookmark"></i>
                            عدد المشاريع المكتملة
                        </span>
                        <span class="badge bg-dark">
                            {{ auth()->user()->orders() ? auth()->user()->orders()->where('order_status','completed')->count() : 0 }}
                        </span>
                    </li>
                    <li>
                        <span>
                            <i class="lni lni-bookmark"></i>
                            عدد المشاريع مغلقة
                        </span>
                        <span class="badge bg-dark">
                            {{ auth()->user()->orders() ? auth()->user()->orders()->where('order_status','cancelled')->count() : 0 }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
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
    .page-layout{
        padding-top:12%;
        padding-bottom:10%;

        /* display: flex;
        flex-wrap: nowrap;
        justify-content: space-between; */
    }
    .line-isolate{
        width: 5%;
        height: 0px;
        border: 2px solid #ff775e;
        margin-top: 7px;
        opacity: 1;
    }
    .container-orders{
        padding: 21px;
        background-color:#eeeeee87;
        border-radius: 7px;
    }
    .accordion-button::after{
        margin-right: auto;
        margin-left: unset;
    }
    .accordion-header h5{
        color: #4a148c;
    }
    .accordion-item{
        padding: 1%;
        margin-bottom: 14px;
        border-radius: 5px !important;
    }
    .accordion-footer{
        padding: 0% 2%;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }
    .accordion-footer ul li
    {
        padding: 12px 0px;
    }
    .accordion-footer ul
    {
        font-size: 14px;
    }
    .btn-dark{
        background-color: #031244;
        border: 1px solid #031244;
        padding: 3px 5px;
        font-size: 12px;
    }
    .avatar-image{
        width: 28%;
        margin: auto;
    }
    .profile-name{
        text-align: center;
        font-weight: bold;
        padding: 10px;
    }
    .profile-info li{
        background-color: white;
        padding: 10px;
        margin: 10px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        font-size: 13px;

    }
    .profile-info li span{
        font-weight: bold;
    }
    .profile-name label{
        color: #692b91;
    }
    .profile-name strong{
        color: #031244;
        font-size: 13px;
    }
    .btn-settings{
        margin: auto;
        padding: 4px 10px;
        font-size: 11px;
    }
    .project-details li{
        display: flex;
        justify-content: space-between;
        background-color: whitesmoke;
        margin: 10px 0px;
        padding: 10px;
    }
</style>
@endpush

@push('script')
    <script type="text/javascript" src="{{ asset('front/assets/js/fslightbox.js') }}"></script>
@endpush
