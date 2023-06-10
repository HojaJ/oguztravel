@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __(ucfirst($type))]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-head-sub"><span>{{ __('All') }}</span></div>
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ $type == 'tour' ? __('Tours') : __('Turkmenistan') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a href="{{ route('panel.tours.create', ['type' => $type]) }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Create new') }}</span>
          </a>
        </li>
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
          <th>{{ __('Image') }}</th>
          <th>{{ __('Category') }}</th>
          <th>{{ __('Bound') }}</th>
          <th>{{ __('Price') }}</th>
          @foreach(LaravelLocalization::getSupportedLocales() as $properties)
          <th>{{ $properties['native'] }}</th>
          @endforeach
          <th>{{ __("Discount") }}</th>
          <th>{{ __("Action") }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tours as $tour)
        <tr class="tb-tnx-item">
          <td><img src="{{ $tour->firstImage() }}" alt="tour-{{ $tour->id }}" style="height: 70px;"></td>
          <td>{{ $tour->category->name }}</td>
          <td>{{ ucfirst($tour->bound) }}</td>
          <td>{{ $tour->price }}$</td>
          @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
          <td>{{ $tour->getTranslation('title', $locale) }}</td>
          @endforeach
          <td >
            @if($tour->discount_active === 1)
              <div class="text-azure timer" style="font-size: 11px; white-space: nowrap" data-time="{{\Carbon\Carbon::make($tour->discount_end_time)->format('Y-m-d H:i')}}"></div>
              <span class="change down text-danger"><em class="icon ni ni-arrow-long-down"></em>{{$tour->discount_percent}}%</span>
              <div class="chart-label" style="font-size: 9px; white-space: nowrap">{{\Carbon\Carbon::make($tour->discount_end_time)->format('Y-m-d H:i')}}</div>
            @else
            None
            @endif
          </td>
          <td class="tb-col-action">
            <span class="mr-1"><a href="{{ route('panel.tours.show', ['tour' => $tour->id, 'type' => $type]) }}" class="link-cross link-edit mr-sm-n1"><em class="icon ni ni-eye"></em></a></span>
            <span class="mr-1"><a href="{{ route('panel.tours.edit', ['tour' => $tour->id, 'type' => $type]) }}" class="link-cross link-edit mr-sm-n1"><em class="icon ni ni-edit-alt"></em></a></span>
            <span><a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $tour->id }}').submit(); }" class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a></span>
            <form action="{{ route('panel.tours.destroy', ['tour' => $tour->id, 'type' => $type]) }}" method="post" id="destroy-{{ $tour->id }}">
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
  <p>{{ __('not exist', ['thing' => __(ucfirst($type))]) }}</p>
  @endif
</div>

@endsection
@section('js')
  <script>
    // Set the date we're counting down to
    var timers = document.getElementsByClassName("timer");
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