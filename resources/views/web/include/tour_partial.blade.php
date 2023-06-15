@foreach ($tours as $tour)
    <div class="col-md-6 isotope-item popular">
        <div class="box_grid">
            <figure>
                <a href="{{ route('tours.show', $tour->id) }}">
                    <img src="{{ $tour->firstImage() }}" class="img-fluid" alt="tour-{{ $tour->id }}" width="800" height="533">
                    <div class="read_more"><span>{{ __('Read more') }}</span>
                    </div>
                </a>
                @if($tour->discount_active === 1)
                    <span class="discount">-{{ $tour->discount_percent }}%</span>
                @endif
                <small>{{ $tour->category->name }}</small>
            </figure>
            <div class="wrapper">
                <h3><a href="#">{{ $tour->title }}</a></h3>
                <p>{{ $tour->summary90() }}</p>
                @if(isset($tour->price))
                    @if($tour->discount_active === 1)
                        <span class="price">
                      <strong>{{$tour->discount_price}}$</strong></span>
                        <span class="discount_price">
                            <strong>{{ $tour->price }}$</strong>
                            <div class="timer" data-time="{{\Carbon\Carbon::make($tour->discount_end_time)->format('Y-m-d H:i')}}"></div>
                        </span>
                    @else
                        <span class="price"><strong>{{ $tour->price }}$</strong></span>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endforeach
@section('js')
    <script>
        // Set the date we're counting down to
        var timers = document.getElementsByClassName("timer");

        for (let timer in timers) {
            var countDownDate = new Date(timer.getAttribute('data-time')).getTime();
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
                timer.innerHTML = days + "d " + hours + "h "
                    + minutes + "m " + seconds + "s ";

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    timer.innerHTML = "EXPIRED";
                }
            }, 1000);
        }



    </script>

@endsection