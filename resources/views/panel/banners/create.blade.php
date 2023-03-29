@extends('layouts.panel')

@section('title') {{ __('Create new thing', ['thing' => __('Banner')]) }} @endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Create new'), 'title' => __('Banner')]])

<form action="{{ route('panel.banners.store') }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
  @csrf
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <h5 class="float-title">{{ __('Title') }} <span class="text-danger">*</span></h5>
      <div class="row g-4">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <div class="col-md-6">
          <div class="form-group">
            <label for="title-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
            <div class="form-control-wrap">
              <input type="text" id="title-{{ $localeCode }}" name="title[{{ $localeCode }}]" value="{{ old('title.' . $localeCode) }}" class="form-control form-control-lg @error('title.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>
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
              <input type="text" id="subtitle-{{ $localeCode }}" name="subtitle[{{ $localeCode }}]" value="{{ old('subtitle.' . $localeCode) }}" class="form-control form-control-lg @error('subtitle.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}">
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

  <div class="form-group">
    <label for="file" class="form-label">{{ __('Choose image') }} <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
      <input type="file" id="file" name="file" class="form-control form-control-lg @error('file') is-invalid @enderror" placeholder="{{ __('Choose image') }}" required>
      @if ($errors->has('file'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('file') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>

  <div class="form-group">
    <label for="link" class="form-label">{{ __('Redirect link') }} <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
      <input type="text" id="link" name="link" class="form-control form-control-lg @error('link') is-invalid @enderror" value="{{ old('link') }}"  placeholder="{{ __('URL') }}" required>
      @if ($errors->has('link'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('link') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>

  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection