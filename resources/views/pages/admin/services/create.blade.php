@extends('layouts.master')
@php
$settings = platformSettings();
@endphp
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">انشاء خدمة</h4>
        <!-- Basic Layout -->
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">

                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">اسم الخدمة</label>
                                    <input type="text" class="form-control" id="basic-default-fullname" placeholder=""
                                        name="name" value="{{ old('name') }}" required/>
                                    @error('name')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-company"> وصف الخدمة</label>
                                    <textarea id="basic-default-message"  rows="10" class="form-control summernote" placeholder="" name='description' required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="basic-icon-default-fullname">حالة تسجيل الدخول</label>
                                    <select name="loginStatus" id="formtabs-country" class="select2 form-select"
                                        data-allow-clear="true" required>
                                        <option value="1">مفعل</option>
                                        <option value="0">معطل</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="col-sm-3 col-form-label text-sm-end" for="formtabs-country">
                                        تفعيل الواتساب</label>

                                    <select name="whatsapStatus" id="formtabs-country" class="select2 form-select"
                                        data-allow-clear="true" required>

                                        <option value="1">مفعل</option>
                                        <option value="0">معطل</option>
                                    </select>
                                    @error('whatsapStatus')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-message"> رقم الواتساب</label>
                                    <input type="text" name="whatsapNumber" value="{{ old('whatsapNumber') ?: (isset($settings['website_whastapp']) ? $settings['website_whastapp'] : null )  }}"
                                        id="formtabs-first-name" class="form-control" placeholder="" required/>
                                    @error('whatsapNumber')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <button type="submit" class="btn btn-primary">Send</button> --}}
                                <div class="mb-3">
                                    <label class="form-label" for="basic-default-fullname">رابط الخدمة</label>
                                    <input type="text" class="form-control" id="basic-default-fullname" placeholder=""
                                        name="slug" value="{{ old('slug') }}" required/>
                                    @error('slug')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="container-uploader">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" value="active" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">عرض الخدمة</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="container-uploader">
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-company">التصنيف الرئيسي</label>
                                        <select name="main_category_id" id="main_category_id" class="form-control">
                                            <option value>-</option>
                                            @foreach($categories_main as $category_main)
                                                <option value="{{ $category_main->id }}">{{ $category_main->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-company">التصنيف الفرعي</label>
                                        <select name="child_category_id" id="child_category_id" class="form-control">
                                            <option value>-</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="basic-icon-default-company">نموذج الطلب</label>
                                        <select name="application_id" id="application_id" class="form-control">
                                            <option value>-</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname"> الصورة</label>
                                <br/>
                                <div class="container-uploader">
                                    <button type="button" class="btn btn-danger upload-media" data-type-media="image">
                                        <i class='bx bx-upload' ></i>
                                        اضافة صورة للخدمة
                                        <input type="hidden" name="image"
                                            class="form-control dob-picker uploaded-media-ids" required/>
                                    </button>
                                    @error('image')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                    <div class="preview-thumbs">
                                        <ul class="list-preview-thumbs"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">عنوان السيو ( meta title )</label>
                                <input type="text" id="basic-icon-default-company" class="form-control" name="meta_title"
                                    value="{{ old('meta_title') }}" />
                                @error('meta_title')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">وصف السيو ( meta description ) </label>
                                <textarea type="text" id="basic-icon-default-company" class="form-control"
                                    name="meta_description">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">انشاء خدمة</button>
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
    $(function(){
        const ServiceOperations = {
            initialize:async function(){
                jQuery('#main_category_id').change(function(){
                    let category_id = $(this).val();
                    ServiceOperations.load_child_categories(category_id);
                    ServiceOperations.load_child_applications(category_id);
                });

                jQuery('#child_category_id').change(function(){
                    let category_id = $('#main_category_id').val();
                    let child_category_id = $(this).val();
                    ServiceOperations.load_child_applications(category_id,child_category_id);
                });
            },
            load_child_categories:function(main_category){
                var route = "{{ route('admin.categories.child_categories',':id') }}";
                route = route.replace(':id',main_category);
                $.ajax({
                    type: 'GET',
                    url: route,
                    dataType: 'json',
                    success: function( result ) {
                        ServiceOperations.CategoryOptions(result.item);
                    }
                });
            },
            CategoryOptions:function(items){
                $('#child_category_id').html('');
                items.forEach(function(item){
                    var option = document.createElement('option');
                    option.setAttribute('value',item.id);
                    var optionLabel = document.createTextNode(item.name);
                    option.appendChild(optionLabel);
                    $('#child_category_id').append(option);
                });
            },
            load_child_applications:function(main_category,child_category = null){
                if(child_category == null){
                    var route = `{{ url('admin/applications/by_categories/${main_category}/${child_category}') }}`;
                } else {
                    var route = `{{ url('admin/applications/by_categories/${main_category}') }}`;
                }
                $.ajax({
                    type: 'GET',
                    url: route,
                    dataType: 'json',
                    success: function( result ) {
                        ServiceOperations.ApplicationsOptions(result.item);
                        //console.log(result);
                    }
                });
            },
            ApplicationsOptions:function(items){
                $('#application_id').html('');
                items.forEach(function(item){
                    var option = document.createElement('option');
                    option.setAttribute('value',item.id);
                    var optionLabel = document.createTextNode(item.app_name);
                    option.appendChild(optionLabel);
                    $('#application_id').append(option);
                });
            }
        };

        ServiceOperations.initialize();
    });
</script>
@endpush