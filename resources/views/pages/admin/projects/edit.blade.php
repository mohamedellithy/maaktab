@extends('layouts.master')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3" style="padding-bottom: 0rem !important;">اضافة مشروع جديد</h4>
        <!-- Basic Layout -->
        <form action="{{ route('admin.projects.update',$project->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-xl" style="padding: 0px 10px 10px;text-align: left;">
                    <button type="submit" class="btn btn-success btn-sm">تعديل المشروع</button>
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
                                    name="name" value="{{ $project->name }}" required/>
                                @error('name')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company "> نبذة عن المشروع </label>
                                <textarea id="basic-default-message" class="form-control"  rows="3" placeholder="" name='short_description' required>{{ $project->short_description }}</textarea>
                                @error('short_description')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company"> وصف المشروع</label>
                                <textarea id="basic-default-message" class="form-control summernote"  rows="10" placeholder="" name='description' required>{{ $project->description }}</textarea>
                                @error('description')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">سعر المشروع</label>
                                <input id="basic-default-message" class="form-control" placeholder="" name='price' value="{{ $project->price }}" required>
                                @error('price')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="mb-3">
                                <label class="form-label" for="basic-default-company">خصم على المشروع</label>
                                <input id="basic-default-message" class="form-control" placeholder="" name='discount' value="{{ $project->discount }}">
                                @error('discount')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">نوع الخصم</label>
                                <select class="form-control" name="discount_type">
                                    <option value="value" @if($project->discount_type == 'value') selected @endif>بالقيمة</option>
                                    <option value="percent" @if($project->discount_type == 'percent') selected @endif>بالنسبة</option>
                                </select>
                                @error('discount_type')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div> --}}
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company"> رابط المشروع</label>
                                <input id="basic-default-message" class="form-control" placeholder="" name='slug' value="{{ $project->slug }}" required>
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
                                    <option value="pdf"   @isset($project->downloads) @if($project->downloads->download_type == 'pdf') selected @endif   @endisset>Pdf</option>
                                    <option value="image" @isset($project->downloads) @if($project->downloads->download_type == 'image') selected @endif @endisset>Image</option>
                                    <option value="video" @isset($project->downloads) @if($project->downloads->download_type == 'video') selected @endif @endisset>Video</option>
                                    <option value="audio" @isset($project->downloads) @if($project->downloads->download_type == 'audio') selected @endif @endisset>Audio</option>
                                    <option value="zip"   @isset($project->downloads) @if($project->downloads->download_type == 'zip') selected @endif   @endisset>Zip</option>
                                    <option value="zoom"   @isset($project->downloads) @if($project->downloads->download_type == 'zoom') selected @endif   @endisset>Zoom</option>
                                    <option value="vnd.openxmlformats-officedocument.spreadsheetml.sheet"   @isset($project->downloads) @if($project->downloads->download_type == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet') selected @endif   @endisset>xlsx</option>

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
                                        <input type="hidden" name="download_attachments_id" @isset($project->downloads) value="{{ $project->downloads->download_attachments_id  }}" @endisset
                                            class="form-control dob-picker uploaded-media-ids"/>
                                    </button>
                                    @error('download_attachments_id')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                    <div class="preview-thumbs">
                                        <br/>
                                        <ul class="list-preview-thumbs">
                                            @isset($project->downloads)
                                                @if($project->downloads->download_attachments_id)
                                                    @foreach(GetAttachments($project->downloads->download_attachments_id) as $attachment)
                                                        <li class="preview-media-inner" title="{{ $attachment->name ?: fetchImageInnerDetails($attachment) }}">
                                                            @if(formateMediaType($attachment->type)[0] == 'video')
                                                                <video style="width:100%;height:100%" controls>
                                                                    <source src="{{ upload_assets($attachment) }}" type="{{ $attachment->type }}"></source>
                                                                </video>
                                                            @elseif(formateMediaType($attachment->type)[1] =='pdf')
                                                                <i style="font-size: 120px;" class='bx bxs-file-pdf'></i>
                                                            @elseif(formateMediaType($attachment->type)[0] == 'audio')
                                                                <audio style="width:100%;height:100%" controls>
                                                                    <source src="{{ upload_assets($attachment) }}" type="{{ $attachment->type }}"></source>
                                                                </audio>
                                                            @elseif(formateMediaType($attachment->type)[0] =='image')
                                                                <img src="{{ upload_assets($attachment) }}"/>
                                                            @else
                                                                <i style="font-size: 120px;" class='bx bxs-file-blank'></i>
                                                            @endif
                                                            <i class='bx bxs-message-square-x remove' media-id="{{ $attachment->id }}"></i>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            @endisset
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">حالة الملف</label>
                                <select type="url" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="download_status" value="{{ old('download_status') }}">
                                    <option value="download"         @isset($project->downloads) @if($project->downloads->download_status == 'download')  selected  @endif @endisset>تنزيل الملف او الفيديو</option>
                                    <option value="without_download" @isset($project->downloads) @if($project->downloads->download_status == 'without_download')  selected @endif @endisset>مشاهدة بدون تنزيل</option>
                                </select>
                                @error('download_status')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">رابط ملف التحميل ان وجدت</label>
                                <input type="url" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="download_link"  @isset($project->downloads) value="{{ $project->downloads->download_link ?: old('download_link') }}" @endisset>
                                @error('download_link')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">اسم الملف التحميلات</label>
                                <input type="text" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="download_name" @isset($project->downloads) value="{{ $project->downloads->download_name ?: old('download_name') }}" @endisset/>
                                @error('download_name')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">وصف ملف التحميلات</label>
                                <textarea type="text" class="form-control summernote" id="basic-default-fullname" placeholder=""
                                    name="download_description">{{  $project->downloads ? $project->downloads->download_description : old('download_description') }}</textarea>
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
                                        <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" value="active" @if($project->status == 'active') checked @endif>
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
                                                <option value="{{ $category_main->id }}" @if($project->main_category_id == $category_main->id) selected @endif>{{ $category_main->name }}</option>
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
                                <input type="date" id="basic-default-message" class="form-control" placeholder="" name='from' value="{{ $project->from  }}" >
                                @error('from')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-company">تاريخ نهاية المشروع</label>
                                <input type="date" id="basic-default-message" class="form-control" placeholder="" name='to' value="{{ $project->to }}">
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
                                        <input type="hidden" name="thumbnail_id" value="{{ $project->thumbnail_id }}"
                                            class="form-control dob-picker uploaded-media-ids"/>
                                    </button>
                                    @error('thumbnail_id')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                    <div class="preview-thumbs">
                                        <br/>
                                        <ul class="list-preview-thumbs">
                                            @if($project->thumbnail_id)
                                                <li class="preview-media-inner">
                                                    <img src="{{ upload_assets($project->image_info) }}" />
                                                    <i class='bx bxs-message-square-x remove' media-id="{{ $project->thumbnail_id }}"></i>
                                                </li>
                                            @endif
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
                                        اضافة صور أخري  للمشروع
                                        <input type="hidden" name="attachments_id" value="{{ $project->attachments_id }}"
                                            class="form-control dob-picker uploaded-media-ids"/>
                                    </button>
                                    @error('attachments_id')
                                        <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                    @enderror
                                    <div class="preview-thumbs">
                                        <br/>
                                        <ul class="list-preview-thumbs">
                                            @if($project->attachments_id)
                                                @foreach(GetAttachments($project->attachments_id) as $attachment)
                                                    <li class="preview-media-inner">
                                                        <img src="{{ upload_assets($attachment) }}" />
                                                        <i class='bx bxs-message-square-x remove' media-id="{{ $attachment->id }}"></i>
                                                    </li>
                                                @endforeach
                                            @endif
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
                                <textarea type="text" id="basic-icon-default-company" class="form-control"
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
        const ProjectOperations = {
            initialize:async function(){
                ProjectOperations.load_child_categories(
                    "{{ $project->main_category_id }}",
                    "{{ $project->child_category_id }}");
                ProjectOperations.load_child_applications(
                    "{{ $project->main_category_id }}",
                    "{{ $project->child_category_id }}",
                    "{{ $project->application_id }}");

                jQuery('#main_category_id').change(function(){
                    let category_id = $(this).val();
                    ProjectOperations.load_child_categories(category_id);
                    ProjectOperations.load_child_applications(category_id);
                });

                jQuery('#child_category_id').change(function(){
                    let category_id = $('#main_category_id').val();
                    let child_category_id = $(this).val();
                    ProjectOperations.load_child_applications(category_id,child_category_id);
                });
            },
            load_child_categories:function(main_category,selected_category = null){
                var route = "{{ route('admin.categories.child_categories',':id') }}";
                route = route.replace(':id',main_category);
                $.ajax({
                    type: 'GET',
                    url: route,
                    dataType: 'json',
                    success: function( result ) {
                        ProjectOperations.CategoryOptions(result.item,selected_category);
                    }
                });
            },
            CategoryOptions:function(items,selected_category = null){
                $('#child_category_id').html('');
                items.forEach(function(item){
                    var option = document.createElement('option');
                    option.setAttribute('value',item.id);
                    if(selected_category == item.id){
                        option.setAttribute('selected',true);
                    }
                    var optionLabel = document.createTextNode(item.name);
                    option.appendChild(optionLabel);
                    $('#child_category_id').append(option);
                });
            },
            load_child_applications:function(main_category,child_category = null,selected_category = null){
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
                        ProjectOperations.ApplicationsOptions(result.item);
                    }
                });
            },
            ApplicationsOptions:function(items,selected_category = null){
                $('#application_id').html('');
                items.forEach(function(item){
                    var option = document.createElement('option');
                    option.setAttribute('value',item.id);
                    if(selected_category == item.id){
                        option.setAttribute('selected',true);
                    }
                    var optionLabel = document.createTextNode(item.app_name);
                    option.appendChild(optionLabel);
                    $('#application_id').append(option);
                });
            }
        };

        ProjectOperations.initialize();
    });

    jQuery('document').ready(function(){
        jQuery('.download-type').on('change',function(){
           jQuery('.download-files').attr('data-type-media',jQuery(this).val());
        });
    });
</script>
@endpush
