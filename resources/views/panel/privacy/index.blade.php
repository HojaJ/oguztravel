@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __($about->page)]) }} @endsection

@section('css')
<style>
  .occ {
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
    -o-object-position: center;
    object-position: center;
  }

  .galleries .iw-half {
    position: relative;
    height: 300px;
  }

  .galleries .iw-half {
    margin-bottom: 30px;
    overflow: hidden;
  }

  .buttons {
    position: absolute;
    top: 7px;
    right: 22px;
  }
</style>
@endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __($about->page) }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        @if ($about)
        <li>
          <a href="{{ route('panel.privacy.edit', $about->id) }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">{{ __('Edit') }}</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</div>

<div class="nk-block">
  @if ($about)
  <h5>{{ __('Title') }}</h5>
  <div class="card card-bordered mb-4">
    <div class="px-3 pb-4">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="mt-2">
        <strong>{{ $properties['native'] }}:</strong> {{ $about->getTranslation('title', $localeCode) }}
      </div>
      @endforeach
    </div>
  </div>
  <h5>{{ __('Subtitle') }}</h5>
  <div class="card card-bordered mb-4">
    <div class="px-3 pb-4">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="mt-2">
        <strong>{{ $properties['native'] }}:</strong> {{ $about->getTranslation('subtitle', $localeCode) }}
      </div>
      @endforeach
    </div>
  </div>
  <h5>{{ __('Description') }}</h5>
  <div class="card card-bordered mb-4">
    <div class="px-3 pb-4">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="mt-4"><strong>{{ $properties['native'] }}</strong></div>
      {!! $about->getTranslation('desc', $localeCode) !!}
      @endforeach
    </div>
  </div>

  @else
    <p>{{ __('not exist', ['thing' => __($about->page)]) }}</p>
  @endif
</div>
@endsection