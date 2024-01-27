@if($results)
    <ul class="search-result">
        @forelse($results as $result)
            <li style="text-align: right;">
                @if(isset($result->short_description))
                    <a href="{{ route('single_product',['slug' => $result->slug]) }}">
                        <h4>{{ $result->name }}</h4>
                        <p class="description">
                            {!! TrimLongText($result->description,200)  !!}
                        </p>
                    </a>
                @else
                    <a href="{{ route('single_service',['slug' => $result->slug]) }}">
                        <h4>{{ $result->name }}</h4>
                        <p class="description">
                            {!! TrimLongText($result->description,200)  !!}
                        </p>
                    </a>
                @endif
            </li>
        @empty
         <h4 style="text-align: center;">
            لايوجد نتائج متعلقة
         </h4>
        @endforelse
    </ul>
@endif

<style>
    .search-result{
        padding: 20px;
        height: 300px;
        overflow-y: scroll;
        background-color: white;
    }
    .search-result li{
        text-align: right;
        padding: 13px;
    }

</style>