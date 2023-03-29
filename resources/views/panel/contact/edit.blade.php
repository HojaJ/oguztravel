@extends('layouts.panel')

@section('title')
{{ __('Edit thing', ['thing' => __('Contact us')]) }}
@endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Edit thing', ['thing' => __('Contact us')]), 'title' => trans('' . $contact->slug)]])

<form action="{{ route('panel.contact.update', $contact->id) }}" class="form-contact needs-validation" method="POST" novalidate>
  @csrf
  @method('patch')
  <div class="form-group">
    <label for="icon" class="form-label">{{ __('SVG') }}</label>
    <div class="form-control-wrap">
      <textarea id="icon" name="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="{{ __('SVG') }}">{{ old('icon', $contact->icon) }}</textarea>
      @if ($errors->has('icon'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('icon') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>

  @if ($contact->slug == 'address' || $contact->slug == 'copyright')
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="form-group">
        <label for="locale_data-{{ $localeCode }}" class="form-label">{{ $properties['native'] }}</label>
        <div class="form-control-wrap">
          <textarea id="locale_data-{{ $localeCode }}" name="locale_data[{{ $localeCode }}]" class="form-control editor @error('locale_data.' . $localeCode) is-invalid @enderror" placeholder="{{ $properties['native'] }}" required>{{ old('locale_data.' . $localeCode, $contact->getTranslation('locale_data', $localeCode)) }}</textarea>
          @if ($errors->has('locale_data.' . $localeCode))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('locale_data.' . $localeCode) }}</strong></span>
          @else
          <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
          @endif
        </div>
      </div>
      @endforeach
    </div>
  </div>

  @else
  <div class="form-group">
    <div class="form-control-wrap">
      <label for="data" class="form-label">{{ __('Contact data') }} <span class="text-danger">*</span></label>
      <input type="text" name="data" id="data" class="form-control @error('data') is-invalid @enderror" value="{{ old('data', $contact->data) }}" placeholder="{{ __(ucwords($contact->slug)) }}" required>
      @if ($errors->has('data'))
      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('data') }}</strong></span>
      @else
      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
      @endif
    </div>
  </div>
  @endif

  <div class="sp-plan-opt mb-3">
    <div class="custom-control custom-switch">
      <input type="checkbox" class="custom-control-input" name="is_active" id="is_active" value="1" {{ $contact->is_active ? "checked" : "" }}>
      <label class="custom-control-label text-soft" for="is_active">{{ __('Is it active?') }}</label>
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
