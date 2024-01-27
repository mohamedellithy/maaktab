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
                        اعدادات الحساب
                    </h5>
                    <hr class="line-isolate"/>
                </div>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <form method="post" action="{{ route('update-account') }}">
                        @csrf
                        <div class="form-group">
                            <label>الاسم</label>
                            <input type="name" class="form-control" name="name" value="{{ auth()->user()->name ?: old('name') }}" placeholder="الاسم" />
                            @error('name')
                                <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>البربد الالكترونى</label>
                            <input type="email" class="form-control" value="{{ auth()->user()->email ?: old('email') }}"  name="email"/>
                            @error('email')
                                <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="ud-form-group form-group">
                            <label>رقم الجوال</label>
                            <div class="field-phone d-flex">
                                <select name="phone_code"  id="phone_code" class="form-control phone-cdoe" required>
                                    @foreach(CountriesPhonesCode() as $code => $phone_code)
                                        <option value="{{ $code }}" @if($code == auth()->user()->phone_code) selected @endif>{{ $phone_code }}</option>
                                    @endforeach
                                </select>
                                <input name="phone" placeholder="رقم الجوال" value="{{ auth()->user()->phone ?: old('phone') }}" type="tel" class="form-control phone" required/>
                            </div>
                            @error('phone')
                                <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>كلمة المرور </label>
                            <input type="password" class="form-control"  name="password"/>
                            @error('password')
                                <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>تأكيد كلمة المرور</label>
                            <input type="password" class="form-control"  name="password_confirmation"/>
                            @error('password_confirmation')
                                <span class="text-danger w-100 fs-6" style="color: #a21212 !important;direction: rtl;text-align: right;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-sm">
                                حفظ الاعدادات
                            </button>
                        </div>
                    </form>
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
                    <button class="btn btn-dark btn-settings btn-sm">
                        <i class="lni lni-cog"></i>
                        اعدادات الحساب
                    </button>
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
    .form-group{
        padding: 12px;
    }
    input,
    select{
        height: 46px;
        border-radius: 30px !important;
        margin-top: 14px;
    }
    .ud-login-wrapper{
        padding: 35px;
        box-shadow: 0px 0px 0px 0px !important;
    }
    .phone-cdoe{
        width:19% !important;
        border-left: 0px !important;
        border-radius: 0px 25px 25px 0px !important;
    }
    .phone{
        border-radius: 25px 0px 0px 25px !important;
        direction: rtl;
    }
</style>
@endpush

@push('script')
    <script type="text/javascript" src="{{ asset('front/assets/js/fslightbox.js') }}"></script>
@endpush
