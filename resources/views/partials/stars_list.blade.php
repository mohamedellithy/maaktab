@if($product->reviews_avg_degree > 5)
    @php $product->reviews_avg_degree = 5 @endphp
@endif

@if($product->reviews_avg_degree)
    @php $half = explode('.',$product->reviews_avg_degree)[1] @endphp
    <div class="rating" title="{{ $product->reviews_avg_degree }}">
        @for($i = 1;$i <= $product->reviews_avg_degree;$i++)
            <i class="fas fa-star active"></i>
        @endfor

        @for($i=1;$i <= ceil(5-$product->reviews_avg_degree);$i++)
            @if($half > 0)
                <i class="fas fa-star-half-alt" style="color: #ffa500;transform: rotateY(188deg);"></i>
            @else
                <i class="fas fa-star"></i>
            @endif
        @endfor
        ( {{ $product->reviews_count }} )
    </div>
@else
    <div class="rating" title="{{ $product->reviews_avg_degree }}">
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
        <i class="fas fa-star"></i>
    </div>
@endif