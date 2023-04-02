@extends('layouts.panel')

@section('title') {{ $tour->tour->title }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-head-sub"><span>{{ __(ucfirst($kind) . ' requests') }}</span></div>
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ $tour->tour->title }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a href="#" class="btn btn-white btn-dim btn-outline-danger" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $tour->id }}').submit(); }">
            <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">{{ __('Delete') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<form action="{{ route('panel.tour_requests.destroy', $tour->id) }}" method="post" id="destroy-{{ $tour->id }}">
  @method('delete')
  @csrf
</form>

<div class="card card-bordered mb-4">
  <div class="nk-data data-list">
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Tour') }}</span>
        <span class="data-value"><a href="{{ route('panel.tours.show', $tour->tour->id) }}">{{ $tour->tour->title }}</a></span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Applicant type') }}</span>
        <span class="data-value">{{ __(ucfirst($tour->applicant_type)) }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Name') }}</span>
        <span class="data-value">{{ $tour->name }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Surname') }}</span>
        <span class="data-value">{{ $tour->surname }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Patronymic') }}</span>
        <span class="data-value">{{ $tour->patronymic }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Email') }}</span>
        <span class="data-value"><a href="mailto:{{ $tour->email }}" target="_blank">{{ $tour->email }}</a></span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Phone') }}</span>
        <span class="data-value"><a href="tel:{{ $tour->phone }}" target="_blank">{{ $tour->phone }}</a></span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Date of birth') }}</span>
        <span class="data-value">{{ date('d-m-Y', strtotime($tour->date_of_birth)) }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Scanned passport file') }}</span>
        @foreach($tour->getFile() as $file)
          <span class="data-value mr-3">
          @if ($file['type'] == 'jpg' || $file['type'] == 'bmp' || $file['type'] == 'png')
              <a href="{{ $file['filename'] }}" target="_blank">{{ __('Image') }}</a>
            @elseif ($file['type'] == 'doc' || $file['type'] == 'docx')
              <a href="{{ $file['filename'] }}" target="_blank">{{ __('Microsoft Word') }}</a>
            @elseif ($file['type'] == 'pdf')
              <a href="{{ $file['filename'] }}" target="_blank">{{ __('PDF') }}</a>
            @endif
        </span>
        @endforeach
      </div>
      <div class="data-col data-col-end"></div>
    </div>
  </div>
</div>
@endsection