<div class="container-orders">
    <div class="form-group">
        <h5>
            <i class="lni lni-layers"></i>
            مناقشات المشروع
        </h5>
        <hr class="line-isolate"/>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <form id="sendMessage" method="post">
            <table class="table table-borderless" style="background-color: white;">
                <tr>
                    <td style="padding: 18px;">
                        <textarea id="message" class="form-control" name="message"></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px;">
                        <label>مرفقات</label>
                        <input id="files" name="files[]" type="file" class="form-control" multiple/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 10px;">
                        <button type="submit" class="btn btn-danger btn-sm">
                            ارسال
                        </button>
                    </td>
                </tr>
            </table>
        </form>
        <div id="new-messages"></div>
        @foreach($data['project-discussions'] as $discussion)
            @include('pages.front.customer.orders.sections.templates.messgae-template')
        @endforeach
        {!! $data['project-discussions']->links() !!}
    </div>
</div>
<script>
    const Messages = {
        formData:new FormData(),
        initailize:function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery('#sendMessage input[type="file"]').change(function(e) {
                Messages.UploadMedia(e);
            });

            jQuery('#sendMessage').submit(function(e){
                e.preventDefault();
                Messages.SendMessage();
            });
        },
        SendMessage:function(){
            let message  = jQuery('#message').val();
            let order_id = "{{ $order->id }}";
            Messages.formData.append('message',message);
            Messages.formData.append('order_id',order_id);
            $.ajax({
                type: 'POST',
                url: "{{ route('send_message') }}",
                enctype: 'multipart/form-data',
                dataType: 'json',
                processData: false,
                contentType: false,
                cache: false,
                data: Messages.formData,
                success: function( result ) {
                    if ( result.success ) {
                        console.log( result);
                        jQuery('#new-messages').prepend(result.template);
                        jQuery('#message').val("");
                        jQuery('#sendMessage input[type="file"]').val("");
                    }
                },
            }); 
        },
        UploadMedia:function(e){
            let medias = e.target.files;
            for (let i = 0; i < medias.length; i++) {
                console.log(medias[i]);
                Messages.formData.append(`medias[${i}]`, medias[i]);
            }
            
        }
    };
    Messages.initailize();

    
</script>
<script type="text/javascript" src="{{ asset('front/assets/js/fslightbox.js') }}"></script>
