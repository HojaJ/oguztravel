@extends('layouts.app')

@section('title') {{ __('Tours') }} @endsection
@section('main')
@if ($cover && $cover->filename)
<style>
  .hero_in.tours:before {
    background-image: url('{{ $cover->getImage() }}');
  }

</style>
@endif

<section class="hero_in tours">
  <div class="wrapper">
    <div class="container">
      <h1 class="fadeInUp"><span></span>{{ __('Tours') }}</h1>
    </div>
  </div>
</section>
@if ($about)
  <div class="bg_color_1">
    <div class="container margin_80_55">
      <div class="main_title_2">
        <span><em></em></span>
        <h2>{{ $about->title }}</h2>
        <p>{{ $about->subtitle }}</p>
      </div>
      <div class="row justify-content-between">
        <div class="col-lg-6 wow" data-wow-offset="150">
          <div id="carouselAbout" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              @foreach ($about->imagesOrderBy() as $key => $image)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                  <a href="{{ $image->getImage() }}">
                    <img class="d-block w-100" src="{{ $image->getImage() }}" alt="image-{{ $key + 1 }}">
                  </a>
                </div>
              @endforeach
            </div>
            <ol class="carousel-indicators img_indicator">
              @foreach ($about->imagesOrderBy() as $key => $image)
                <li data-target="#carouselAbout" data-slide-to="{{ $key }}"
                    class="{{ $key == 0 ? 'active' : '' }}">
                  <img src="{{ $image->getImage() }}" alt="image-{{ $key + 1 }}">
                </li>
              @endforeach
            </ol>
          </div>
        </div>
        <div class="col-lg-5">{!! $about->desc !!}</div>
      </div>
    </div>
  </div>
@endif

<div class="container margin_60_35">
  <div class="row">
    <aside class="col-lg-3" id="sidebar">
      <div id="filters_col">
        <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">{{ __('Filters') }} </a>
        <div class="collapse show" id="collapseFilters">
          <div class="filter_type">
            <h6>{{ __('Category') }}</h6>
            <ul>
              @foreach ($categories as $category)
              <li>
                <label class="container_check">{{ $category->name }}
                  <input class="category_checkbox" type="checkbox" value="{{ $category->id }}"
                          @php
                            $cats = json_decode(request()->get('cats'));
                            if($cats && in_array($category->id, $cats)){
                                echo 'checked';
                            }
                            @endphp
                  >
                  <span class="checkmark"></span>
                </label>
              </li>
              @endforeach
            </ul>
          </div>
            <div class="filter_type">
              <h6>{{ __('Price') }}</h6>
              <input type="text" id="range" name="range" value="">
            </div>
        </div>
      </div>
    </aside>

    <div class="col-lg-9">
      <div class="isotope-wrapper">
        <div class="row" id="data_row">
          @include('web.include.tour_partial')
        </div>
      </div>

      {{-- <p class="text-center"><a href="#" class="btn_1 rounded add_top_30">Load more</a></p> --}}
    </div>
  </div>
</div>
@endsection

@section('js')
  <!-- Range Slider -->
  <script>
    $(document).ready(function() {
      $("#range").ionRangeSlider({
        hide_min_max: true,
        keyboard: true,
        @if(request()->get('min') || request()->get('max'))
        from: {{request()->get('min')}},
        to: {{request()->get('max')}},
        @endif
        min: 0,
        max: {{ $max_price ?? 0 }},
        type: 'double',
        step: 5,
        postfix: "$",
        grid: false,
        onChange: function (data) {
          let min_price= data.from;
          let max_price= data.to;

          let href = new URL(location.href);
          href.searchParams.set('min',min_price);
          href.searchParams.set('max',max_price);
          window.history.pushState({ path: href.toString() }, '', href.toString());
          updateContent();
        },
      });

      let categories = [];
      $('.category_checkbox').each(function (i,obj) {
        if($(this).is(":checked")) {
          categories.push(parseInt($(this).val()));
        }
      });

      $('.category_checkbox').change(function () {
        let val =  parseInt($(this).val())
        if($(this).is(":checked")) {
          categories.push(val);
        }else{
          categories = categories.filter(function(item) {return item !== val})
        }
        let href = new URL(location.href);

        if(categories.length === 0) {
          href.searchParams.delete('cats');
        }else{
          href.searchParams.set('cats', JSON.stringify(categories) );
        }
        window.history.pushState({ path: href.toString() }, '', href.toString());
        updateContent();
      })

      var timers = Array.from(document.getElementsByClassName("timer"));

      timers.forEach(function (timer) {
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
      })

      function updateContent() {
        let href = new URL(location.href);
        let min_price = href.searchParams.get('min') ?? null
        let max_price = href.searchParams.get('max') ?? null
        let cats = href.searchParams.get('cats') ?? null
        console.log(min_price);
        console.log(max_price);
        $.ajax({
          type:'GET',
          url: '{{ route('tours.index') }}',
          data: {
            _token:'{{ csrf_token() }}',
            min:min_price,
            max:max_price,
            cats:cats
          },
          success: function (dataResult) {
            $('#data_row').html(dataResult);
          }
        })
      }

    });
  </script>
@endsection