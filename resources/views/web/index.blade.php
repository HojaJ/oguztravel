@extends('layouts.app')

@section('title') {{ __('Home page') }} @endsection

@section('css')
<link href="{{ asset('layerslider/css/layerslider.css') }}" rel="stylesheet">
@endsection

@section('main')
@if(count($banners))
<div id="full-slider-wrapper">
  <div id="layerslider" style="width:100%;height:750px;">
    @foreach ($banners as $banner)
    <div class="ls-slide" data-ls="slidedelay: 5000; transition2d:85;">
      <img src="{{ $banner->getImage() }}" class="ls-bg" alt="{{ $banner->title }}">
      <h3 class="ls-l slide_typo" style="top: 47%; left: 50%;" data-ls="offsetxin:0;durationin:2000;delayin:1000;easingin:easeOutElastic;rotatexin:90;transformoriginin:50% bottom 0;offsetxout:0;rotatexout:90;transformoriginout:50% bottom 0;">{{ $banner->title }}</h3>
      <p class="ls-l slide_typo_2" style="top:55%; left:50%;" data-ls="durationin:2000;delayin:1000;easingin:easeOutElastic;">{{ $banner->subtitle }}</p>
      <p class="ls-l" style="top:70%; left:50%;" data-ls="durationin:2000;delayin:1400;easingin:easeOutElastic;"><a class="btn_1 rounded" data-ls="durationin:2000;delayin:1400;easingin:easeOutElastic;" href='{{ $banner->link }}'>{{ __("Read more") }}</a></p>
    </div>
    @endforeach
  </div>
</div>
@endif

@if(count($share['services']))
<div class="container margin_60_35">
  <div class="main_title_2">
    <span><em></em></span>
    <h2>{{ __('Our services') }}</h2>
    @if ($cover_service && $cover_service->filename)
    <h3><p>{{ $cover_service->subtitle }}</p></h3>
    @endif
  </div>

  <div class="row">
    @foreach ($share['services'] as $service)
    <div class="col-md-6">
      <a class="box_topic box_flex" href="{{ route('services.show', $service->slug) }}">
        <div class="icon_wrapper">
          @if($service->slug == "visa")
          <i class="pe-7s-id"></i>
          @endif
          @if($service->slug == "ticket")
          <i class="pe-7s-note2"></i>
          @endif
          @if($service->slug == "hotel")
          <i class="pe-7s-culture"></i>
          @endif
          @if($service->slug == "translation")
          <i class="pe-7s-global"></i>
          @endif
        </div>
        <div class="title_wrapper">
          <h3>{{ $service->title }}</h3>
          <p>{{ $service->subtitle }}</p>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</div>
@endif

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
            <li data-target="#carouselAbout" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
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

<div class="container container-custom margin_30_95">
  @if ($tmCount)
  <section class="add_bottom_45">
    <div class="main_title_3">
      <span><em></em></span>
      <h2>{{ __("Turkmenistan") }}</h2>
      @if ($cover_turkmenistan)
      <p>{{ $cover_turkmenistan->subtitle }}</p>
      @endif
    </div>
    <div class="row">
      @foreach ($turkmenistan as $item)
      <div class="col-xl-3 col-lg-6 col-md-6">
        <a href="{{ route('turkmenistan.show', $item->id) }}" class="grid_item">
          <figure>
            <img src="{{ $item->firstImage() }}" class="img-fluid" alt="tourkmenistan-{{ $item->id }}">
            <div class="info">
              <h3>{{ $item->title }}</h3>
            </div>
            <small>{{ $item->category->name }}</small>
          </figure>
        </a>
      </div>
      @endforeach
    </div>
    <a href="{{ route('turkmenistan.index') }}"><strong>View all ({{ $tmCount }}) <i class="arrow_carrot-right"></i></strong></a>
  </section>
  @endif

  @if($toursCount)
  <section class="add_bottom_45">
    <div class="main_title_3">
      <span><em></em></span>
      <h2>{{ __("Tours") }}</h2>
      @if ($cover_tour)
      <p>{{ $cover_tour->subtitle }}</p>
      @endif
    </div>
    <div class="row">
      @foreach ($tours as $tour)
      <div class="col-xl-3 col-lg-6 col-md-6">
        <a href="{{ route('tours.show', $tour->id) }}" class="grid_item">
          <figure>
            <img src="{{ $tour->firstImage() }}" class="img-fluid" alt="tourkmenistan-{{ $tour->id }}">
            <div class="info">
              <h3>{{ $tour->title }}</h3>
            </div>
            <small>{{ $tour->category->name }}</small>
          </figure>
        </a>
      </div>
      @endforeach
    </div>
    <a href="{{ route('tours.index') }}"><strong>{{ __("View all") }} ({{ $toursCount }}) <i class="arrow_carrot-right"></i></strong></a>
  </section>
  @endif
</div>
@endsection

@section('js')
<script src="{{ asset('js/index.js') }}"></script>
{{--<script src="{{ asset('layerslider/js/greensock.js') }}"></script>--}}
{{--<script src="{{ asset('layerslider/js/layerslider.transitions.js') }}"></script>--}}
{{--<script src="{{ asset('layerslider/js/layerslider.kreaturamedia.jquery.js') }}"></script>--}}

<script>
  'use strict';
    $('#layerslider').layerSlider({
      autoStart: true,
      navButtons: false,
      navStartStop: false,
      showCircleTimer: false,
      responsive: true,
      responsiveUnder: 1280,
      layersContainer: 1200,
      skinsPath: 'layerslider/skins/'
    });
</script>
@endsection