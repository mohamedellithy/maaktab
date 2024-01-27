@forelse($medias as $key => $media)
    <li class="media-item" title="{{ $media->name ?: fetchImageInnerDetails($media) }}" media-path="{{ upload_assets($media) }}" media-id="{{ $media->id }}" media-type="{{ $media->type }}">
        @if('video' == formateMediaType($media->type)[0])
            <video style="width:100%;height:100%" controls>
                <source src="{{ upload_assets($media) }}" type="{{ $media->type }}"></source>
            </video>
        @elseif('pdf' == formateMediaType($media->type)[1])
            <i style="font-size: 120px;" class='bx bxs-file-pdf'></i>
        @elseif('text' == formateMediaType($media->type)[0])
            <i style="font-size: 120px;" class='bx bxs-file-txt'></i>
        @elseif('image' == formateMediaType($media->type)[0])
            <img src="{{ upload_assets($media) }}" class="list-item-image"/>
        @elseif('vnd.openxmlformats-officedocument.spreadsheetml.sheet' == formateMediaType($media->type)[1])
            <img src="{{ asset('assets/img/icons/xlsx.png') }}" class="list-item-image"/>
        @else
            <i style="font-size: 120px;" class='bx bxs-file-blank'></i>
        @endif
    </li>
@empty
@endforelse
