<div class="container-orders">
    <div class="form-group">
        <h5>
            <i class="lni lni-layers"></i>
            عروض على المشروع
        </h5>
        <hr class="line-isolate"/>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        @foreach($data['proposals'] as $proposal)
            @php $color = ($proposal->status == 'accepted' ? "#00968817" : "white") @endphp
            <table class="table" style="background-color:{{ $color }};">
                <tr>
                    <th>قيمة العرض</th>
                    <td>{{ $proposal->price }} SAR</td>
                    <th>تاريخ العرض</th>
                    <td>{{ $proposal->created_at }}</td>
                    <td>
                        @if($proposal->status == 'wait')
                            <form method="post" action="{{ route('admin.proposals.destroy',$proposal->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="" style="background: transparent;border:0px solid white"> 
                                    <i class="bx bx-trash me-2" style="color:red"></i>
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="padding: 4% 1%;">
                        {{ $proposal->description }}
                    </td>
                </tr>
                <tr>
                    <th>حالة العرض</th>
                    <td>{!! get_status_html($proposal->status) !!}</td>
                    <th>مرفقات العرض</th>
                    <td colspan="2">
                        @if($proposal->attachments)
                            @php $attachments = explode(',',$proposal->attachments) @endphp 
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
                @if($proposal->status == 'wait')
                    <tr>
                        <td colspan="5" class="d-flex">
                            <form class="accept" method="post" style="margin-left:10px" action="{{ route('accept-proposal',['proposal_id' => $proposal->id]) }}">
                                @csrf
                                <button class="btn btn-success btn-sm">
                                    قبول العرض
                                </button>
                            </form>
                            <form class="refused" method="post" style="margin-left:10px" action="{{ route('refuse-proposal',['proposal_id' => $proposal->id]) }}">
                                @csrf
                                <button class="btn btn-danger btn-sm">
                                    رفض العرض
                                </button>
                            </form>
                        </td>
                    </tr>
                @endif
            </table>
        @endforeach
    </div>
</div>
<script>
    jQuery('form.accept').submit(function(e){
        if(!confirm('هل بالفعل تريد قبول العرض')){
            e.preventDefault();
        }
    });
    jQuery('form.refused').submit(function(e){
        if(!confirm('هل بالفعل تريد رفض العرض')){
            e.preventDefault();
        }
    });
</script>