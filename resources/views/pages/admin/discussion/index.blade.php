@extends('layouts.master')
@php
$search = request()->query('search') ?: null;
$discussion_status = request()->query('status') ?: null;
$filter = request()->query('filter') ?: null;
$rows   = request()->query('rows')   ?: 10;
@endphp
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            مناقشات العملاء
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
                            <option value="">حالة المناقشة</option>
                            <option value="0"    @isset($discussion_status) @if($discussion_status == 0) selected @endif @endisset>مقروء</option>
                            <option value="1" @isset($discussion_status) @if($discussion_status == 1) selected @endif @endisset>غير مقروء</option>
                        </select>
                    </div>
                    <div class="nav-item d-flex align-items-center m-2" >
                        <select name="filter" id="largeSelect"  onchange="document.getElementById('filter-data').submit()" class="form-select form-select-md">
                            <option>فلتر المناقشات</option>
                            <option value="sort_asc"   @isset($filter) @if($filter == 'sort_asc') selected @endif @endisset>المناقشات الاقدم</option>
                            <option value="sort_desc"  @isset($filter) @if($filter == 'sort_desc') selected @endif @endisset>المناقشات الأحدث</option>
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
                            <th></th>
                            <th>العميل</th>
                            <th>نص الرسالة</th>
                            <th>المشروع</th>
                            <th>تاريخ الرسالة </th>
                            <th>مقروء</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 alldata">
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td class="width-16">
                                    {{ $customer->name }}
                                </td>
                                <td>
                                   {{ TrimLongText($customer->message,200) }}
                                </td>
                                <td>
                                    # {{ $customer->order_id }}
                                </td>
                                <td>
                                    <span class="badge bg-label-primary me-1">
                                        {{ $customer->created_at }}
                                    </span>
                                </td>
                                <td>
                                    @if($customer->read == 0)
                                        <i class='bx bxs-circle' style="font-size: 12px;color:red" title="غير مقروء بعد"></i>
                                    @elseif($customer->read == 1)
                                        <i class='bx bxs-circle' style="font-size: 12px;color:#dcadad" title="مقروء"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            {{-- <a class="dropdown-item"
                                                href="{{ route('admin.orders.edit', $order->order_no) }}"><i
                                                    class="bx bx-edit-alt me-2"></i>
                                                تعديل
                                            </a> --}}
                                            <a class="dropdown-item"
                                                href="{{ route('admin.discussions.show', $customer->order_id) }}"><i
                                                    class="fa-regular fa-eye me-2"></i></i>
                                                عرض
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br/>
                <div class="d-flex flex-row justify-content-center">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
