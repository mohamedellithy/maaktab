@extends('layouts.master_front')

@section('title')
 {{ 'خدماتى' }}
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
                    <h4>خدماتى </h4>
                    <table class="table">
                        <thead class="table-white">
                            <tr>
                                <th>اسم الخدمة</th>
                                <th>تفاصيل الطلب</th>
                                {{-- <th>تاريخ الطلب</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $application)
                                <tr>
                                    <td>
                                        <a href="{{ url('service/'.$application->service->slug) }}">
                                            {{ $application->service->name }}
                                        </a>
                                    </td>
                                    <td>
                                        <p>
                                            <label style="color: #0e51b4;font-size: 15px;font-weight: bold;">رقم الجوال</label>
                                            <span>{{ $application->phone }}</span>
                                        </p>
                                        <p>
                                            <label style="color: #0e51b4;font-size: 15px;font-weight: bold;">البريد الالكترونى</label>
                                            <span>{{ $application->email }}</span>
                                        </p>
                                        <p>
                                            <label style="color: #0e51b4;font-size: 15px;font-weight: bold;">تفاصيل الطلب</label>
                                            <span>{{ $application->subscriber_notic }}</strong>
                                        </p>
                                        <p>
                                            <label style="color: #0e51b4;font-size: 15px;font-weight: bold;">تاريخ الطلب</label>
                                            <span>{{ $application->created_at }}</span>
                                        </p>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- project-details-area-end -->
@endsection
