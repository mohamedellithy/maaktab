@extends('layouts.master')
@php
$settings = platformSettings();
@endphp
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">تعديل تصنيفات الخدمات</h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">

                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">اسم التصنيف</label>
                                <input type="text" name="name" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="name" value="{{ old('name') ?: $category->name }}" required/>
                                @error('name')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-fullname">التصنيف الرئيسي</label>
                                <select name="parent" id="formtabs-country" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value>بدون</option>
                                    @foreach($categories_main as $category_main)
                                        <option value="{{ $category_main->id }}" @if($category_main->id == $category->parent) selected @endif>{{ $category_main->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">تعديل التصنيف</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="container-uploader private-filter d-flex">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" placeholder="البحث"/>
                                </div>
                                <div class="form-group">
                                    <select name="rows" onchange="document.getElementById('filter-data').submit()" id="largeSelect" class="form-control form-select form-select-sm">
                                        <option>10</option>
                                        <option value="50" @isset($rows) @if($rows == '50') selected @endif @endisset>50</option>
                                        <option value="100" @isset($rows) @if($rows == '100') selected @endif @endisset>100</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">البحث</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        اسم التصنيف
                                    </th>
                                    <th>
                                        التصنيف الرئيسي
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>
                                            {{ $category->name  }}
                                        </td>
                                        <td>
                                            {{ $category->main_category ? $category->main_category->name : '-' }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit',$category->id) }}">
                                                <i class="bx bx-edit-alt me-2"></i>
                                            </a>
                                            <i class="bx bx-trash delete-category me-2" data-category="{{ $category->id }}"></i>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
                                            <div class="alert alert-warning">
                                                لا توجد اى تصنيفات
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="alert">
                            {!! $categories->links() !!}
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
    .private-filter{
        display: flex !important;
        justify-content: space-between;
        align-items: center;
    }
</style>
@endpush

@push('script')
   <script>
    $(function(){
        const CategoriesOperations = {
            intialize:function(){
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('conent')
                    }
                });
                // your code here
                $('.delete-category').click(function(){
                    let ItemId = jQuery(this).attr('data-category');
                    let html   = this;
                    CategoriesOperations.DeleteCategory(ItemId,html);
                });
            },
            DeleteCategory:function(itemId,html){
                var route = "{{ route('admin.categories.destroy',':id') }}";
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

        CategoriesOperations.intialize();
    })
   </script>
@endpush
