<div class="image-media-card text-center" title="{{ $media->name ?: fetchImageInnerDetails($media) }}">
    <span class="badge bg-primary" style="position: absolute;">
        {{ $media->type ? (formateMediaType($media->type)[1] == 'vnd.openxmlformats-officedocument.spreadsheetml.sheet' ? 'xlsx' : formateMediaType($media->type)[1]) : 'mime' }}
    </span>
    <div class="container-image">
        @if('video' == formateMediaType($media->type)[0])
            <video controls>
                <source src="{{ upload_assets($media) }}" type="{{ $media->type }}"></source>
            </video>
        @elseif('pdf' == formateMediaType($media->type)[1])
            <i style="font-size: 120px;" class='bx bxs-file-pdf'></i>
        @elseif('text' == formateMediaType($media->type)[0])
            <i style="font-size: 120px;" class='bx bxs-file-txt'></i>
        @elseif('image' == formateMediaType($media->type)[0])
            <img src="{{ upload_assets($media) }}" />
        @elseif('vnd.openxmlformats-officedocument.spreadsheetml.sheet' == formateMediaType($media->type)[1])
            <img src="{{ asset('assets/img/icons/xlsx.png') }}" class="list-item-image"/>
        @else
            <i style="font-size: 120px;" class='bx bxs-file-blank'></i>
        @endif
    </div>
    <p class="title-media-card text-center">
        {{ TrimLongText($media->name ?: fetchImageInnerDetails($media),50) }}
    </p>
    <p>
        {{ getOriginalSizeWithOriginalUnit($media->size) }}
    </p>
    <form action="{{ route('admin.medias.destroy',$media->id) }}" method="post">
        @method('DELETE')
        @csrf
        <button type="button" class="btn btn-danger delete-media btn-sm" style="margin: auto">حذف</button>
    </form>
</div>
