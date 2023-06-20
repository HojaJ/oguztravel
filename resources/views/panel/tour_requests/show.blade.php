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
        <span class="data-label">{{ __('Price') }}</span>
        <span class="data-value">
          {{ $tour->price }}$&nbsp;&nbsp;

          @if($tour->discount_active === 1)
            <div class="text-azure timer" style="font-size: 11px; white-space: nowrap" data-time="{{\Carbon\Carbon::make($tour->discount_end_time)->format('Y-m-d H:i')}}"></div>
            <span class="change down text-danger" style="font-size: 13px; white-space: nowrap">
                <em class="icon ni ni-arrow-long-down"></em>{{$tour->discount_percent}}%
                {{  $tour->discount_price}}$
              </span>
            <div class="chart-label" style="font-size: 9px; white-space: nowrap">{{\Carbon\Carbon::make($tour->discount_end_time)->format('Y-m-d H:i')}}</div>
          @endif

        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Scanned passport file') }}</span>
        @if(!is_null($tour->getFile()))
          @foreach($tour->getFile() as $file)
            <span class="data-value mr-3">
            @if ($file['type'] == 'jpg' || $file['type'] == 'bmp' || $file['type'] == 'png')
                <a href="{{ $file['filename'] }}" download>{{ __('Image') }}</a>
              @elseif ($file['type'] == 'doc' || $file['type'] == 'docx')
                <a href="{{ $file['filename'] }}" download>{{ __('Microsoft Word') }}</a>
              @elseif ($file['type'] == 'pdf')
                <a href="{{ $file['filename'] }}" download>{{ __('PDF') }}</a>
              @else
                <a href="{{ $file['filename'] }}" download>{{ $file['filename'] }}</a>
              @endif
          </span>
          @endforeach
        @endif
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Note') }}</span>
        <span class="data-value">{!! $tour->note ?? '&#8212' !!}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Date') }}</span>
        <span class="data-value">{{ $tour->created_at->format('Y-m-d H:i:s') }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
  </div>
</div>
<script>
  // Set the date we're counting down to
  var timers = Array.from(document.getElementsByClassName("timer"));
  timers.forEach(function (timer) {
    var countDownDate = new Date(timer.getAttribute('data-time')).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="demo"
      timer.innerHTML = days + "d " + hours + "h "
              + minutes + "m " + seconds + "s ";

      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        timer.innerHTML = "EXPIRED";
      }
    }, 1000);
  })



</script>
@endsection