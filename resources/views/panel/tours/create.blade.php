@extends('layouts.panel')

@section('title') {{ __('Create new thing', ['thing' => __(ucfirst($type))]) }} @endsection

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
@include('panel.include.block-header.min', ['data' => ['sub' => __('Create new'), 'title' => __(ucfirst($type))]])

<form action="{{ route('panel.tours.store', ['type' => $type]) }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
  @csrf
  <div class="form-group">
    <label class="form-label" for="category">{{ __('Category') }} <span class="text-danger">*</span></label>
    <div class="form-control-wrap">
      <select class="form-select @error('category_id') is-invalid @enderror" id="category" name="category_id" data-search="on" data-ui="lg" required>
        <option selected disabled hidden>{{ __('Select category') }}</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
      </select>
      @if ($errors->has('category'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('category_id') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>

  <div class="card card-bordered my-3">
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
      <h5 class="float-title">{{ __('Description') }} <span class="text-danger">*</span></h5>
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="form-group">
        <label for="description-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
        <div class="form-control-wrap">
          <textarea id="description-{{ $localeCode }}" name="description[{{ $localeCode }}]" class="form-control editor @error('description.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>{{ old('description.' . $localeCode) }}</textarea>
          @if ($errors->has('description.' . $localeCode))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('description.' . $localeCode) }}</strong></span>
          @else
          <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <h5 class="float-title">{{ __('Include / Exclude') }} <span class="text-danger">*</span></h5>
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="form-group">
        <label for="include-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
        <div class="form-control-wrap">
          <textarea id="include-{{ $localeCode }}" name="include[{{ $localeCode }}]" class="form-control editor @error('include.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}">{{ old('include.' . $localeCode) }}</textarea>
          @if ($errors->has('include.' . $localeCode))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('include.' . $localeCode) }}</strong></span>
          @else
          <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <h5 class="float-title">{{ __('Details') }} <span class="text-danger">*</span></h5>
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="form-group">
        <label for="details-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
        <div class="form-control-wrap">
          <textarea id="details-{{ $localeCode }}" name="details[{{ $localeCode }}]" class="form-control editor @error('details.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}">{{ old('details.' . $localeCode) }}</textarea>
          @if ($errors->has('details.' . $localeCode))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('details.' . $localeCode) }}</strong></span>
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
  $(function() {
    const allEditors = document.querySelectorAll('.editor');
    
    for (let i = 0; i < allEditors.length; ++i) { ClassicEditor.create(allEditors[i], { language: 'ru' }); }

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