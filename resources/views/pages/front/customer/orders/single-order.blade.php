@extends('layouts.master_front')
@php $section = request('section') @endphp
@section('content')
<div class="container">
    <div class="row page-layout">
        <div class="col-md-9">
            <ul class="side-menu-lists">
                <li class="{{ ( ($section == 'proposals') || ($section == null) ) ? 'active' : '' }}">
                    <a href="{{ route('order-single',[
                        'order_id' => $order->id
                    ]) }}" class="btn btn-sm">
                        عروض المشروع
                    </a>
                </li>
                <li class="{{ ($section == 'application-details') ? 'active' : '' }}">
                    <a href="{{ route('order-single',[
                        'order_id' => $order->id,
                        'section'  => "application-details"
                    ]) }}" class="btn btn-sm">
                        تفاصيل نموذج الطلب
                    </a>
                </li>
                <li class="{{ ($section == 'project-payments') ? 'active' : '' }}">
                    <a href="{{ route('order-single',[
                        'order_id' => $order->id,
                        'section'  => "project-payments"
                    ]) }}" class="btn btn-sm">
                        مدفوعات المشروع
                    </a>
                </li>
                <li class="{{ ($section == 'project-discussions') ? 'active' : '' }}">
                    <a href="{{ route('order-single',[
                        'order_id' => $order->id,
                        'section'  => "project-discussions"
                    ]) }}" class="btn btn-sm">
                        مناقشات المشروع
                    </a>
                </li>
            </ul>

            @if($section == 'application-details')
                @include('pages.front.customer.orders.sections.application-details')
            @endif

            @if(($section == null) || ($section == 'proposals') )
                @include('pages.front.customer.orders.sections.proposals')
            @endif

            @if($section == 'project-payments')
                @include('pages.front.customer.orders.sections.payments')
            @endif

            @if($section == 'project-discussions')
                @include('pages.front.customer.orders.sections.discussions')
            @endif
        </div>
        <div class="col-md-3">
            <div class="container-orders">
                <div class="avatar-image">
                    <i class="lni lni-layers"></i>
                </div>
                <p class="profile-name">
                    <label>
                        @if($order->modelable)
                            @if($order->modelable_type == "App\Models\Project")
                                مشروع مماثل ل ({{ $order->modelable->name }})
                            @else
                                طلب خدمة  ( {{ $order->modelable->name }} )
                            @endif
                        @endif
                    </label>
                </p>
                <ul>
                    <li class="text-center">
                        @if($order->modelable)
                            @if($order->modelable_type == "App\Models\Project")
                                <a href="{{ url('project/'.$order->modelable->slug) }}" class="btn btn-dark btn-sm">
                                    <i class="lni lni-eye"></i>
                                    الاطلاع علي المشروع
                                </a>
                            @else
                                <a href="{{ url('service/'.$order->modelable->slug) }}" class="btn btn-dark btn-sm">
                                    <i class="lni lni-eye"></i>
                                    الاطلاع على الخدمة
                                </a>
                            @endif
                        @endif

                    </li>
                </ul>
                <br/>
                <ul class="profile-info">
                    <li>
                        <span>
                            <i class="lni lni-bookmark"></i>
                            تاريخ النشر
                        </span>
                        <span class="badge bg-dark">
                            {{ $order->created_at }}
                        </span>
                    </li>
                    <li>
                        <span>
                            <i class="lni lni-bookmark"></i>
                            حالة المشروع
                        </span>
                        {!! get_status_html($order->order_status) !!}
                    </li>
                    <li>
                        <span>
                            <i class="lni lni-bookmark"></i>
                            سعر المشروع
                        </span>
                        <span class="badge bg-dark">
                            @if($order->order_total)
                                {{ formate_price($order->order_total) }}
                            @else
                                لم يحدد بعد
                            @endif
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
        margin-top:14px;
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
        color: #C2185B;
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
        font-size: 3em;
        text-align: center
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
    .side-menu-lists{
        display: flex;
        justify-content: flex-end;
    }
    .side-menu-lists li{
        padding: 3px;
    }
    .side-menu-lists li a
    {
        color:white;
        background-color:gray;
    }
    .side-menu-lists li.active a
    {
        background-color: orange;
        color: black;
    }
</style>
@endpush

@push('script')
    <script type="text/javascript" src="{{ asset('front/assets/js/fslightbox.js') }}"></script>
@endpush
