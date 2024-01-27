@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">مرحيا {{ auth()->user()->name }} 🎉</h5>
                            <p class="mb-4">
                                يمكنك التحكم فى كل تفاصيل المنصة و متابعة نشاطات المنصة
                            </p>

                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">
                                ابدأ الان
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">
                                منتجات
                            </span>
                            <h3 class="card-title mb-2">
                                {{ $data['count_products'] ?: 0 }}
                            </h3>
                            <small class="text-success fw-semibold"><i
                                    class="bx bx-up-arrow-alt"></i>
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/unicons/chart.png" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span>خدمات</span>
                            <h3 class="card-title text-nowrap mb-1">
                                {{ $data['count_services'] ?: 0 }}
                            </h3>
                            <small class="text-success fw-semibold"><i
                                    class="bx bx-up-arrow-alt"></i></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Total Revenue -->
    </div>
    <div class="row">
        <!-- Order Statistics -->
        <div class="col-md-6 col-lg-8 col-xl-8 order-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2">أخر الطلبات</h5>
                    </div>
                    <div class="dropdown">
                        <a href="{{ route('admin.orders.index') }}" class="btn p-0" type="button" id="orederStatistics">
                            <i class="bx bx-dots-vertical-rounded"></i>
                            عرض الكل
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex flex-column align-items-center gap-1">
                            <h2 class="mb-2">
                                {{ formate_price($data['total_payments'] ?: 0) }}
                            </h2>
                            <span>اجمالى الطلبات</span>
                        </div>
                        {{-- <div id="orderStatisticsChart"></div> --}}
                    </div>
                    <ul class="p-0 m-0">
                        @forelse ($data['last_orders'] as $last_order)
                            <li class="d-flex mb-4 pb-1">
                                <div class="avatar flex-shrink-0 me-3">
                                    <img src="../assets/img/icons/unicons/paypal.png" alt="User" class="rounded" />
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <small class="text-muted d-block mb-1">{{ $last_order->payment ? $last_order->payment->getaway : '-' }}</small>
                                        <h6 class="mb-0">#{{ $last_order->order_no }}</h6>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{ $last_order->created_at }}</h6>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">{{ formate_price($last_order->order_total) }}</h6>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <p class="alert alert-danger">
                                لا يوجد اى طلبات موجود
                            </p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Order Statistics -->
        <!--/ Total Revenue -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/paypal.png') }}" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="d-block mb-1">الطلبات</span>
                            <h3 class="card-title text-nowrap mb-2">
                                {{ $data['orders_count'] ?: 0 }}
                            </h3>
                            <small class="text-danger fw-semibold"><i
                                    class="bx bx-down-arrow-alt"></i> </small>
                        </div>
                    </div>
                </div>
                <div class="col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/icons/unicons/cc-primary.png') }}" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">المدفوعات</span>
                            <h3 class="card-title mb-2">
                                {{ formate_price($data['total_payments'] ?: 0) }}
                            </h3>
                            <small class="text-success fw-semibold"><i
                                    class="bx bx-up-arrow-alt"></i> </small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="{{ asset('assets/img/avatars/user_avatar.png') }}" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span>المستخدمين</span>
                            <h3 class="card-title text-nowrap mb-1">
                                {{ $data['count_users'] ?: 0 }}
                            </h3>
                            <small class="text-success fw-semibold"><i
                                    class="bx bx-up-arrow-alt"></i></small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title m-0 me-2">أخر طلبات التسعير</h5>
                            <a href="{{ route('admin.services.index') }}" class="btn p-0" type="button">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                عرض الكل
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
