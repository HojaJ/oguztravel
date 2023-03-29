@extends('layouts.panel')

@section('title') {{ __('My profile') }} @endsection

@section('content')
<div class="nk-block-head">
  <div class="nk-block-head-content">
    <div class="nk-block-head-sub"><span>{{ __('View profile') }}</span></div>
    <h2 class="nk-block-title fw-normal">{{ __('My profile') }}</h2>
    <div class="nk-block-des">
      <p>{{ __('Manage your profile') }}</p>
    </div>
  </div>
</div>
<div class="nk-block">
  <div class="card card-bordered">
    <div class="nk-data data-list">
      <div class="data-item" data-toggle="modal" data-target="#profile-edit">
        <div class="data-col">
          <span class="data-label">{{ __('Full name') }}</span>
          <span class="data-value">{{ $user->name }}</span>
        </div>
        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
      </div>
      <div class="data-item" data-toggle="modal" data-target="#profile-edit">
        <div class="data-col">
          <span class="data-label">{{ __('Username') }}</span>
          <span class="data-value">{{ $user->username }}</span>
        </div>
        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
      </div>
      <div class="data-item" data-toggle="modal" data-target="#profile-edit">
        <div class="data-col">
          <span class="data-label">{{ __('Password') }}</span>
          <span class="data-value text-soft">*****</span>
        </div>
        <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade show" tabindex="-1" role="dialog" id="profile-edit">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
      <div class="modal-body modal-body-lg">
        <h5 class="title">{{ __('Update profile') }}</h5>
        <form action="{{ route('panel.profile.update') }}" method="POST">
          @csrf
          @method('patch')
          <div class="row gy-4">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="full-name">{{ __('Full name') }}</label>
                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="full-name" name="name" value="{{ $user->name }}" placeholder="{{ __('enter_full_name') }}" required>
                @error ('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="username">{{ __('Username') }}</label>
                <input type="text" class="form-control form-control-lg @error('username') is-invalid @enderror" id="username" name="username" value="{{ $user->username }}" placeholder="{{ __('Enter your username') }}" required>
                @error ('username')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="password">{{ __('Password') }}</label>
                <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" id="password" name="password" placeholder="{{ __('New password') }}">
                @error ('password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label" for="password_confirmation">{{ __('Password confirmation') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Repeat password confirmation') }}">
                @error ('password_confirmation')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                <li>
                  <button class="btn btn-lg btn-primary">{{ __('Update profile') }}</button>
                </li>
                <li>
                  <a href="#" data-dismiss="modal" class="link link-light">{{ __('Cancel') }}</a>
                </li>
              </ul>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  $(function () {
    @if ($errors->any())
      $('#profile-edit').modal('show')
    @endif
  })
</script>
@endsection