@extends('layouts.master_front')

@section('content')
    <!-- ====== Blog Details Start ====== -->
    <section class="ud-blog-details">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
                <form method="post" action="{{ route('application-submit',[
                    'application_id' => request('application_id') ?: null,
                    'selected_id'    => request('selected_id') ?: null,
                    'selected'       => request('selected') ?: null,
                ]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="ud-blog-details-content">
                        <h4 class="ud-blog-details-title">
                            <i class='lni lni-offer'></i>
                            {{ $application->app_name }}
                        </h4>
                        <div class="form-app" id="templateTable"></div>
                        <div class="form-group">
                            <br/>
                            <button type="submit" class="btn btn-success btn_send_form">
                                ارسال الطلب
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <div class="">
                    <div class="ud-newsletter-box">
                        <img
                            src="{{ asset('front/assets/images/blog/dotted-shape.svg') }}"
                            alt="shape"
                            class="shape shape-1"
                        />
                        <img
                            src="{{ asset('front/assets/images/blog/dotted-shape.svg') }}"
                            alt="shape"
                            class="shape shape-2"
                        />
                        @if(request('selected') == 'service')
                            <i class="lni lni-grid-alt icon-service"></i>
                            <h6 class="model-type">طلب خدمة </h6>
                        @else
                            <i class="lni lni-grid-alt icon-service"></i>
                            <h6 class="model-type">طلب مماثل لمشروع  </h6>
                        @endif
                        <h4 class="model-name">{{ $model->name }}</h4>
                    </div>
                  </div>
            </div>
          </div>
        </div>
      </section>
      <!-- ====== Blog Details End ====== -->
@endsection

@push('style')
<style>
    .ud-login{
        margin-top:2%;
    }
    .ud-login-wrapper{
        padding: 35px;
        box-shadow: 0px 0px 0px 0px !important;
    }
    .ud-related-articles-title::after{
        right: 0;
        left:auto !important;
    }
    .project-cost{
        color: orange;
        line-height: 2em;
    }
    .ud-blog-details-action{
        padding: 30px 0px;
    }
    .ud-blog-tags,.ud-blog-share-links{
        flex-direction: row-reverse;
    }
    /* .ud-blog-details {
        padding-top: 80px;
    } */
    .ud-blog-details-content{
        background-color: #e3f2fd73;
        padding: 2% 4%;
        /* box-shadow: 0px 0px 20px 10px #eeee; */
    }
    .ud-blog-details-content .form-group{
        padding: 3px;
    }
    .ud-blog-details-content .form-group .form-control
    {
        height: 50px;
        background-color: white;
        border-radius: 39px;
    }
    .ud-blog-details-content .form-group label{
        line-height: 2.5em;
        color: #626469;
        font-size: 14px;
        font-weight: bold;
    }
    .ud-blog-details-title{
        font-size: 20px;
        color: #8f1657;
        line-height: 50px;
        margin-bottom: 10px;
    }
    .model-name{
        padding: 10px 0px;
        color: white;
    }
    .model-type{
        line-height: 4em;
        color: orange;
    }
    .ud-newsletter-box {
        background: black;
        /*box-shadow: -13px 12px 0px 0px orange;*/
    }
    .btn_send_form{
        background-color: orange;
        border: 1px solid orange;
        border-radius: 30px;
        padding: 8px 30px;
        box-shadow: 0px 7px 10px 5px #dedede;
    }
    .icon-service{
        font-size:2em;
    }
    .ud-footer{
        margin-top: 8%;
    }
    .ud-blog-details-content .form-group {
        padding: 12px 3px;
    }
</style>
@endpush


@push('script')
<script>
    jQuery(function(){
        const ApllicationForm = {
            initialize:async function(){
                console.log('hi');
                ApllicationForm.LoadApplicationsFields();
            },
            LoadApplicationsFields:function(){
                const App_Fields = {!! json_encode($application->fields) !!};
                App_Fields.forEach(async function(item){
                    await ApllicationForm.FormField(JSON.parse(item));
                });
            },
            FormField:function(Field){
                console.log(Field);
                let div = document.createElement('div');
                div.setAttribute('class','form-group');
                let FieldHtml = ApllicationForm.InputField(Field);
                div.append(FieldHtml.Label);
                div.append(FieldHtml.Input);
                jQuery("#templateTable").append(div);
            },
            InputField:function(Field){
                // label name
                let Label    = document.createElement('label');
                let Name     = document.createTextNode(Field.name);
                let Icon     = document.createElement('i');
                Icon.setAttribute('class','lni lni-circle-minus');
                Icon.setAttribute('style','padding: 9px;');
                Label.appendChild(Icon);
                Label.appendChild(Name);

                // input field
                if(Field.type != 'textarea'){
                    Input = ApllicationForm.TextField(Field.type);
                } else if(Field.type == 'textarea'){
                    Input = ApllicationForm.TextArea();
                }
                //Input.setAttribute('placeholder',Field.name);
                let handle_file_name = Field.name.replaceAll(' ','_');
                Input.setAttribute('class','form-control');
                Input.setAttribute('required',true);
                Input.setAttribute('name',`${handle_file_name}`);

                // return tr
                return {Label,Input};
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
            }
        };

        ApllicationForm.initialize();
    });
</script>
@endpush
