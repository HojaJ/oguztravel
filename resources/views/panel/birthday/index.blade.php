@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Clients')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Birthday') }}</h2>
    </div>

{{--    <div class="nk-block-head-content">--}}
{{--      <ul class="nk-block-tools gx-3">--}}
{{--        <li>--}}
{{--          <a data-toggle="modal" data-target="#add" class="btn btn-white btn-dim btn-outline-primary">--}}
{{--            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Send sms to number') }}</span>--}}
{{--          </a>--}}
{{--        </li>--}}
{{--      </ul>--}}
{{--    </div>--}}

  </div>
</div>

<div class="nk-block">
  <form action="{{ route('panel.clients.index') }}" method="GET">
    <div class="input-group mb-3">
      <input type="text" class="form-control" name="q" value="{{ $q ?? $q }}"
             placeholder="{{ __('Client') }}" aria-label="{{ __('Client') }}" aria-describedby="form-query">
      <button type="submit" id="form-query" class="btn btn-primary">{{ __('Search') }}</button>
    </div>
  </form>
  @if (count($clients))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('Name') }}</th>
          <th>{{ __('Surname') }}</th>
          <th>{{ __('Patronymic') }}</th>
          <th>{{ __('Email') }}</th>
          <th>{{ __('Phone') }}</th>
          <th>{{ __('Gender') }}</th>
          <th>{{ __('Date of birth') }}</th>
{{--          <th>{{ __("Action") }}</th>--}}
        </tr>
      </thead>
      <tbody>
        @foreach($clients as $client)
          <tr class="tb-tnx-item">
            <td>{{ $client->name }}</td>
            <td>{{ $client->surname }}</td>
            <td>{{ $client->patronymic }}</td>
            <td>{{ $client->email }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->gender }}</td>
            <td>{{ $client->date_of_birth }}</td>

          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @include('panel.include.paginate', ['data' => ['items' => $clients, 'limit' => $page_limit]])

  @else
  <p>{{ __('not exist', ['thing' => __('Birthday')]) }}</p>
  @endif
</div>
<div class="modal fade show" tabindex="-1" role="dialog" id="add">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
      <div class="modal-body modal-body-lg">
        <h5 class="title">{{ __('Send sms') }}</h5>
        <form action="{{ route('panel.sms.store') }}" method="POST">
          @csrf

          <div class="form-group">
            <label class="form-label" for="phone">{{ __('Phone') }}</label>
            <input type="text" class="form-control form-control-lg @error('phone') is-invalid @enderror" id="username" name="phone" placeholder="+99365102030"  required>
            @error ('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="message">{{ __('Message') }}</label>
            <textarea class="form-control form-control-lg @error('message') is-invalid @enderror" id="message" name="message" required></textarea>
            @error ('message')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>
          <div class="col-12 mt-5">
            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
              <li>
                <button class="btn btn-lg btn-primary">{{ __('Send') }}</button>
              </li>
              <li>
                <a href="#" data-dismiss="modal" class="link link-light">{{ __('Cancel') }}</a>
              </li>
            </ul>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection