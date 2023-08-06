@section('title') {{ $tour->title . ' - ' . __($data['type']) }} @endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
  <script src='https://www.google.com/recaptcha/api.js'></script>

  <style>
  .box_grid {
    box-shadow: none;
  }
  .hide {
    display: none;
  }
  .iti.iti--allow-dropdown.iti--separate-dial-code {
    width: 100%
  }
  .iti__country-list {
    z-index: 10;
  }
</style>
@endsection

@section('main')
<div id="messages">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>
  @endif

  @if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>
  @endif

  @if (session('danger'))
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('danger') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  </div>
  @endif
</div>

<section class="hero_in general">
  <div class="wrapper">
    <div class="container">
      <h1 class="fadeInUp"><span></span>{{ $tour->title }}</h1>
    </div>
  </div>
</section>

<div class="bg_color_1">
  <nav class="secondary_nav sticky_horizontal">
    <div class="container">
      <ul class="clearfix">
        <li><a href="#galleries" class="active">{{ __("Galleries") }}</a></li>
        <li><a href="#description">{{ __("Description") }}</a></li>
        <li><a href="#include">{{ __("Include / Exclude") }}</a></li>
        <li><a href="#details">{{ __("Details") }}</a></li>
        <li><a href="#sidebar">{{ __("Booking") }}</a></li>
      </ul>
    </div>
  </nav>
  <div class="container margin_60_35">
    <div class="row">
      <div class="col-lg-8">
        <section id="galleries">
          <div id="carouselTour" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              @foreach ($tour->imagesOrderBy() as $key => $image)
              <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <a href="{{ $image->getImage() }}">
                  <img class="d-block w-100" src="{{ $image->getImage() }}" alt="image-{{ $key + 1 }}">
                </a>
              </div>
              @endforeach
            </div>
            <ol class="carousel-indicators img_indicator">
              @foreach ($tour->imagesOrderBy() as $key => $image)
              <li data-target="#carouselTour" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}">
                <img src="{{ $image->getImage() }}" alt="image-{{ $key + 1 }}">
              </li>
              @endforeach
            </ol>
          </div>
        </section>
        <div class="box_grid">
          @if(isset($tour->price))
            @if($tour->discount_active === 1)
              <span class="price">
                        <strong>{{$tour->discount_price}}$</strong></span>
              <span class="discount_price">
                              <strong>{{ $tour->price }}$</strong>
                              <div class="timer" data-time="{{\Carbon\Carbon::make($tour->discount_end_time)->format('Y-m-d H:i')}}"></div>
                          </span>
            @else
              <span class="price"><strong>{{ $tour->price }}$</strong></span>
            @endif
          @endif
        </div>
        <section id="description">
          <h2>{{ __("Description") }}</h2>
          {!! $tour->description !!}
        </section>

        <section id="include">
          <h2>{{ __("Include / Exclude") }}</h2>
          {!! $tour->include !!}
        </section>

        <section id="details">
          <h2>{{ __("Details") }}</h2>
          {!! $tour->details !!}
        </section>
      </div>

      <aside class="col-lg-4" id="sidebar">
        <div class="box_detail booking tour">
          <form method="post" action="{{ $data['type'] == 'Turkmenistan' ? route('turkmenistan.store') : route('tours.store') }}" id="tourform" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="name">{{ __("Name") }} <span class="text-danger">*</span></label>
              <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" onfocus="this.setAttribute('autocomplete', 'none');" placeholder="{{ __("Name") }}" value="{{ old('name') }}" required>
              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <input type="hidden" name="tour_id" value="{{ $tour->id }}" >
            <div class="form-group">
              <label for="surname">{{ __("Surname") }} <span class="text-danger">*</span></label>
              <input class="form-control @error('surname') is-invalid @enderror" type="text" id="surname" name="surname" onfocus="this.setAttribute('autocomplete', 'none');" placeholder="{{ __("Surname") }}" value="{{ old('surname') }}" required>
              @if ($errors->has('surname'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('surname') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <div class="form-group">
              <label for="patronymic">{{ __("Patronymic") }}</label>
              <input class="form-control @error('patronymic') is-invalid @enderror" type="text" id="patronymic" name="patronymic" placeholder="{{ __("Patronymic") }}" onfocus="this.setAttribute('autocomplete', 'none');" value="{{ old('patronymic') }}">
              @if ($errors->has('patronymic'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('patronymic') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>

            <div class="form-group">
              <label for="subject">{{ __('Select Gender') }} <span class="text-danger">*</span></label>
              <select class="custom-select display-block @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                <option selected disabled hidden>{{ __('Select Gender') }}</option>
                <option value="male" {{ old('male') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                <option value="female" {{ old('female') == 'famale' ? 'selected' : '' }}>{{ __('Female') }}</option>
              </select>
              @if ($errors->has('gender'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('gender') }}</strong></span>
              @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>

            <div class="form-group">
              <label for="email">{{ __("Email") }} <span class="text-danger">*</span></label>
              <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" onfocus="this.setAttribute('autocomplete', 'none');" placeholder="{{ __("Email") }}" value="{{ old('email') }}" required>
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <div class="form-group">
              <label for="phone">{{ __("Mobile number") }} <span class="text-danger">*</span></label>
              <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="phone" onfocus="this.setAttribute('autocomplete', 'none');" name="phone" placeholder="{{ __("Mobile number") }}" value="{{ old('phone') }}" required>
              @if ($errors->has('phone'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <div class="form-group">
              <label for="date_of_birth">{{ __("Date of birth") }} <span class="text-danger">*</span></label>
              <input class="form-control air-pick @error('date_of_birth') is-invalid @enderror" type="text" id="date_of_birth" name="date_of_birth" placeholder="{{ __("Date of birth") }}" value="{{ old('date_of_birth') }}" required>
              <i class="icon_calendar"></i>
              @if ($errors->has('date_of_birth'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('date_of_birth') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
{{--            <div class="form-group clearfix">--}}
{{--              <label for="applicant_type">{{ __("Applicant type") }} <span class="text-danger">*</span></label>--}}
{{--              <div class="custom-select-form">--}}
{{--                <select class="wide @error('applicant_type') is-invalid @enderror" id="applicant_type" name="applicant_type">--}}
{{--                  <option value="inbound" @if(old('applicant_type')=='inbound' ) selected @endif>{{ __("Inbound") }}</option>--}}
{{--                  <option value="outbound" @if(old('applicant_type')=='outbound' ) selected @endif>{{ __("Outbound") }}</option>--}}
{{--                </select>--}}
{{--                @if ($errors->has('applicant_type'))--}}
{{--                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('applicant_type') }}</strong></span>--}}
{{--                @else--}}
{{--                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>--}}
{{--                @endif--}}
{{--              </div>--}}
{{--            </div>--}}
            <div class="form-group">
              <label for="scanned_passport">{{ __("Scanned passport") }}</label>
              <input class="form-control @error('scanned_passport') is-invalid @enderror" type="file" id="scanned_passport" name="scanned_passport[]" placeholder="{{ __("Scanned passport") }}" multiple>
              @if ($errors->has('scanned_passport '))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('scanned_passport ') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>

            <div class="form-group">
              <label for="note">{{ __('Note') }}</label>
              <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
              @if ($errors->has('note'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('note') }}</strong></span>
              @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>

            @if(isset($tour->price))
              @if($tour->discount_active === 1)
                <input type="hidden" value="{{ $tour->price }}" name="price" />
                <input type="hidden" value="{{ $tour->discount_active }}" name="discount_active">
                <input type="hidden" value="{{ $tour->discount_price }}" name="discount_price">
                <input type="hidden" value="{{ $tour->discount_end_time }}" name="discount_end_time">
                <input type="hidden" value="{{ $tour->discount_percent }}" name="discount_percent">
              @else
                <input type="hidden" value="{{ $tour->price }}" name="price">
              @endif
            @endif

            <label class="d-flex justify-content-start mt-2 mb-4 align-items-baseline" for="terms"><input id="terms" class="h-auto mr-2" type="checkbox" required /><p class="mb-0">{{ __('Check here to indicate that you have read and agree to the terms of the') }} Oguztravel <a target="_blank" href="{{ route('privacy') }}"> {{ __("Privacy Policy") }}</a></p>
            </label>
            <div class="form-group">
              <strong>ReCaptcha:</strong>
              <div class="g-recaptcha" data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}"></div>
              @if ($errors->has('g-recaptcha-response'))
                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
              @endif
            </div>

            <button class="btn_1 full-width purchase">{{ __("Send inquiry") }}</button>
          </form>
        </div>
      </aside>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script src="{{ asset('js/intlTelInput.min.js') }}"></script>

  <script src="{{ asset('js/datepicker.min.js') }}"></script>
<script src="{{ asset('js/datepicker.en.js') }}"></script>
<script src="{{ asset('js/datepicker.tm.js') }}"></script>
<script src="{{ asset('js/datepicker.zh.js') }}"></script>
<script src="{{ asset('js/magnific-popup.min.js') }}"></script>
  <script src="{{ asset('js/input_qty.js') }}"></script>

<script>
  $(document).ready(function() {
    const currentLang = '{{ LaravelLocalization::getCurrentLocale() }}';

    const telInput = document.querySelector("#phone"),
            errorMsg = document.querySelector("#error-msg"),
            validMsg = document.querySelector("#valid-msg");

    const errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    const iti = window.intlTelInput(telInput, {
      nationalMode: true,
      initialCountry: "auto",
      autoHideDialCode: true,
      hiddenInput: "full_number",
      preferredCountries: ['cn', 'ru', 'tm'],
      separateDialCode: true,
      utilsScript: "{{ asset('js/utils.js') }}"
    });

    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
      const countryCode = (resp && resp.country) ? resp.country : "ru";
      iti.setCountry(countryCode)
    });



    $('.air-pick').datepicker({
      language: currentLang,
      autoClose: true,
      dateFormat: 'dd-mm-yyyy',
    });

    $('.carousel-item').each(function() {
      $(this).magnificPopup({
        delegate: 'a',
        type: 'image',
        gallery: {
          enabled: true
        }
      });
    });

    const fadeTarget = document.getElementById("messages");

    setTimeout(function () {  
      setInterval(function () {
        if (!fadeTarget.style.opacity) {
          fadeTarget.style.opacity = 1;
        }
        if (fadeTarget.style.opacity > 0) {
          fadeTarget.style.opacity -= 0.1;
        } else {
          clearInterval();
        }
      }, 60);
    }, 5000);

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

  });
</script>
@endsection