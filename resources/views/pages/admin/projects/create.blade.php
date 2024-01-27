@extends('layouts.master')


@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3" style="padding-bottom: 0rem !important;">اضافة المشروع جديد</h4>
        <!-- Basic Layout -->
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl" style="padding: 0px 10px 10px;text-align: left;">
                    <button type="submit" class="btn btn-success btn-sm">اضافة المشروع</button>
                </div>
                <br/>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">اسم المشروع</label>
                                <input type="text" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="name" value="{{ old('name') }}" required/>
                                @error('name')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company"> ( وصف قصير ) نبذة عن المشروع </label>
                                <textarea id="basic-default-message" rows="3" class="form-control" placeholder="" name='short_description' required>{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company"> وصف المشروع</label>
                                <textarea id="basic-default-message" rows="10" class="form-control summernote" placeholder="" name='description' required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">تكلفة المشروع</label>
                                <input id="basic-default-message" class="form-control" placeholder="" name='price' value="{{ old('price') }}" required>
                                @error('price')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label" for="basic-default-company">خصم على مشروع</label>
                                <input id="basic-default-message" class="form-control" placeholder="" name='discount' value="{{ old('discount') }}">
                                @error('discount')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            {{-- <div class="mb-3">
                                <label class="form-label" for="basic-default-company">نوع الخصم</label>
                                <select class="form-control" name="discount_type">
                                    <option value="value">بالقيمة</option>
                                    <option value="percent">بالنسبة</option>
                                </select>
                                @error('discount_type')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company"> رابط المشروع</label>
                                <input id="basic-default-message" class="form-control" placeholder="" name='slug' value="{{ old('slug') }}" required>
                                @error('slug')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="mb-3">
                                <h4 class="">التحميلات </h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">نوع الملف</label>
                                <select type="url" class="form-control download-type" id="basic-default-fullname" placeholder=""
                                    name="download_type" value="{{ old('download_type') }}" required>
                                    <option value="pdf">Pdf</option>
                                    <option value="image">Image</option>
                                    <option value="video">Video</option>
                                    <option value="audio">Audio</option>
                                    <option value="zip">Zip</option>
                                    <option value="zoom">Zoom</option>
                                    <option value="vnd.openxmlformats-officedocument.spreadsheetml.sheet"   @isset($product->downloads) @if($product->downloads->download_type == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet') selected @endif   @endisset>xlsx</option>
                                </select>
                                @error('download_type')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="container-uploader">
                                    <button type="button" class="btn btn-info btn-sm download-files upload-media" data-type-media="pdf" data-multiple-media="true">
                                        <i class='bx bx-upload' ></i>
                                        اضافة ملفات قابلة للتحميل
                                        <input type="hidden" name="download_attachments_id" value=""
                                            class="form-control dob-picker uploaded-media-ids"/>
                                    </button>
                                    @error('download_attachments_id')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                    <div class="preview-thumbs">
                                        <br/>
                                        <ul class="list-preview-thumbs">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">حالة الملف</label>
                                <select type="url" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="download_status" value="{{ old('download_status') }}">
                                    <option value="download">تنزيل الملف او الفيديو</option>
                                    <option value="without_download">مشاهدة بدون تنزيل</option>
                                </select>
                                @error('download_status')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">رابط ملف التحميل ان وجدت</label>
                                <input type="url" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="download_link" value="{{ old('download_link') }}"/>
                                @error('download_link')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">اسم الملف التحميلات</label>
                                <input type="text" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="download_name" value="{{ old('download_name') }}"/>
                                @error('download_name')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">وصف ملف التحميلات</label>
                                <textarea type="text" class="form-control summernote" id="basic-default-fullname" placeholder=""
                                    name="download_description">{{ old('download_description') }}</textarea>
                                @error('download_description')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="container-uploader">
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" value="active" checked>
                                        <label class="form-check-label" for="flexSwitchCheckChecked">حالة المشروع</label>
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
                                <label class="form-label" for="basic-default-company">تاريخ بدأ المشروع</label>
                                <input type="date" id="basic-default-message" class="form-control" placeholder="" name='from' value="{{ old('from') }}">
                                @error('from')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">تاريخ نهاية المشروع</label>
                                <input type="date" id="basic-default-message" class="form-control" placeholder="" name='to' value="{{ old('to') }}">
                                @error('to')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="container-uploader">
                                    <button type="button" class="btn btn-outline-warning btn-sm upload-media" data-type-media="image">
                                        <i class='bx bx-upload' ></i>
                                        اضافة صورة للمشروع
                                        <input type="hidden" name="thumbnail_id" value=""
                                            class="form-control dob-picker uploaded-media-ids" required/>
                                    </button>
                                    @error('thumbnail_id')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                    <div class="preview-thumbs">
                                        <br/>
                                        <ul class="list-preview-thumbs">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="container-uploader">
                                    <button type="button" class="btn btn-outline-warning btn-sm upload-media" data-type-media="image" data-multiple-media="true">
                                        <i class='bx bx-upload' ></i>
                                        اضافة صورأخري للمشروع
                                        <input type="hidden" name="attachments_id" value=""
                                            class="form-control dob-picker uploaded-media-ids" required/>
                                    </button>
                                    @error('attachments_id')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                    <div class="preview-thumbs">
                                        <br/>
                                        <ul class="list-preview-thumbs">
                                        </ul>
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
                                <textarea type="text" class="form-control"
                                    name="meta_description">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
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

<script>
    jQuery('document').ready(function(){
        jQuery('.download-type').on('change',function(){
           jQuery('.download-files').attr('data-type-media',jQuery(this).val());
        });
    });
</script>
@endpush