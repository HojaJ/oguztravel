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