<div class="container-orders">
    <div class="form-group">
        <h5>
            <i class="lni lni-layers"></i>
            تفاصيل نموذج الطلب
        </h5>
        <hr class="line-isolate"/>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <ul class="lists-app-details">
            @foreach($order->order_attachments as $order_attachment)
                <li>
                    <strong>{{ str_replace("_"," ",$order_attachment->name) }}</strong>
                    @if($order_attachment->type == 'media')
                        <a class="btn btn-success btn-sm" data-fslightbox="gallery" href="{{ upload_assets($order_attachment->value,true) }}">
                            المرفق
                        </a>
                    @else
                        <span>{{ $order_attachment->value }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</div>

<style>
    .lists-app-details li{
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background-color: white;
        margin: 13px;
    }
</style>