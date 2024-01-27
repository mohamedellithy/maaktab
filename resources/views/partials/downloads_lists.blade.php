<div class="accordion" id="accordionExample ">
    @if($order->order_items->product->downloads)
        @if($order->order_items->product->downloads->download_attachments_id)
            @foreach(GetAttachments($order->order_items->product->downloads->download_attachments_id) as $key => $attachment)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $key }}">
                        <button class="accordion-button @if($loop->index != 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                        ملف ( {{ $attachment->name }} )
                        </button>
                    </h2>
                    <div id="collapse{{ $key }}" class="accordion-collapse collapse @if($loop->index == 0) show @endif" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            @if(formateMediaType($attachment->type)[0] == 'video')
                                <video
                                    id="my-video"
                                    class="video-js"
                                    controls
                                    preload="auto"
                                    width="640"
                                    height="464"
                                    data-setup="{}"
                                >
                                    @if(isset($order->order_items->product->downloads->download_link))
                                        <source src='{{ $order->order_items->product->downloads->download_link  }}' type="video/mp4" />
                                        <source src='{{ $order->order_items->product->downloads->download_link }}' type="video/webm" />
                                    @else
                                        <source src='/view-attachments/{{ $attachment->id  }}' type="video/mp4" />
                                        <source src='/view-attachments/{{ $attachment->id }}' type="video/webm" />
                                    @endif
                                    <p class="vjs-no-js">
                                    To view this video please enable JavaScript, and consider upgrading to a
                                    web browser that
                                    <a href="https://videojs.com/html5-video-support/" target="_blank"
                                        >supports HTML5 video</a
                                    >
                                    </p>
                                </video>
                            @elseif(formateMediaType($attachment->type)[0] == 'audio')
                                <audio controls controlsList="nodownload">
                                    @if(isset($order->order_items->product->downloads->download_link))
                                        <source src='{{ $order->order_items->product->downloads->download_link  }}' >
                                        <source src='{{ $order->order_items->product->downloads->download_link }}'  >
                                    @else
                                        <source src='/view-attachments/{{ $attachment->id  }}' >
                                        <source src='/view-attachments/{{ $attachment->id  }}'>
                                    @endif
                                    Your browser does not support the audio element.
                                </audio>
                            @elseif(formateMediaType($attachment->type)[0] == 'image')
                                @if(isset($order->order_items->product->downloads->download_link))
                                    <img src='{{ $order->order_items->product->downloads->download_link  }}' />
                                @else
                                    <img src='/view-attachments/{{ $attachment->id  }}' >
                                @endif
                            @else
                                @if(isset($order->order_items->product->downloads->download_link))
                                    <iframe src='{{ $order->order_items->product->downloads->download_link }}#toolbar=0' id="myiframe" width="100%" height="500px"></iframe>
                                @else
                                    <iframe src='/view-attachments/{{ $attachment->id }}#toolbar=0' width="100%" id="myiframe" height="500px"></iframe>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    ملف ( {{ $order->order_items->product->downloads->download_name }} )
                    </button>
                </h2>
                <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @if($order->order_items->product->downloads->download_type == 'video')
                            <video
                                id="my-video"
                                class="video-js"
                                controls
                                preload="auto"
                                width="640"
                                height="464"
                                data-setup="{}"
                            >
                                @if(isset($order->order_items->product->downloads->download_link))
                                    <source src='{{ $order->order_items->product->downloads->download_link  }}' type="video/mp4" />
                                    <source src='{{ $order->order_items->product->downloads->download_link }}' type="video/webm" />
                                @endif
                                <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank"
                                    >supports HTML5 video</a
                                >
                                </p>
                            </video>
                        @elseif($order->order_items->product->downloads->download_type  == 'audio')
                            <audio controls controlsList="nodownload">
                                @if(isset($order->order_items->product->downloads->download_link))
                                    <source src='{{ $order->order_items->product->downloads->download_link  }}' >
                                    <source src='{{ $order->order_items->product->downloads->download_link }}'  >
                                @endif
                                Your browser does not support the audio element.
                            </audio>
                        @elseif($order->order_items->product->downloads->download_type  == 'image')
                            @if(isset($order->order_items->product->downloads->download_link))
                                <img src='{{ $order->order_items->product->downloads->download_link  }}' />
                            @endif
                        @else
                            @if(isset($order->order_items->product->downloads->download_link))
                                <iframe src='{{ $order->order_items->product->downloads->download_link }}#toolbar=0' id="myiframe" width="100%" height="500px"></iframe>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @endif

    @endif
</div>
