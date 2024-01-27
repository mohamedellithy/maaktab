@extends('layouts.master')
@php
$search = request()->query('search') ?: null;
$order_status = request()->query('order_status') ?: null;
$filter = request()->query('filter') ?: null;
$rows   = request()->query('rows')   ?: 10;
@endphp
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex" style="display: flex !important;justify-content: space-between;align-items: baseline;">
            <h4 class="fw-bold py-3 mb-4">
                الطلبات
            </h4>
            <a href="{{ route('admin.applications.create') }}" class="btn btn-success btn-sm">
                اضافة نماذج جديدة
            </a>
        </div>
        <!-- Basic Bootstrap Table -->
        <div class="card" style="padding-top: 3%;">
            <form id="filter-data" method="get">
                <div class="d-flex filters-fields">
                    <div class="nav-item d-flex align-items-center m-2" >
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input type="text" class="search form-control border-0 shadow-none" placeholder="البحث ...."
                            @isset($search) value="{{ $search }}" @endisset id="search" name="search"/>
                    </div>
                    {{-- <div class="nav-item d-flex align-items-center m-2" >
                        <select name="order_status" onchange="document.getElementById('filter-data').submit()" id="largeSelect" class="form-select form-select-md">
                            <option value="">حالة الطلب</option>
                            <option value="pending"    @isset($order_status) @if($order_status == 'pending') selected @endif @endisset>Pending</option>
                            <option value="processing" @isset($order_status) @if($order_status == 'processing') selected @endif @endisset>Processing</option>
                            <option value="on-hold"    @isset($order_status) @if($order_status == 'on-hold') selected @endif @endisset>on-hold</option>
                            <option value="completed"  @isset($order_status) @if($order_status == 'completed') selected @endif @endisset>Completed</option>
                            <option value="cancelled"  @isset($order_status) @if($order_status == 'cancelled') selected @endif @endisset>Cancelled</option>
                        </select>
                    </div> --}}
                    {{-- <div class="nav-item d-flex align-items-center m-2" >
                        <select name="filter" id="largeSelect"  onchange="document.getElementById('filter-data').submit()" class="form-select form-select-md">
                            <option>فلتر المنتجات</option>
                            <option value="sort_asc"   @isset($filter) @if($filter == 'sort_asc') selected @endif @endisset>الطلبات الاقدم</option>
                            <option value="sort_desc"  @isset($filter) @if($filter == 'sort_desc') selected @endif @endisset>الطلبات الأحدث</option>
                        </select>
                    </div> --}}
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
                            <td>رقم النموذج</td>
                            <th>اسم النموذج</th>
                            <th>التصنيف الرئيسي</th>
                            <th>التصنيف الفرعي</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 alldata">
                        @foreach($applications as $application)
                            <tr>
                                <td><img style="width:40px;height:40px;border-width:0px" src="{{ asset('assets/apply-5.png') }}"/></td>
                                <td>{{ $application->id }}</td>
                                <td>{{ $application->app_name }}</td>
                                <td>{{ $application->main_category  ? $application->main_category->name  : '-' }}</td>
                                <td>{{ $application->child_category ? $application->child_category->name : '-' }}</td>
                                <td>
                                    <a href="{{ route('admin.applications.edit',$application->id) }}">
                                        <i class="bx bx-edit-alt me-2"></i>
                                    </a>
                                    <i class="bx bx-trash delete-application me-2" data-application="{{ $application->id }}"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br/>
                <div class="d-flex flex-row justify-content-center">
                    {{ $applications->links() }}
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection


@push('script')
   <script>
    $(function(){
        const ItemsOperations = {
            intialize:function(){
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('conent')
                    }
                });
                // your code here
                $('.delete-application').click(function(){
                    let ItemId = jQuery(this).attr('data-application');
                    let html   = this;
                    ItemsOperations.DeleteItem(ItemId,html);
                });
            },
            DeleteItem:function(itemId,html){
                var route = "{{ route('admin.applications.destroy',':id') }}";
                route = route.replace(':id',itemId);
                alert(route);
                $.ajax({
                    type: 'delete',
                    url: route,
                    dataType: 'json',
                    success: function( result ) {
                        $(html).parents('tr').remove();
                    },
                    error: function(xhr, textStatus, errorThrown){
                        alert(xhr.responseJSON.message);
                        console.log(xhr.responseJSON);
                    }
                });
            }
        };

        ItemsOperations.intialize();
    })
   </script>
@endpush