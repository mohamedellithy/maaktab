@php
use Illuminate\Support\Str;
$code = Str::random(10);
@endphp
@extends('layouts.master')
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3" style="padding-bottom: 0rem !important;">تعديل كوبون</h4>
        <!-- Basic Layout -->
        <form action="{{ route('admin.coupons.update',$coupon->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl" style="padding: 0px 10px 10px;text-align: left;">
                    <button type="submit" class="btn btn-success btn-sm">تعديل الكوبون</button>
                </div>
                <br/>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">كود الكوبون</label>
                                <input type="text" class="form-control" id="basic-default-fullname"
                                    name="code" value="{{ $coupon->code ?: old('code')  }}" required/>
                                @error('code')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">تاريخ بدأ الخصم</label>
                                <input type="date" id="basic-default-message" class="form-control" name='from' value="{{ $coupon->from ?: old('from') }}" required>
                                @error('from')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">تاريخ نهاية الخصم</label>
                                <input type="date" id="basic-default-message" class="form-control" name='to' value="{{ $coupon->to ?: old('to') }}" required>
                                @error('to')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">عدد مرات استخدام الكود</label>
                                <input type="number" id="basic-default-message" class="form-control" name='count_used' value="{{ $coupon->count_used ?: old('count_used') }}" required>
                                @error('count_used')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">نوع الخصم</label>
                                <select name="discount_type" class="form-control">
                                    <option value="value"    @if($coupon->discount_type == 'value') selected @endif>قيمة</option>
                                    <option value="precent"  @if($coupon->discount_type == 'precent') selected @endif>النسبة</option>
                                </select>
                                @error('discount_type')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">حالة الكود</label>
                                <select name="status" class="form-control">
                                    <option value="active"    @if($coupon->status == 'active') selected @endif>نشط</option>
                                    <option value="un-active"  @if($coupon->status == 'un-active') selected @endif>غير نشط</option>
                                </select>
                                @error('status')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">قيمة الخصم</label>
                                <input id="basic-default-message" class="form-control" name='value' value="{{ $coupon->value ?: old('value') }}" required>
                                @error('value')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4>تحديد المنتجات</h4>
                            <ul class="lists-types">
                                <li>
                                    <input type="radio" class="type_choices" value="all" name="type_choices" @if($coupon->products == -1) checked @endif/>
                                    <span>كل المنتجات</span>
                                </li>
                                <li>
                                    <input type="radio" class="type_choices" value="some" name="type_choices" @if($coupon->products != -1) checked @endif/>
                                    <span>تحديد بعض المنتجات</span>
                                </li>
                            </ul>
                            <ul class="list-products"  @if($coupon->products == -1) style="display: none" @endif>
                                @php $selected_products = $coupon->product ? $coupon->product->pluck('id')->toArray() : [] @endphp
                                @foreach($products as $product)
                                    <li>
                                        <input type="checkbox" name="products[]" value="{{ $product->id }}" @if(in_array($product->id,$selected_products)) checked @endif/>
                                        <span>{{ $product->name  }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- / Content -->
@endsection
@push('script')
<script>
    jQuery('document').ready(function(){
        jQuery('.type_choices').click(function(){
            let type = jQuery(this).val();
            if(type == 'some'){
                jQuery('.list-products').show();
            } else {
                jQuery('.list-products').hide();
            }
        });
    });
</script>
@endpush
@push('style')
<style>
    .list-products{
        padding: 24px;
        background-color: #eee;
        overflow-y: auto;
        height: 400px;
    }
    .list-products li
    {
        padding: 10px;
        list-style: none;
        border-bottom: 1px solid white;
    }
    .lists-types{
        list-style:none;
        padding:0px;
    }
    .lists-types li
    {
        padding: 10px 0px;
    }
</style>
@endpush
