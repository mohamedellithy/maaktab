@extends('layouts.master_front')

@section('title')
 {{ 'منتجاتي' }}
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
                    <h4> منتجاتى  </h4>
                    <table class="table">
                        <thead class="table-white">
                            <tr>
                                <th>رقم الطلب</th>
                                <th>اسم الملف</th>
                                <th>نوع الملف</th>
                                <th>نوع التحميل</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ $order->order_items->product->downloads ? $order->order_items->product->downloads->download_name : $order->order_items->product->name }}</td>
                                    <td>
                                        <span class="badge bg-danger">
                                            {{ $order->order_items->product->downloads ? $order->order_items->product->downloads->download_type : 'NOT SELECTED' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($order->order_items->product->downloads)
                                            <span class="badge bg-info">
                                                @if($order->order_items->product->downloads->download_status == 'download')
                                                    قابل للتنزيل
                                                @else
                                                    غير قابل للتنزيل
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('single_download',$order->id) }}" title="عرض الطلب">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- project-details-area-end -->
@endsection
