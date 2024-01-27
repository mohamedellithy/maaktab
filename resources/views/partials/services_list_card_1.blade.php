<div class="col-lg-4">
    <div class="services-item">
        <div class="services-content">
            <div class="content-top">
                <div class="icon">
                    <i class="fas fa-star"></i>
                </div>
                <h2 class="title">
                    {{ $service->name }}
                </h2>
            </div>
            <div class="services-thumb">
                <img  src="{{ upload_assets($service->image_info) }}" alt="">
                <a href="{{ url('service/'.$service->slug) }}" class="btns transparent-btns">عرض الخدمة</a>
            </div>
            <div class="list-wrap text-right">
                <h6>
                    {{ TrimLongText($service->description,50) }}
                </h6>
            </div>
        </div>
    </div>
</div>
