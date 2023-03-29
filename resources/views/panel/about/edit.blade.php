@extends('layouts.panel')

@section('title') {{ __('Edit thing', ['thing' => __('About us')]) }} @endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Edit thing', ['thing' => __('About us')]), 'title' => __('About us')]])

<form action="{{ route('panel.about.update', $about->id) }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
  @csrf
  @method('patch')
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <h5 class="float-title">{{ __('Title') }} <span class="text-danger">*</span></h5>
      <div class="row g-4">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <div class="col-md-6">
          <div class="form-group">
            <label for="title-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
            <div class="form-control-wrap">
              <input type="text" id="title-{{ $localeCode }}" name="title[{{ $localeCode }}]" value="{{ old('title.' . $localeCode, $about->getTranslation('title', $localeCode)) }}" class="form-control form-control-lg @error('title.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>
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
      <h5 class="float-title">{{ __('Subtitle') }} <span class="text-danger">*</span></h5>
      <div class="row g-4">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <div class="col-md-6">
          <div class="form-group">
            <label for="subtitle-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
            <div class="form-control-wrap">
              <input type="text" id="subtitle-{{ $localeCode }}" name="subtitle[{{ $localeCode }}]" value="{{ old('subtitle.' . $localeCode, $about->getTranslation('subtitle', $localeCode)) }}" class="form-control form-control-lg @error('subtitle.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>
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

  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <h5 class="float-title">{{ __('Desc') }} <span class="text-danger">*</span></h5>
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="form-group">
        <label for="desc-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
        <div class="form-control-wrap">
          <textarea id="desc-{{ $localeCode }}" name="desc[{{ $localeCode }}]" class="form-control editor @error('desc.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>{{ old('desc.' . $localeCode, $about->getTranslation('desc', $localeCode)) }}</textarea>
          @if ($errors->has('desc.' . $localeCode))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('desc.' . $localeCode) }}</strong></span>
          @else
          <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>
  
  <div class="form-group">
    <label for="file" class="form-label">{{ __('Choose image') }}</label>
    <div class="form-control-wrap">
      <input type="file" id="file" name="file" class="form-control form-control-lg @error('file') is-invalid @enderror" placeholder="{{ __('Choose image') }}">
      @if ($errors->has('file'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('file') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>

  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection

@section('js')
<script src="{{ asset('js/ckeditor5/ckeditor.js') }}"></script>
<script src="{{ asset('js/ckeditor5/translations/ru.js') }}"></script>
<script>
  $(function () {
    let allEditors = document.querySelectorAll('.editor');
    for (let i = 0; i < allEditors.length; ++i) {
        ClassicEditor.create(allEditors[i], {
            language: 'ru'
        });
    }
  });
</script>
@endsection
