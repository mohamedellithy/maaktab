@extends('layouts.master')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3" style="padding-bottom: 0rem !important;">
           طلبية رقم  # {{ $order->order_no }}
        </h4>
        <!-- Basic Layout -->
            <form action="{{ route('admin.orders.update',$order->order_no) }}" method="post">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-status-change" style="">
                        <div class="form-group">
                            <select name="order_status" class="form-control" style="height: 50px;">
                                <option value="pending" @if($order->order_status == 'pending') selected @endif>Pending</option>
                                <option value="cancelled" @if($order->order_status == 'cancelled') selected @endif>cancelled</option>
                                <option value="progress" @if($order->order_status == 'progress') selected @endif>progress</option>
                                <option value="completed" @if($order->order_status == 'completed') selected @endif>Complete</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">تعديل المنتج</button>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body order-details">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <h5 class="heading"> تفاصيل نموذج الطلب</h5>
                                    </div>
                                    @foreach($order->order_attachments as $order_attachment)
                                        <div class="mb-3 order-lists">
                                            <label class="form-label" for="basic-default-fullname" style="font-weight: bold;">
                                                {{ str_replace('_',' ',$order_attachment->name) }}
                                            </label>
                                            @if($order_attachment->type == 'media')
                                                <a class="btn btn-success btn-sm" data-fslightbox="gallery" href="{{ upload_assets($order_attachment->value,true) }}">
                                                    المرفق
                                                </a>
                                            @else
                                                <span>{{ $order_attachment->value }}</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body order-details">
                            <form method="post" action="{{ route('admin.proposals.store') }}">
                                @csrf
                                <input type="hidden" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="order_id" value="{{ $order->id }}" required/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <h5 class="heading"> اضافة عروض على المشروع</h5>
                                        </div>
                                        <div class="mb-3 form-group">
                                            <label style="line-height: 2.5em;">السعر</label>
                                            <input type="text" name="price" class="form-control" />

                                        </div>
                                        <div class="mb-3 form-group">
                                            <label style="line-height: 2.5em;">تفاصيل عرضك</label>
                                            <textarea class="form-control" name="description" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <div class="container-uploader">
                                                <button type="button" class="btn btn-outline-warning btn-sm upload-media" data-multiple-media="true">
                                                    <i class='bx bx-upload' ></i>
                                                    اضافة مرفقات للعرض
                                                    <input type="hidden" name="attachments" value=""
                                                        class="form-control dob-picker uploaded-media-ids" required/>
                                                </button>
                                                @error('attachments')
                                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                                @enderror
                                                <div class="preview-thumbs">
                                                    <br/>
                                                    <ul class="list-preview-thumbs">
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary btn-sm">
                                            اضافة عرض جديد
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body order-details">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <h5 class="heading">العروض على المشروع</h5>
                                    </div>
                                    @foreach($proposals as $proposal)
                                        <table class="table table-dark">
                                            <tr>
                                                <th>قيمة العرض</th>
                                                <td>{{ $proposal->price }} SAR</td>
                                                <th>تاريخ العرض</th>
                                                <td>{{ $proposal->created_at }}</td>
                                                <td>
                                                    @if($proposal->status == 'wait')
                                                        <form method="post" action="{{ route('admin.proposals.destroy',$proposal->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="" style="background: transparent;border:0px solid white"> 
                                                                <i class="bx bx-trash me-2" style="color:red"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    {{ $proposal->description }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>حالة العرض</th>
                                                <td>{{ $proposal->status }}</td>
                                                <th>مرفقات العرض</th>
                                                <td colspan="2">
                                                    @if($proposal->attachments)
                                                        @php $attachments = explode(',',$proposal->attachments) @endphp 
                                                        @foreach($attachments as $attachment)
                                                            <a class="btn btn-success btn-sm" data-fslightbox="gallery" href="{{ upload_assets($attachment,true) }}">
                                                                المرفق #{{ $attachment }}
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                        <br/><br/>
                                    @endforeach
                                    {!! $proposals->links() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body order-details">
                            <div class="mb-3">
                                <h5 class="heading"> الطلبية</h5>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">كود الطلبية</label>
                                <h6 style="line-height: 1.3em;">{{ $order->order_no }}</h6>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">حالة الطلبية</label>
                                <h6 style="line-height: 1.3em;">{{ $order->order_status }}</h6>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">اجمالى سعر الطلبية</label>
                                <h6 style="line-height: 1.3em;">{{ formate_price($order->order_total) }}</h5>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">تاريخ الطلبية</label>
                                <h6 style="line-height: 1.3em;">{{ $order->created_at }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body order-details">
                            <div class="mb-3">
                                <h5 class="heading"> تفاصيل الزبون</h5>
                            </div>
                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">اسم الزبون</label>
                                    <h6 style="line-height: 1.3em;">{{ $order->customer->name }}</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">البريد الالكترونى الزبون</label>
                                    <h6 style="line-height: 1.3em;">{{ $order->customer->email }}</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">رقم تليفون الزبون</label>
                                    <h6 style="line-height: 1.3em;">{{ $order->customer->full_phone ?: '-' }}</h6>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">دولة </label>
                                    <h6 style="line-height: 1.3em;">{{ $order->customer->phone_code ? CountriesPhonesCode($order->customer->phone_code) : '-' }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <!-- / Content -->
@endsection

@push('style')
<style>
    .order-lists{
        display: flex !important;
        justify-content: space-between;
    }
</style>
@endpush

@push('script')
    <script type="text/javascript" src="{{ asset('front/assets/js/fslightbox.js') }}"></script>
@endpush
