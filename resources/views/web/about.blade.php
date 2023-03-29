@extends('layouts.app')

@section('title')
  {{ __('About us') }}
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
@endsection

@section('main')
  @if ($cover && $cover->filename)
    <style>
      .hero_in.general::before {
        background-image: url('{{ $cover->getImage() }}');
      }
    </style>
  @endif

  <section class="hero_in general">
    <div class="wrapper">
      <div class="container">
        <h1 class="fadeInUp"><span></span>{{ __('About us') }}</h1>
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
@endsection

@section('js')
  <script src="{{ asset('js/magnific-popup.min.js') }}"></script>

  <script>
    $(document).ready(function() {
      $('.carousel-item').each(function() {
        $(this).magnificPopup({
          delegate: 'a',
          type: 'image',
          gallery: {
            enabled: true
          }
        });
      });
    });
  </script>
@endsection
