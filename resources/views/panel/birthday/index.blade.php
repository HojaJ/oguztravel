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

{{--            <td class="tb-col-action">--}}
{{--              <a href="{{ route('panel.clients.edit', $client->id) }}"--}}
{{--                 class="link-cross d-inline-bl  ock link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>--}}
{{--              <a href="#"--}}
{{--                 onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $client->id }}').submit(); }"--}}
{{--                 class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>--}}
{{--              <form action="{{ route('panel.clients.destroy', $client->id) }}" method="post"--}}
{{--                    id="destroy-{{ $client->id }}">--}}
{{--                @method('delete')--}}
{{--                @csrf--}}
{{--              </form>--}}
{{--            </td>--}}

          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @include('panel.include.paginate', ['data' => ['items' => $clients, 'limit' => $page_limit]])

  @else
  <p>{{ __('not exist', ['thing' => __('Clients')]) }}</p>
  @endif
</div>

@endsection