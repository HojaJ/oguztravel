@extends('layouts.panel')

@section('title') {{ __('Create new thing', ['thing' => __('Subject')]) }} @endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Create new'), 'title' => __('Subject')]])

<form action="{{ route('panel.subjects.store') }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
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
          <div class="col-md-6">
            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <div class="form-control-wrap">
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email" required>
                @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                @else
                  <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                @endif
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>

  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection