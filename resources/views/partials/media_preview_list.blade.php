@php
$media = isset($media) ? $media : ImageInfo($media_id);

@endphp
@if($media)
    <li class="preview-media-inner" title="{{ $media ? $media->name : fetchImageInnerDetails($media) }}">
        {{-- <img src="{{ upload_assets($media_id,true) }}" /> --}}
        @if('video' == formateMediaType($media->type)[0])
            <video style="width:100%;height:100%" controls>
                <source src="{{ upload_assets($media_id,true) }}" type="{{ $media->type }}"></source>
            </video>
        @elseif('application' == formateMediaType($media->type)[0])
            <i style="font-size: 120px;" class='bx bxs-file-pdf'></i>
        @elseif('text' == formateMediaType($media->type)[0])
            <i style="font-size: 120px;" class='bx bxs-file-txt'></i>
        @elseif('image' == formateMediaType($media->type)[0])
            <img src="{{ upload_assets($media_id,true) }}"/>
        @else
            <i style="font-size: 120px;" class='bx bxs-file-blank'></i>
        @endif
        <i class='bx bxs-message-square-x remove' media-id="{{ $media_id }}"></i>
    </li>
@endif
