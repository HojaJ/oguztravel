@extends('layouts.panel')

@section('title') {{ __('Edit thing', ['thing' => __('Client')]) }} @endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">

  <style>
  input:disabled {
    cursor: not-allowed;
  }
</style>
@endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Edit thing', ['thing' => __('Client')]), 'title' => $client->name]])

<form action="{{ route('panel.clients.update', $client->id) }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
  @csrf
  @method('PUT')
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <div class="row g-4">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name" class="form-label">{{ 'Name' }}</label>
            <div class="form-control-wrap">
              <input type="text" id="name" name="name" value="{{ old('name',$client->name) }}" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="{{ 'Name' }}" required>
              @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
              @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="surname" class="form-label">{{ 'Surname' }}</label>
            <div class="form-control-wrap">
              <input type="text" id="surname" name="surname" value="{{ old('surname', $client->surname) }}" class="form-control form-control-lg @error('surname') is-invalid @enderror" placeholder="{{ 'Surname' }}" required>
              @if ($errors->has('surname'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('surname') }}</strong></span>
              @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="form-group">
            <label for="patronymic" class="form-label">{{ 'Patronymic' }}</label>
            <div class="form-control-wrap">
              <input type="text" id="patronymic" name="patronymic" value="{{ old('patronymic',$client->patronymic) }}" class="form-control form-control-lg @error('patronymic') is-invalid @enderror" placeholder="{{ 'Patronymic' }}" required>
              @if ($errors->has('patronymic'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('patronymic') }}</strong></span>
              @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="gender" class="form-label">{{ __('Select Gender') }}</label>
            <div class="form-control-wrap">
              <select class="form-control form-control-lg @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                <option disabled value="" selected hidden>{{ __('Select Gender') }}</option>
                <option value="male" {{ $client->gender == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                <option value="female" {{ $client->gender == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
              </select>
              @if ($errors->has('gender'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('gender') }}</strong></span>
              @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="form-group">
            <label for="email" class="form-label">{{ 'Email' }}</label>
            <div class="form-control-wrap">
              <input type="text" id="email" name="email" value="{{ old('email',$client->email) }}" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ 'Email' }}" required>
              @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
              @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="phone" class="form-label">{{ __('Phone') }}</label>
            <div class="form-control-wrap">
              <input type="text" id="phone" name="phone" value="{{ old('phone',$client->phone) }}" class="form-control form-control-lg @error('phone') is-invalid @enderror" placeholder="{{ __('Phone') }}" required>
              @if ($errors->has('phone'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
              @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="row g-4">
        <div class="col-md-6">
          <div class="form-group">
            <label for="date_of_birth" class="form-label">{{ __('Date of birth') }}</label>
            <div class="form-control-wrap">
              <input class="form-control air-pick @error('date_of_birth') is-invalid @enderror" type="text" id="date_of_birth" name="date_of_birth"
                     value="{{ $client->date_of_birth }}" required>
              <i class="icon_calendar"></i>
              @if ($errors->has('date_of_birth'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('date_of_birth') }}</strong></span>
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

@section('js')
  <script src="{{ asset('js/datepicker.min.js') }}"></script>
  <script src="{{ asset('js/datepicker.en.js') }}"></script>
  <script src="{{ asset('js/datepicker.tm.js') }}"></script>
  <script src="{{ asset('js/datepicker.zh.js') }}"></script>
  <script src="{{ asset('js/input_qty.js') }}"></script>

  <script>
    $(document).ready(function() {
      const currentLang = '{{ LaravelLocalization::getCurrentLocale() }}';
      $('.air-pick').datepicker({
        language: currentLang,
        autoClose: true,
        dateFormat: 'yyyy-mm-dd',
      });
    });
  </script>
@endsection