@extends('layouts.master_front')
@php $section = request('section') @endphp
@section('content')
<div class="container">
    <div class="row page-layout">
        <div class="col-md-9">
            <div class="container-orders">
                <div class="form-group">
                    <h5>
                        <i class="lni lni-layers"></i>
                        مدفوعاتي
                    </h5>
                    <hr class="line-isolate"/>
                </div>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    @foreach($payments as $payment)
                        @php $color = ($payment->status == 'accepted' ? "#00968817" : "white") @endphp
                        <table class="table" style="background-color:{{ $color }};">
                            <tr>
                                <th>قيمة المدفوع</th>
                                <td>{{ $payment->total_payment }} SAR</td>
                                <th>تاريخ الدفع</th>
                                <td>{{ $payment->created_at }}</td>
                            </tr>
                            <tr>
                                <th>المشروع</th>
                                <td colspan="5">
                                    @if($payment->order->modelable)
                                        @if($payment->order->modelable_type == "App\Models\Project")
                                            مشروع مماثل ل ({{ $payment->order->modelable->name }})
                                        @else
                                            طلب خدمة  ( {{ $payment->order->modelable->name }} )
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>حالة المدفوعات</th>
                                <td>{{ $payment->status_payment }}</td>
                                <th>بوابة الدفع</th>
                                <td>{{ $payment->getaway }}</td>
                            </tr>
                        </table>
                    @endforeach
                    {!! $payments->links() !!}
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
    .avatar-image{
        width: 28%;
        margin: auto;
    }
</style>
@endpush

@push('script')
    <script type="text/javascript" src="{{ asset('front/assets/js/fslightbox.js') }}"></script>
@endpush
