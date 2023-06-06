@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Clients')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Clients') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <form action="{{ route('panel.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
              <input type="file" name="file" class="form-control">
              <div class="input-group-append">
                <button class="btn btn-outline-primary btn-dim">Import</button>
              </div>
            </div>
          </form>
        </li>
        <li>
          <a href="{{ route('panel.export-clients') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-download"></em><span class="d-none d-sm-inline-block">{{ __('Download') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="nk-block">
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
          <th>{{ __('Date') }}</th>
{{--          <th>{{ __('Action') }}</th>--}}
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
            <td>{{ $client->created_at->format('Y-m-d') }}</td>
            {{--          <td class="tb-col-action">--}}
            {{--            <a href="{{ route('panel.messages.show', $message->id) }}" class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-eye"></em></a>--}}
            {{--            <a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $message->id }}').submit(); }" class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>--}}
            {{--            <form action="{{ route('panel.messages.destroy', $message->id) }}" method="post" id="destroy-{{ $message->id }}">--}}
            {{--              @method('delete')--}}
            {{--              @csrf--}}
            {{--            </form>--}}
            {{--          </td>--}}
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