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
@endsection