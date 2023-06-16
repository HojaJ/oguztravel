@extends('layouts.app')

@section('title') {{ __('Turkmenistan') }} @endsection

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
      <h1 class="fadeInUp"><span></span>{{ __('Turkmenistan') }}</h1>
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
  <div class="col-6 mb-4 mx-auto d-flex align-center justify-content-between">
    <div class="form-check">
      <input class="form-check-input @error('applicant_type') is-invalid @enderror" type="radio" name="applicant_type" id="outbound_applicant" value="outbound"
              {{  request()->bound  == 'outbound' ? 'checked' : '' }}>
      <label class="form-check-label" for="outbound_applicant">{{ __('Outbound') }}</label>
    </div>
    <div class="form-check">
      <input class="form-check-input @error('applicant_type') is-invalid @enderror" type="radio" name="applicant_type" id="inbound_applicant" value="inbound"
              {{  request()->bound  == 'inbound' ? 'checked' : ''  }}>
      <label class="form-check-label" for="inbound_applicant">{{ __('Inbound') }}</label>
    </div>
  </div>
</div>
</div>
@if($tours)
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
          @include('web.include.tkm_partial')
        </div>
      </div>

      {{-- <p class="text-center"><a href="#" class="btn_1 rounded add_top_30">Load more</a></p> --}}
    </div>
  </div>
</div>
@endif
@endsection
@section('js')
  <script>
    $(document).ready(function() {
      $('input[name=applicant_type]').change(function() {
        const page =  location.origin + window.location.pathname
        if ($(this).val() === 'outbound') {
          location.href = page + "?bound=outbound";
        }
        if ($(this).val() === 'inbound') {
          location.href = page + "?bound=inbound";
        }
      });


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

          $.ajax({
            type:'GET',
            url: '{{ route('turkmenistan.index') }}',
            data: {
              _token:'{{ csrf_token() }}',
              min:min_price,
              max:max_price
            },
            success: function (dataResult) {
              $('#data_row').html(dataResult);
              window.history.pushState({ path: href.toString() }, '', href.toString());
            }
          })
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
        console.log(JSON.parse(href.searchParams.get('cats')))

        window.history.pushState({ path: href.toString() }, '', href.toString());
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
    });
  </script>
@endsection