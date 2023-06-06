@extends('layouts.panel')

@section('title') {{ __('Create new thing', ['thing' => __('Contact')]) }} @endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Create new'), 'title' => __('Contact')]])

<form action="{{ route('panel.contact.store') }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
  @csrf
  <div class="form-group">
    <label for="slug" class="form-label">{{ __('Slug') }} <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
      <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="form-control form-control-lg @error('slug') is-invalid @enderror" placeholder="{{ __('Slug') }}" required>
      @if ($errors->has('slug'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('slug') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>

  <div class="form-group">
    <label for="icon" class="form-label">{{ __('SVG') }} <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
      <textarea id="icon" name="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="{{ __('SVG') }}" required>{{ old('icon') }}</textarea>
      @if ($errors->has('icon'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('icon') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>

  <div class="form-group">
    <label for="data" class="form-label">{{ __('Social network link') }} <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
      <input type="text" id="data" name="data" value="{{ old('data') }}" class="form-control form-control-lg @error('data') is-invalid @enderror" placeholder="{{ __('Web addreess') }}">
      @if ($errors->has('data'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('data') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>

  <div class="sp-plan-opt mb-3">
    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" name="is_active" id="is_active" value="1" checked>
      <label class="custom-control-label text-soft" for="is_active">{{ __('Is it active?') }}</label>
    </div>
  </div>

  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection
