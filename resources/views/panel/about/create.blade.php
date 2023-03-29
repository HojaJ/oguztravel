@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('About us')]) }} @endsection

@section('css')
<style>
  .tag-remove {
    padding: 0;
    line-height: 1.1;
    border: none;
    margin-top: 10px;
  }
</style>
@endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Create new'), 'title' => __('About us')]])
<form action="{{ route('panel.about.store') }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
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
      <h5 class="float-title">{{ __('Subtitle') }} <span class="text-danger">*</span></h5>
      <div class="row g-4">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <div class="col-md-6">
          <div class="form-group">
            <label for="subtitle-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
            <div class="form-control-wrap">
              <input type="text" id="subtitle-{{ $localeCode }}" name="subtitle[{{ $localeCode }}]" value="{{ old('subtitle.' . $localeCode) }}" class="form-control form-control-lg @error('subtitle.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>
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
      <h5 class="float-title">{{ __('Description') }} <span class="text-danger">*</span></h5>
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="form-group">
        <label for="desc-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
        <div class="form-control-wrap">
          <textarea id="desc-{{ $localeCode }}" name="desc[{{ $localeCode }}]" class="form-control editor @error('desc.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>{{ old('desc.' . $localeCode) }}</textarea>
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

  <div class="text-right mt-4 mb-3">
    <button type="button" id="add-more" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-plus-c"></em><span class="d-none d-sm-inline-block">{{ __('Add more image') }}</span></button>
  </div>

  <div class="row append">
    <div class="col-md-6 copy">
      <div class="form-group">
        <label for="images" class="form-label">
          {{ __('Image') }} <span class="text-danger">*</span>
          <span class="fs-9px btn btn-white btn-dim btn-outline-danger tag-remove"><em class="icon ni ni-cross-c"></em></span>
        </label>
        <div class="input-group mb-3">
          <input type="file" name="images[]" id="image" class="form-control " required="">
          @if ($errors->has('images'))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('images') }}</strong></span>
          @else
          <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
          @endif
        </div>
      </div>
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
    const allEditors = document.querySelectorAll('.editor');

    for (let i = 0; i < allEditors.length; ++i) {
      ClassicEditor.create(allEditors[i], {
          language: 'ru'
      });
    }

    $(".tag-remove").click(function() {
      $(this).parents('.copy').remove();
    });

    let cloneDiv = $('.copy').clone(true);

    $('#add-more').click(function () {
      $('.append').append(cloneDiv.clone(true));
    });

    $(".tag-remove").remove();
  });
</script>
@endsection