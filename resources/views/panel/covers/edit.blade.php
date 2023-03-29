@extends('layouts.panel')

@section('title')
{{ __('Edit thing', ['thing' => __('Cover')]) }}
@endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Edit thing', ['thing' => __('Cover')]), 'title' => __(ucfirst($cover->slug))]])

<form action="{{ route('panel.covers.update', $cover->id) }}" class="form-contact needs-validation mt-4" method="POST" enctype="multipart/form-data" novalidate>
  @csrf
  @method('PATCH')
  <div class="form-group">
    <label for="file" class="form-label">{{ __('Choose image') }} @if(!$cover->filename)<span class="text-danger">*</span>@endif</label>
    <div class="form-control-wrap">
      <input type="file" id="file" name="file" class="form-control form-control-lg @error('file') is-invalid @enderror" placeholder="{{ __('Choose image') }}" @if(!$cover->filename) required @endif>
      @if ($errors->has('file'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('file') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>

  @if ($cover->slug != 'about')
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <h5 class="float-title">{{ __('Subtitle') }}</h5>
      <div class="row g-4">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <div class="col-md-6">
          <div class="form-group">
            <label for="subtitle-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
            <div class="form-control-wrap">
              <input type="text" id="subtitle-{{ $localeCode }}" name="subtitle[{{ $localeCode }}]" value="{{ old('subtitle.' . $localeCode, $cover->getTranslation('subtitle', $localeCode)) }}" class="form-control form-control-lg @error('subtitle.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}">
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
  @endif

  <div class="sp-plan-opt mb-3">
    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" name="is_active" id="is_active" value="1" {{ $cover->is_active ? "checked" : "" }}>
      <label class="custom-control-label text-soft" for="is_active">{{ __('Is it active?') }}</label>
    </div>
  </div>

  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection