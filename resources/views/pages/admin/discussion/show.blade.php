@extends('layouts.master')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3" style="padding-bottom: 0rem !important;">
           طلبية رقم  # {{ $order->order_no }}
        </h4>
        <!-- Basic Layout -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body order-details">
                            <form method="post" action="{{ route('admin.discussions.store') }}">
                                @csrf
                                <input type="hidden" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="order_id" value="{{ $order->id }}" required/>
                                <input type="hidden" class="form-control" id="basic-default-fullname" placeholder=""
                                name="client_id" value="{{ $order->customer->id }}" required/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3 form-group">
                                            <label style="line-height: 2.5em;">نص الرسالة</label>
                                            <textarea class="form-control" name="message" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <div class="container-uploader">
                                                <button type="button" class="btn btn-outline-warning btn-sm upload-media" data-multiple-media="true">
                                                    <i class='bx bx-upload' ></i>
                                                    اضافة مرفقات للرسالة
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
                                        <button class="btn btn-danger btn-sm">
                                            ارسال 
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
                                        <h5 class="heading">مناقشات المشروع</h5>
                                    </div>
                                    @foreach($discussions as $discussion)
                                        @php $color = ($discussion->sender == 'client' ? "#FCE4EC" : "#E0F2F1") @endphp
                                        <table class="table" style="background-color:{{ $color }};">
                                            <tr>
                                                <th>
                                                    @if($discussion->sender == 'platform') منصة مكتب @else <i class="lni lni-user"></i> {{ $discussion->client->name }} @endif
                                                </th>
                                                <td style="text-align:left">{{ $discussion->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                {{ $discussion->message }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>مرفقات </th>
                                                <td style="text-align:left">
                                                    @if($discussion->attachments)
                                                        @php $attachments = explode(',',$discussion->attachments) @endphp
                                                        @foreach($attachments as $attachment)
                                                            @php $attachemnt_url = upload_assets($attachment,true) @endphp
                                                            @php $type           = strtolower(get_media_type($attachemnt_url)) @endphp
                                                            <a class="btn btn-dark btn-sm" @if(!in_array($type,['pdf'])) data-fslightbox="gallery" @else target="_blank" @endif href="{{ upload_assets($attachment,true) }}">
                                                                المرفق #{{ $attachment }}
                                                            </a>
                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                        <br/><br/>
                                    @endforeach
                                    {!! $discussions->links() !!}
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
