@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __(ucfirst($type) . ' request')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __(ucfirst($type) . ' requests') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3"></ul>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($services))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          @if ($type != 'translation')
          <th>{{ __('Applicant type') }}</th>
          @endif
          <th>{{ __('Name') }}</th>
          <th>{{ __('Surname') }}</th>
          <th>{{ __('Patronymic') }}</th>
          <th>{{ __('Email') }}</th>
          <th>{{ __('Phone') }}</th>
          @if ($type != 'translation')
          <th>{{ __('Date of birth') }}</th>
          @endif
          <th>{{ __('Action') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($services as $service)
        <tr class="tb-tnx-item">
          @if ($service->type != 'translation')
          <td>
            @if ($service->is_read)
            {{ __(ucfirst($service->applicant_type)) }}
            @else
            <strong>{{ __(ucfirst($service->applicant_type)) }}</strong>
            @endif
          </td>
          @endif

          <td>
            @if ($service->is_read)
            {{ $service->name }}
            @else
            <strong>{{ $service->name }}</strong>
            @endif
          </td>
          <td>
            @if ($service->is_read)
            {{ $service->surname }}
            @else
            <strong>{{ $service->surname }}</strong>
            @endif
          </td>
          <td>
            @if ($service->is_read)
            {{ $service->patronymic ?? '—' }}
            @else
            <strong>{{ $service->patronymic ?? '—' }}</strong>
            @endif
          </td>
          <td><a href="mailto:{{ $service->email }}" target="_blank">{{ $service->email }}</a></td>
          <td><a href="tel:{{ $service->phone }}" target="_blank">{{ $service->phone }}</a></td>
          @if ($service->type != 'translation')
          <td>{{ date('d-m-Y', strtotime($service->date_of_birth)) }}</td>
          @endif
          <td class="tb-col-action">
            <a href="{{ route('panel.service_requests.show', ['service' => $service->id, 'type' => $type]) }}" class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-eye"></em></a>
            <a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $service->id }}').submit(); }" class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
            <form action="{{ route('panel.service_requests.destroy', ['service' => $service->id, 'type' => $type]) }}" method="post" id="destroy-{{ $service->id }}">
              @method('delete')
              @csrf
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @include('panel.include.paginate', ['data' => ['items' => $services, 'limit' => $page_limit]])

  @else
  <p>{{ __('not exist', ['thing' => __(ucfirst($type) . ' request')]) }}</p>
  @endif
</div>

@endsection