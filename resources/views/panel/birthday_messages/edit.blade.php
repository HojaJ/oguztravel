@extends('layouts.panel')

@section('title') {{ __('Edit thing', ['thing' => __('Birthday Messages')]) }} @endsection
@section('content')

<form action="{{ route('panel.birthday_messages.update', $birthday_message->id) }}" class="form-contact needs-validation" method="POST" novalidate>
  @csrf
  @method('PUT')
  <div class="card card-bordered mb-2">
    <div class="card-inner">
      <div class="row g-4">
        <div class="col-md-12">
          <div class="form-group">
            <label for="message" class="form-label">{{ $birthday_message->lang }}</label>
            <div class="form-control-wrap">
              <textarea class="form-control form-control-lg @error('message') is-invalid @enderror"  name="message" id="message" rows="5" required>
                {{$birthday_message->content}}
              </textarea>
              @if ($errors->has('message'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('message') }}</strong></span>
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
