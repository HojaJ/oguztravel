@extends('layouts.panel')

@section('title')
{{ __('Edit thing', ['thing' => __('Services')]) }}
@endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Edit thing', ['thing' => __('Services')]), 'title' => $service->title]])

<form action="{{ route('panel.services.update', $service->id) }}" class="form-contact needs-validation mt-4" method="POST" enctype="multipart/form-data" novalidate>
  @csrf
  @method('PATCH')
  <div class="form-group">
    <label for="file" class="form-label">{{ __('Choose image') }} @if(!$service->filename)<span class="text-danger">*</span>@endif</label>
    <div class="form-control-wrap">
      <input type="file" id="file" name="file" class="form-control form-control-lg @error('file') is-invalid @enderror" placeholder="{{ __('Choose image') }}" @if(!$service->filename) required @endif>
      @if ($errors->has('file'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('file') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>
  
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <h5 class="float-title">{{ __('Title') }} <span class="text-danger">*</span></h5>
      <div class="row g-4">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <div class="col-md-6">
          <div class="form-group">
            <label for="title-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
            <div class="form-control-wrap">
              <input type="text" id="title-{{ $localeCode }}" name="title[{{ $localeCode }}]" value="{{ old('title.' . $localeCode, $service->getTranslation('title', $localeCode)) }}" class="form-control form-control-lg @error('title.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>
              @if ($errors->has('title.' . $localeCode))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('title.' . $localeCode) }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <h5 class="float-title">{{ __('Subtitle') }}</h5>
      <div class="row g-4">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <div class="col-md-6">
          <div class="form-group">
            <label for="subtitle-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
            <div class="form-control-wrap">
              <input type="text" id="subtitle-{{ $localeCode }}" name="subtitle[{{ $localeCode }}]" value="{{ old('subtitle.' . $localeCode, $service->getTranslation('subtitle', $localeCode)) }}" class="form-control form-control-lg @error('subtitle.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}">
              @if ($errors->has('subtitle.' . $localeCode))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('subtitle.' . $localeCode) }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <div class="sp-plan-opt mb-3">
    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" name="is_active" id="is_active" value="1" {{ $service->is_active ? "checked" : "" }}>
      <label class="custom-control-label text-soft" for="is_active">{{ __('Is it active?') }}</label>
    </div>
  </div>

  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection
