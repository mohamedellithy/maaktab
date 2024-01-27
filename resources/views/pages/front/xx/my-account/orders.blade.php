@extends('layouts.master_front')

@section('title')
 {{ 'طلباتى' }}
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
                    <h4>طلباتى </h4>
                    <table class="table">
                        <thead class="table-white">
                            <tr>
                                <th>رقم الطلب</th>
                                <th>اسم المنتج</th>
                                <th>حالة الطلبية</th>
                                <th>سعر الطلبية</th>
                                <th>تاريخ الطلبية</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>{{ $order->order_no }}</td>
                                    <td>{{ $order->order_items ? $order->order_items->product->name : '-' }}</td>
                                    <td>{{ $order->order_status }}</td>
                                    <td>{{ formate_price($order->order_total) }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        {{-- <a href="#" title="عرض الطلب">
                                            <i class="fas fa-eye"></i>
                                        </a> --}}
                                        @if($order->order_status == 'pending')
                                            <form action="{{ route('buy_now') }}"" method="post">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{ $order->id }}" />
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="far fa-credit-card"></i>
                                                    استكمال الطلب
                                                </button>
                                            </form>
                                        @endif
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