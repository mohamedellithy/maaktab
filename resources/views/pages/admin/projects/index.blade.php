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
            المشاريع
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
                            <option>حالة المنتج</option>
                            <option value="active" @isset($status) @if($status == 'active') selected @endif @endisset>مفعل</option>
                            <option value="notactive" @isset($status) @if($status == 'notactive') selected @endif @endisset>غير مفعل</option>
                        </select>
                    </div>
                    <div class="nav-item d-flex align-items-center m-2" >
                        <select name="filter" id="largeSelect"  onchange="document.getElementById('filter-data').submit()" class="form-select form-select-md">
                            <option>فلتر المشاريع</option>
                            <option value="high-price" @isset($filter) @if($filter == 'high-price') selected @endif @endisset>الاعلي سعرا</option>
                            <option value="low-price"  @isset($filter) @if($filter == 'low-price') selected @endif @endisset>الاقل سعرا</option>
                            {{-- <option value="more-sale"  @isset($filter) @if($filter == 'more-sale') selected @endif @endisset>الاكثر طلبا</option>
                            <option value="less-sale"  @isset($filter) @if($filter == 'less-sale') selected @endif @endisset>الاقل طلبا</option> --}}
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
                            <th>الصورة</th>
                            <th>الاسم</th>
                            <th>الوصف</th>
                            <th>السعر</th>
                            <th>الحالة</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 alldata">
                        @foreach ($projects as $project)
                            <tr>
                                <td class="">
                                    <img src="{{ upload_assets($project->image_info) }}" alt="Avatar"
                                    class="rounded-circle">
                                </td>
                                <td class="width-16">{{ $project->name }}</td>
                                <td class="">
                                    {{ TrimLongText($project->description) }}
                                </td>
                                <td style="direction: ltr;width:15%">
                                    {!! html_price($project) !!}
                                </td>

                                <td>
                                    @if ($project->status == 'active')
                                        <span class="badge bg-label-success me-1">مفعل</span>
                                    @else
                                        <span class="badge bg-label-danger me-1">معطل</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                                        <div class="dropdown-menu">
                                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST">
                                                <a class="dropdown-item"
                                                    href="{{ route('admin.projects.edit', $project->id) }}"><i
                                                        class="bx bx-edit-alt me-2"></i>
                                                    تعديل</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item">
                                                    <i class="bx bx-trash me-2"></i>حذف
                                                </button>
                                                <a class="dropdown-item" target="_blank"
                                                    href="{{ url('project/'.$project->slug) }}"><i
                                                        class="fa-regular fa-eye me-2"></i></i>عرض

                                                </a>
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
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
        <!--/ Basic Bootstrap Table -->
    </div>
@endsection
