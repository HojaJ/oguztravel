@extends('layouts.panel')

@section('title') {{ __('Edit thing', ['thing' => __('Birthday Messages')]) }} @endsection
@section('content')

<form action="{{ route('panel.sms_messages.update', $sms_message->id) }}" class="form-contact needs-validation" method="POST" novalidate>
  @csrf
  @method('PUT')
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <div class="row g-4">
        <div class="col-md-12">
{{--          <div class="form-group">--}}
{{--            <label class="form-label" for="name">{{ __('Name') }}</label>--}}
{{--            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="username" value="{{$sms_message->name}}" name="name"  required>--}}
{{--            @error ('name')--}}
{{--            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--            @enderror--}}
{{--          </div>--}}
{{--          <div class="form-group">--}}
{{--            <label class="form-label" for="content">{{ __('Language') }}</label>--}}
{{--            <select  class="form-control form-control-lg @error('lang') is-invalid @enderror" name="lang" id="lang" required>--}}
{{--              <option value="tm" @if($sms_message->lang == 'tm') 'selected' @endif>Tm</option>--}}
{{--              <option value="ru"  @if($sms_message->lang == 'ru') 'selected' @endif>Ru</option>--}}
{{--              <option value="en" @if($sms_message->lang == 'en') 'selected' @endif>En</option>--}}
{{--              <option value="zh" @if($sms_message->lang == 'zh') 'selected' @endif>Zh</option>--}}
{{--            </select>--}}
{{--            @error ('lang')--}}
{{--            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>--}}
{{--            @enderror--}}
{{--          </div>--}}
          <div class="form-group">
            <label class="form-label" for="content">{{ __('Content') }}</label>
            <textarea class="form-control form-control-lg @error('content') is-invalid @enderror" id="zh" name="message" required>{{$sms_message->content}}</textarea>
            @error ('content')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

        </div>
      </div>
    </div>
  </div>

  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection
