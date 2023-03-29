@extends('layouts.app')

@section('title') {{ __('Services') }} @endsection

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
      <h1 class="fadeInUp"><span></span>{{ __('Services') }}</h1>
    </div>
  </div>
</section>

@if(count($share['services']))
<div class="container margin_60_35">
  <div class="main_title_2">
    <span><em></em></span>
    <h2>{{ __('Our services') }}</h2>
    @if ($cover && $cover->filename)
    <p>{{ $cover->subtitle }}</p>
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
@endsection