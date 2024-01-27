@extends('layouts.master')
@php
$search = request()->query('search') ?: null;
$status = request()->query('status') ?: null;
$filter = request()->query('filter') ?: null;
$rows   = request()->query('rows')   ?: 10;
@endphp
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            الكوبونات
        </h4>
        <!-- Basic Bootstrap Table -->
        <div class="card" style="padding-top: 3%;">
            <form id="filter-data" method="get">
                <div class="d-flex filters-fields">
                    <div class="nav-item d-flex align-items-center m-2" >
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" class="search form-control border-0 shadow-none" placeholder="البحث ...."
                            @isset($search) value="{{ $search }}" @endisset id="search" name="search"/>
                    </div>
                    <div class="nav-item d-flex align-items-center m-2" >
                        <select name="status" onchange="document.getElementById('filter-data').submit()" id="largeSelect" class="form-select form-select-md">
                            <option>حالة الكوبون</option>
                            <option value="active" @isset($status) @if($status == 'active') selected @endif @endisset>نشط</option>
                            <option value="notactive" @isset($status) @if($status == 'notactive') selected @endif @endisset>غير نشط</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="nav-item d-flex align-items-center m-2" >
                        <label style="padding: 0px 10px;color: #636481;">المعروض</label>
                        <select name="rows" onchange="document.getElementById('filter-data').submit()" id="largeSelect" class="form-select form-select-sm">
                            <option>10</option>
                            <option value="50" @isset($rows) @if($rows == '50') selected @endif @endisset>50</option>
                            <option value="100" @isset($rows) @if($rows == '100') selected @endif @endisset>100</option>
                        </select>
                    </div>
                </div>
            </form>
            <br/>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>
                                كود الخصم
                            </th>
                            <th>
                                تاريخ البدء 
                            </th>
                            <th>
                                تاريخ الانتهاء
                            </th>
                            <th>
                                نوع الخصم
                            </th>
                            <th>
                                قيمة الخصم
                            </th>
                            <th>
                                حالة الكوبون
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 alldata">
                        @foreach($coupons as $coupon)
                            <tr>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->from }}</td>
                                <td>{{ $coupon->to }}</td>
                                <td>{{ $coupon->discount_type == 'value' ? 'قيمة' : 'النسبة' }}</td>
                                <td>{{ $coupon->value }}</td>
                                <td>{{ $coupon->status == 'active' ? 'نشطة' : 'غير نشطة' }}</td>
                                <td>{{ $coupon->created_at }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.coupons.edit', $coupon->id) }}"><i
                                                        class="bx bx-edit-alt me-2"></i>
                                                    تعديل</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bx bx-trash me-2"></i>حذف
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br/>
                <div class="d-flex flex-row justify-content-center">
                    {{ $coupons->links() }}
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
