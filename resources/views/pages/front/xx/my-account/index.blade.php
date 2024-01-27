@extends('layouts.master_front')

@section('title')
 {{ 'حسابي' }}
@endsection

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
                    <h4>مرجبا {{ auth()->user()->name }}</h4>
                    <p style="width: 80%;">
                        من لوحة تحكم حسابك. يمكنك بسهولة التحقق من طلباتك الأخيرة وعرضها ، وعرض الخدمات المشترك بها والفوترة ، وتعديل كلمة المرور وتفاصيل الحساب
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- project-details-area-end -->
@endsection