<script>
    const BroCastMedia = {
        self:null,
        page:1,
        params:{},
        typeMedia:'all',
        global_media_ids:null,
        multiple_upload:false,
        medias:null,
        urlMediaLists:"{{ route('admin.media-lists.index') }}",
        urlStoreMedia:"{{ route('admin.media-lists.store') }}",
        initialize:function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // show lists media
            jQuery('.upload-media').click(function(){
                BroCastMedia.global_media_ids = this;
                BroCastMedia.multiple_upload  = jQuery(this).attr('data-multiple-media');
                BroCastMedia.typeMedia        = jQuery(this).attr('data-type-media');
                BroCastMedia.params.typeMedia = BroCastMedia.typeMedia;
                BroCastMedia.OpenModelMedia();
                BroCastMedia.LoadMedias(BroCastMedia.params);
            });

            // show load more lists
            jQuery('.load-more-medias').click(function() {
                BroCastMedia.LoadMoreMedias();
            });

            // uploda files and medias
            jQuery('.btn-upload input[type="file"]').change(function(e) {
                BroCastMedia.UploadMedia(e);
            });

            // select media
            jQuery('.modal').on('click','.list-medias .media-item',function(){
                BroCastMedia.SelectMedia(this);
            });

            // action selected media
            jQuery('.modal').on('click', '.select-media', function() {
                BroCastMedia.SelectedMediaAction();
            });

            // remove media
            jQuery('.container-uploader').on('click', '.preview-media-inner .remove', function() {
                BroCastMedia.RemoveMedia(this);
            });

        },
        LoadMedias:function(data = {}){
            console.log(data,'bn');
            $.ajax({
                type: 'GET',
                url: BroCastMedia.urlMediaLists,
                data: data,
                success: function(data) {
                    console.log(data);
                    jQuery('.list-medias').append(data._result);
                    if (data._result.length == 0) {
                        jQuery('.load-more-medias').hide();
                        console.log('hi');
                    }
                }
            });
        },
        LoadMoreMedias:function(){
            BroCastMedia.page +=1;
            BroCastMedia.params.page = BroCastMedia.page;
            BroCastMedia.params.typeMedia = BroCastMedia.typeMedia;
            BroCastMedia.LoadMedias(BroCastMedia.params);
        },
        OpenModelMedia:function(){
            jQuery('#exLargeModal').modal('show');
            jQuery('.load-more-medias').show();
            jQuery('.list-medias').html('');
        },
        SelectMedia:function(self){
            if(BroCastMedia.multiple_upload  != 'true'){
                if(BroCastMedia.self != self){
                    jQuery(".media-item.active").removeClass('active');
                }
            }
            jQuery(self).toggleClass('active');
            BroCastMedia.self = self;
        },
        UploadMedia:function(e){
            let formData =  BroCastMedia.ShowUploadingMedia(e);
            BroCastMedia.UploadMediaAjax(formData);
        },
        ShowUploadingMedia:function(e){
            BroCastMedia.medias = e.target.files;
            var formData = new FormData();
            for (let i = 0; i < BroCastMedia.medias.length; i++) {
                let url = URL.createObjectURL(BroCastMedia.medias[i]);
                formData.append(`medias[${i}]`, BroCastMedia.medias[i]);
                if(BroCastMedia.medias[i]['type'] == 'video/mp4'){
                    jQuery('.list-upload-medias').append(BroCastMedia.MediaHtmlVideo(true,{media_path:url},`uploadItem-${i}`));
                } else {
                    jQuery('.list-upload-medias').append(BroCastMedia.MediaHtmlImage(true,{media_path:url},`uploadItem-${i}`));
                }
            }

            return formData;
        },
        UploadMediaAjax:function(formData){
            $.ajax({
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            console.log(percentComplete);
                        }
                    }, false);
                    return xhr;
                },
                type: 'POST',
                url: BroCastMedia.urlStoreMedia,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                data: formData,
                success: function(data) {
                    data._result.forEach((element, key) => {
                        console.log(element, key);
                        jQuery(
                                `.list-upload-medias li.uploadItem-${key} .progress.upload`)
                            .remove();
                        jQuery(`.list-upload-medias li.uploadItem-${key} img`).css({
                            'opacity': '1'
                        })
                    });
                }
            });
        },
        SelectedMediaAction:function(){
            let media_ids = [];
            let preview_thumbs = jQuery(BroCastMedia.global_media_ids).parents('.container-uploader').find('.preview-thumbs .list-preview-thumbs');
            document.querySelectorAll('.list-medias .media-item.active').forEach((ele) => {
                let media_path = ele.getAttribute('media-path');
                let media_id = ele.getAttribute('media-id');
                let media_type = ele.getAttribute('media-type');
                let params = {media_path,media_id,media_type};
                media_ids.push(media_id);
                if(BroCastMedia.multiple_upload  != 'true'){
                    if(media_type == 'video/mp4'){
                        preview_thumbs.html(BroCastMedia.MediaHtmlVideo(false,params,"preview-media-inner"));
                    } else {
                        preview_thumbs.html(BroCastMedia.MediaHtmlImage(false,params,"preview-media-inner"));
                    }
                } else {
                    if(media_type == 'video/mp4'){
                        preview_thumbs.append(BroCastMedia.MediaHtmlVideo(false,params,"preview-media-inner"));
                    } else {
                        preview_thumbs.append(BroCastMedia.MediaHtmlImage(false,params,"preview-media-inner"));
                    }
                }
            });

            let prev_ids_thumbs = "";
            let join_media      = media_ids.join(',');
            if(BroCastMedia.multiple_upload  == 'true'){
                prev_ids_thumbs = jQuery(BroCastMedia.global_media_ids).find('.uploaded-media-ids').val();
                if(prev_ids_thumbs){
                    join_media = join_media + "," + prev_ids_thumbs;
                }
            }

            let join_list = jQuery(BroCastMedia.global_media_ids).find('.uploaded-media-ids').val(join_media);
            if (jQuery('#exLargeModal').length) {
                jQuery('#exLargeModal').modal('hide');
            }
        },
        RemoveMedia:function(self){
            let select_media_id = jQuery(self).attr('media-id');
            let media_join_list = jQuery(self).parents('.container-uploader').find('.uploaded-media-ids').val();
            let media_lists = media_join_list.split(',');
            media_lists.splice(media_lists.indexOf(select_media_id),1);
            console.log(select_media_id,media_lists);
            jQuery(self).parents('.container-uploader').find('.uploaded-media-ids').val(media_lists.join(','));
            jQuery(self).parents('.preview-media-inner').remove();
        },
        MediaHtmlImage:function(progress = false,{media_path,media_id},class_name){
            let media = ``;
            if(progress == false){
                media = `<li class="${class_name}">
                                <img src="${media_path}" />
                                <i class='bx bxs-message-square-x remove' media-id="${media_id}"></i>
                            </li>`;
            } else if(progress == true){
                media = `<li class="${class_name}">
                            <img src="${media_path}" class="img-uploaded">
                            <div class="progress upload">
                                <div class="progress-bar" role="progressbar" style="width: 35%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                        </li>`;
            }
            return media;
        },
        MediaHtmlVideo:function(progress = false,{media_path,media_id,media_type},class_name){
            let media = ``;
            if(progress == false){
                media = `<li class="${class_name}">
                                <video style="width:100%;height:100%" controls>
                                    <source src="${media_path}" type="${media_type}"></source>
                                </video>
                                <i class='bx bxs-message-square-x remove' media-id="${media_id}"></i>
                            </li>`;
            } else if(progress == true){
                media = `<li class="${class_name}">
                            <video style="width: 100%;height: 100%;" class="img-uploaded" controls>
                                <source src="${media_path}" type="video/mp4">
                            </video>
                            <div class="progress upload">
                                <div class="progress-bar" role="progressbar" style="width: 35%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                        </li>`;
            }
            return media;
        }
    };

    BroCastMedia.initialize();
</script>