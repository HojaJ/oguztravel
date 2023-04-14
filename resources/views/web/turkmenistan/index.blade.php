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
                <label>
                  <input type="checkbox" class="icheck">{{ $category->name }}
                </label>
              </li>
              @endforeach
            </ul>
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
                <a href="{{ route('turkmenistan.show', $tour->id) }}"><img src="{{ $tour->firstImage() }}" class="img-fluid" alt="tour-{{ $tour->id }}" width="800" height="533">
                  <div class="read_more"><span>{{ __('Read more') }}</span></div>
                </a>
                <small>{{ $tour->category->name }}</small>
              </figure>
              <div class="wrapper">
                <h3><a href="#">{{ $tour->title }}</a></h3>
                <p class="mb-0">{{ $tour->summary90() }}</p>
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
    });
  </script>
@endsection