@php
    $startDate = $product->from ?: null;
    $endDate   = $product->to ?: null;
    $allow_register = true;
    $diffInDate = null;
@endphp
@php
    if(($product->from != null) && ($product->to != null)){
        if(strtotime($product->from) > strtotime(date('Y-m-d h:i:s')) ){
            $diffInDate = $startDate;
            $text = "متبقي على بداية العرض";
            $allow_register = false;
        } elseif(strtotime($product->to) > strtotime(date('Y-m-d h:i:s')) ) {
            $diffInDate = $endDate;
            $text = "متبقي على نهاية العرض";
            $allow_register = true;
        } else {
            $diffInDate = null;
            $allow_register = false;
        }
    }
@endphp
@if($diffInDate)
    <p class="countdown-all">
        {{ $text }}
        <span id="countdown"></span>
    </p>
@endif

<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{ $diffInDate }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";
    }, 1000);
</script>
