@extends('layouts.master')
@php
$settings = platformSettings();
@endphp
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">انشاء نموذج طلب الخدمات</h4>
        <!-- Basic Layout -->
        <form action="{{ route('admin.applications.update',$application->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl" style="padding: 10px;">
                    <button type="submit" class="btn btn-success btn-sm">
                        تعديل النموذج
                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">اسم الحقل</label>
                                <input type="text" id="fieldName" class="form-control" id="basic-default-fullname" placeholder=""
                                    name="name" value="{{ old('name') }}"/>
                                @error('name')
                                    <span class="text-danger w-100 fs-6">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">نوع الحقل</label>
                                <select id="fieldType" class="form-control">
                                    <option value="text">نص</option>
                                    <option value="textarea">نص طويل</option>
                                    <option value="date">تاريخ</option>
                                    <option value="file">مرفقات</option>
                                    <option value="number">أرقام</option>
                                    <option value="tel">جوال</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-info btn-sm" id="addNewField">
                                اضافة حقل
                            </button>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">عنوان النموذج</label>
                                <input type="text" value="{{ old('app_name') ?: $application->app_name }}"  name="app_name" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">التصنيف الرئيسي</label>
                                <select id="main_category_id" name="main_category_id" class="form-control">
                                    <option value>-</option>
                                    @foreach($categories_main as $category_main)
                                        <option value="{{ $category_main->id }}" @if($category_main->id == $application->main_category_id) selected @endif>{{ $category_main->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="basic-icon-default-company">التصنيف الفرعي</label>
                                <select id="child_category_id" name="child_category_id" class="form-control">
                                    <option value>-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5>نموذج طلب الخدمات</h5>
                            <div id="template">
                                <table class="table" id="templateTable">
                                    <tr class="">
                                        <td colspan="3">
                                            نموذج الطلب
                                        </td>
                                    </tr>
                                </table>
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
        const ApllicationForm = {
            initialize:async function(){
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('conent')
                    }
                });

                jQuery('#addNewField').click(async function(e){
                    await ApllicationForm.FormField({
                        name : $('#fieldName').val(),
                        type : $('#fieldType').val(),
                    });
                    await ApllicationForm.TableDraggerInner();
                });

                jQuery('#main_category_id').change(function(){
                    let category_id = $(this).val();
                    ApllicationForm.load_child_categories(category_id);
                });

                ApllicationForm.LoadApplicationsFields();
                ApllicationForm.RemoveAction();
                ApllicationForm.TableDraggerInner();
                ApllicationForm.load_child_categories("{{ $application->main_category_id }}","{{ $application->child_category_id }}");
            },
            LoadApplicationsFields:function(){
                const App_Fields = {!! json_encode($application->fields) !!};
                App_Fields.forEach(async function(item){
                    await ApllicationForm.FormField(JSON.parse(item));
                });
            },
            FormField:function(Field){
                console.log(Field);
                $('.alert-empty').hide();
                let tr = document.createElement('tr');
                tr.setAttribute('class','handle');
                let FieldHtml = ApllicationForm.InputField(Field);
                let actions_icon = ApllicationForm.RemoveField();
                tr.append(FieldHtml.td_name);
                tr.append(FieldHtml.td_field);
                tr.append(actions_icon);
                $("#templateTable").append(tr);
            },
            RemoveField:function(){
                let td_action  = document.createElement('td');
                td_action.setAttribute('class','actions_tr');
                let remove_icon = document.createElement('i');
                remove_icon.setAttribute('class','bx bx-x remove-item');
                td_action.append(remove_icon);
                return td_action;
            },
            InputField:function(Field){
                // label name
                let td_name  = document.createElement('td');
                let Label    = document.createElement('label');
                let Name     = document.createTextNode(Field.name);
                Label.appendChild(Name);
                td_name.append(Label);

                // input field
                let td_field = document.createElement('td');
                if(Field.type != 'textarea'){
                    Input = ApllicationForm.TextField(Field.type);
                } else if(Field.type == 'textarea'){
                    Input = ApllicationForm.TextArea();
                }
                Input.setAttribute('placeholder',Field.name);
                Input.setAttribute('class','form-control');
                td_field.append(Input);

                // input have Object
                InputObject = ApllicationForm.InputHaveObject(Field);
                td_field.append(InputObject);

                // return tr
                return {td_name,td_field};
            },
            TextField:function(type){
                let Input = document.createElement('input');
                Input.setAttribute('type',type);
                return Input;
            },
            TextArea:function(){
                let Input = document.createElement('textarea');
                Input.setAttribute('rows','1');
                return Input;
            },
            InputHaveObject:function(Field){
                let Input = document.createElement('input');
                Input.setAttribute('type','hidden');
                Input.setAttribute('name','fields[]');
                Input.setAttribute('value',JSON.stringify(Field));
                return Input;
            },
            RemoveAction:function(){
                $('table#templateTable').on('click','.remove-item',function(){
                    $(this).parents('tr').remove();
                });
            },
            TableDraggerInner:function(){
                var el = document.querySelector('table#templateTable');
                tableDragger.default(el,{
                    mode: 'row',
                    dragHandler: '.handle',
                    animation: 1000
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
                       ApllicationForm.CategoryOptions(result.item,selected_category);
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
            }
        };

        ApllicationForm.initialize();
    });


</script>
@endpush


@push('style')
<style>
    .actions_tr{
        padding: 12px;
    }
    .actions_tr i
    {
        background-color: red;
        padding: 4px;
        color: white;
    }
    #templateTable input{
        height: 35px;
    }
</style>
@endpush
