@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Clients')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Birthday') }}</h2>
    </div>

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
            <td>{{ $client->email }}
              &nbsp;&nbsp;
              <form action="{{ route('panel.birthday.send', $client->id) }}" method="post" class="d-inline-block">
                @method('put')
                <button class="btn btn-warning">{{ __("Send") }}</button>
                @csrf
              </form>
            </td>
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

@endsection