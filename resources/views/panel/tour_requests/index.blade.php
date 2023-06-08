@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __(ucfirst($kind) . ' request')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __(ucfirst($kind) . ' requests') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        {{-- <li>
          <a href="{{ route('panel.subjects.index') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-browser"></em><span class="d-none d-sm-inline-block">{{ __('Subjects') }}</span>
          </a>
        </li> --}}
      </ul>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($tours))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('Tour') }}</th>
          <th>{{ __('Name') }}</th>
          <th>{{ __('Surname') }}</th>
          <th>{{ __('Patronymic') }}</th>
          <th>{{ __('Email') }}</th>
          <th>{{ __('Phone') }}</th>
          <th>{{ __('Date of birth') }}</th>
          <th>{{ __('Date') }}</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tours as $tour)
        <tr class="tb-tnx-item">
          <td>
            @if ($tour->is_read)
            {{ $tour->tour->title }}
            @else
            <strong>{{ $tour->tour->title }}</strong>
            @endif
          </td>
          <td>
            @if ($tour->is_read)
            {{ __(ucfirst($tour->applicant_type)) }}
            @else
            <strong>{{ __(ucfirst($tour->applicant_type)) }}</strong>
            @endif
          </td>
          <td>
            @if ($tour->is_read)
            {{ $tour->name }}
            @else
            <strong>{{ $tour->name }}</strong>
            @endif
          </td>
          <td>
            @if ($tour->is_read)
            {{ $tour->surname }}
            @else
            <strong>{{ $tour->surname }}</strong>
            @endif
          </td>
          <td><a href="mailto:{{ $tour->email }}" target="_blank">{{ $tour->email }}</a></td>
          <td><a href="tel:{{ $tour->phone }}" target="_blank">{{ $tour->phone }}</a></td>
          <td>{{ date('d-m-Y', strtotime($tour->date_of_birth)) }}</td>
          <td>{{ $tour->created_at->format('Y-m-d H:i:s') }}</td>
          <td class="tb-col-action">
            <a href="{{ route('panel.tour_requests.show', ['tour' => $tour->id, 'kind' => $kind]) }}" class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-eye"></em></a>
            <a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $tour->id }}').submit(); }" class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
            <form action="{{ route('panel.tour_requests.destroy', ['tour' => $tour->id, 'kind' => $kind]) }}" method="post" id="destroy-{{ $tour->id }}">
              @method('delete')
              @csrf
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @include('panel.include.paginate', ['data' => ['items' => $tours, 'limit' => $page_limit]])
  
  @else
  <p>{{ __('not exist', ['thing' => __(ucfirst($kind) . ' request')]) }}</p>
  @endif
</div>

@endsection