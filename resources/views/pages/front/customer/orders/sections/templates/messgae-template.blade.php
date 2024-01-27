@php $color = ($discussion->sender == 'platform' ? "#00968817" : "white") @endphp
<table class="table" style="background-color:{{ $color }};">
    <tr>
        <th>
            @if($discussion->sender == 'platform') منصة مكتب @else <i class="lni lni-user"></i> أنت @endif
        </th>
        <td style="text-align:left">{{ $discussion->created_at }}</td>
    </tr>
    <tr>
        <td colspan="2">
           {{ $discussion->message }}
        </td>
    </tr>
    <tr>
        <th>مرفقات </th>
        <td style="text-align:left">
            @if($discussion->attachments)
                @php $attachments = explode(',',$discussion->attachments) @endphp
                @foreach($attachments as $attachment)
                    @php $attachemnt_url = upload_assets($attachment,true) @endphp
                    @php $type           = strtolower(get_media_type($attachemnt_url)) @endphp
                    <a class="btn btn-dark btn-sm" @if(!in_array($type,['pdf'])) data-fslightbox="gallery" @else target="_blank" @endif href="{{ upload_assets($attachment,true) }}">
                        المرفق #{{ $attachment }}
                    </a>
                @endforeach
            @endif
        </td>
    </tr>
</table>