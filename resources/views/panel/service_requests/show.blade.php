@extends('layouts.panel')

@section('title') {{ $service->surname . ' ' . $service->name . ' - ' . __(ucfirst($type) . ' request') }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-head-sub"><span>{{ __(ucfirst($type) . ' request') }}</span></div>
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ $service->surname . ' ' . $service->name }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a href="#" class="btn btn-white btn-dim btn-outline-danger" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $service->id }}').submit(); }">
            <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">{{ __('Delete') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<form action="{{ route('panel.service_requests.destroy', ['service' => $service->id, 'type' => $type]) }}" method="post" id="destroy-{{ $service->id }}">
  @method('delete')
  @csrf
</form>

<div class="card card-bordered mb-4">
  <div class="nk-data data-list">
    @if ($service->type != 'translation')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Applicant type') }}</span>
        <span class="data-value">{{ __(ucfirst($service->applicant_type)) }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @endif

    @if (($service->type == 'visa' && $service->applicant_type == 'outbound') || $service->type == 'hotel')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Country') }}</span>
        <span class="data-value">{{ $service->country ?? '—' }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @endif

    @if ($service->type == 'hotel')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('City') }}</span>
        <span class="data-value">{{ $service->city ?? '—' }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Booking date') }}</span>
        <span class="data-value">
          {{ date('d-m-Y', strtotime($service->booking_date_from)) }}
          @if ($service->booking_date_to)
          &#8212; {{date('d-m-Y', strtotime($service->booking_date_to)) }}
          @endif
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Room type') }}</span>
        <span class="data-value">{{ __($service->room_type) }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Guests') }}</span>
        <span class="data-value">{{ __('Adults') . ': ' . $service->adult_qty }} <br> {{ __('Children') . ': ' . $service->child_qty }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @endif

    @if ($service->type == 'ticket')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('From') }}</span>
        <span class="data-value">{{ $service->ticket_from ?? '—' }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('To') }}</span>
        <span class="data-value">{{ $service->ticket_to ?? '—' }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Ticket type') }}</span>
        <span class="data-value">{{ __(ucfirst($service->ticket_type)) }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Boarding date') }}</span>
        <span class="data-value">
          {{ date('d-m-Y', strtotime($service->boarding_date_from)) }}
          @if ($service->boarding_date_to)
          &#8212; {{date('d-m-Y', strtotime($service->boarding_date_to)) }}
          @endif
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
      <div class="data-item">
        <div class="data-col">
          <span class="data-label">{{ __('Returning date') }}</span>
          <span class="data-value">
        {{ date('d-m-Y', strtotime($service->returning_date_from)) }}
            @if ($service->returning_date_to)
              &#8212; {{date('d-m-Y', strtotime($service->returning_date_to)) }}
            @endif
      </span>
        </div>
        <div class="data-col data-col-end"></div>
      </div>
    @endif

    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Name') }}</span>
        <span class="data-value">{{ $service->name }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Surname') }}</span>
        <span class="data-value">{{ $service->surname }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Patronymic') }}</span>
        <span class="data-value">{!! $service->patronymic ?? '&#8212' !!}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Email') }}</span>
        <span class="data-value"><a href="mailto:{{ $service->email }}" target="_blank">{{ $service->email }}</a></span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Phone') }}</span>
        <span class="data-value"><a href="tel:{{ $service->phone }}" target="_blank">{{ $service->phone }}</a></span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @if ($service->type != 'translation')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Date of birth') }}</span>
        <span class="data-value">{{ date('d-m-Y', strtotime($service->date_of_birth)) }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @endif
    @if ($service->type == 'visa')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Planned date') }}</span>
        <span class="data-value">
          {{ date('d-m-Y', strtotime($service->planned_date_from)) }}
          @if ($service->planned_date_to)
          &#8212; {{date('d-m-Y', strtotime($service->planned_date_to)) }}
          @endif
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @endif
    @if ($service->passport_info_type == 'typing')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Passport number') }}</span>
        <span class="data-value">{!! $service->passport_number ?? "&#8212;" !!}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Passport expiry date') }}</span>
        <span class="data-value">{{ $service->expiry_date ? date('d-m-Y', strtotime($service->expiry_date)) : '—' }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @endif

    @if ($service->passport_info_type == 'upload')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Scanned passport file') }}</span>
        @foreach($service->getPassport() as $file)
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
    @endif

    @if ($service->type == 'visa' || $service->type == 'hotel')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Document photo') }}</span>
        <span class="data-value">
          @if (count($service->getDocPhotoFiles()))
          <a href="{{ route('panel.service_requests.download.zip', ['service' => $service->id, 'file_type' => 'doc_photos']) }}">{{ __('Download') }}</a>
          @else
          {{ __('None') }}
          @endif
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @endif

    @if ($service->type == "visa" && $service->applicant_type == 'outbound')
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Inner passport and birth certificate') }}</span>
        <span class="data-value">
          @if (count($service->getExtraDocFiles()))
          <a href="{{ route('panel.service_requests.download.zip', ['service' => $service->id, 'file_type' => 'extra_docs']) }}">{{ __('Download') }}</a>
          @else
          {{ __('None') }}
          @endif
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @endif

    @if ($service->type == "translation")
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Scanned document') }}</span>
        <span class="data-value">
          @if (count($service->getScannedDocumentFiles()))
          <a href="{{ route('panel.service_requests.download.zip', ['service' => $service->id, 'file_type' => 'scanned_documents']) }}">{{ __('Download') }}</a>
          @else
          {{ __('None') }}
          @endif
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    @endif

    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Note') }}</span>
        <span class="data-value">{!! $service->note ?? '&#8212' !!}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>

  </div>
</div>
@endsection