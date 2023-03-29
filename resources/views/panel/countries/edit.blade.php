@extends('layouts.panel')

@section('title')
{{ __('Edit thing', ['thing' => __('Country')]) }}
@endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Edit thing', ['thing' => __('Country')]), 'title' => $country->name]])

<form action="{{ route('panel.countries.update', $country->id) }}" class="form-contact needs-validation mt-4" method="POST" enctype="multipart/form-data" novalidate>
  @csrf
  @method('PATCH')
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <h5 class="float-title">{{ __('Name') }} <span class="text-danger">*</span></h5>
      <div class="row g-4">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <div class="col-md-6">
          <div class="form-group">
            <label for="name-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
            <div class="form-control-wrap">
              <input type="text" id="name-{{ $localeCode }}" name="name[{{ $localeCode }}]" value="{{ old('name.' . $localeCode, $country->getTranslation('name', $localeCode)) }}" class="form-control form-control-lg @error('name.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>
              @if ($errors->has('name.' . $localeCode))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name.' . $localeCode) }}</strong></span>
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

  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection
