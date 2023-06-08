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
                <label>
                  <input type="checkbox" class="icheck">{{ $category->name }}
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
        <div class="row">
          @foreach ($tours as $tour)
          <div class="col-md-6 isotope-item popular">
            <div class="box_grid">
              <figure>
                <a href="{{ route('tours.show', $tour->id) }}"><img src="{{ $tour->firstImage() }}" class="img-fluid" alt="tour-{{ $tour->id }}" width="800" height="533">
                  <div class="read_more"><span>{{ __('Read more') }}</span></div>
                </a>
                <small>{{ $tour->category->name }}</small>
              </figure>
              <div class="wrapper">
                <h3><a href="#">{{ $tour->title }}</a></h3>
                <p>{{ $tour->summary90() }}</p>
                @if(isset($tour->price))
                  <span class="price"><strong>${{ $tour->price }}</strong> /per person</span>
                @endif
              </div>
            </div>
          </div>  
          @endforeach
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
    $("#range").ionRangeSlider({
      hide_min_max: true,
      keyboard: true,
      min: 0,
      max: 250,
      from: 0,
      to: 250,
      type: 'double',
      step: 10,
      prefix: "$",
      grid: false
    });
  </script>
@endsection