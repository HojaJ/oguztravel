@section('title') {{ $tour->title . ' - ' . __($data['type']) }} @endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
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
              <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" placeholder="{{ __("Name") }}" value="{{ old('name') }}">
              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <input type="hidden" name="tour_id" value="{{ $tour->id }}">
            <div class="form-group">
              <label for="surname">{{ __("Surname") }} <span class="text-danger">*</span></label>
              <input class="form-control @error('surname') is-invalid @enderror" type="text" id="surname" name="surname" placeholder="{{ __("Surname") }}" value="{{ old('surname') }}">
              @if ($errors->has('surname'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('surname') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <div class="form-group">
              <label for="patronymic">{{ __("Patronymic") }}</label>
              <input class="form-control @error('patronymic') is-invalid @enderror" type="text" id="patronymic" name="patronymic" placeholder="{{ __("Patronymic") }}" value="{{ old('patronymic') }}">
              @if ($errors->has('patronymic'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('patronymic') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <div class="form-group">
              <label for="email">{{ __("Email") }} <span class="text-danger">*</span></label>
              <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" placeholder="{{ __("Email") }}" value="{{ old('email') }}">
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <div class="form-group">
              <label for="phone">{{ __("Mobile number") }} <span class="text-danger">*</span></label>
              <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="phone" name="phone" placeholder="{{ __("Mobile number") }}" value="{{ old('phone') }}">
              @if ($errors->has('phone'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <div class="form-group">
              <label for="date_of_birth">{{ __("Date of birth") }} <span class="text-danger">*</span></label>
              <input class="form-control air-pick @error('date_of_birth') is-invalid @enderror" type="text" id="date_of_birth" name="date_of_birth" placeholder="{{ __("Date of birth") }}" value="{{ old('date_of_birth') }}">
              <i class="icon_calendar"></i>
              @if ($errors->has('date_of_birth'))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('date_of_birth') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <div class="form-group clearfix">
              <label for="applicant_type">{{ __("Applicant type") }} <span class="text-danger">*</span></label>
              <div class="custom-select-form">
                <select class="wide @error('applicant_type') is-invalid @enderror" id="applicant_type" name="applicant_type">
                  <option value="inbound" @if(old('applicant_type')=='inbound' ) selected @endif>{{ __("Inbound") }}</option>
                  <option value="outbound" @if(old('applicant_type')=='outbound' ) selected @endif>{{ __("Outbound") }}</option>
                </select>
                @if ($errors->has('applicant_type'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('applicant_type') }}</strong></span>
                @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="scanned_passport">{{ __("Scanned passport") }}</label>
              <input class="form-control @error('scanned_passport') is-invalid @enderror" type="file" id="scanned_passport" name="scanned_passport" placeholder="{{ __("Scanned passport") }}">
              @if ($errors->has('scanned_passport '))
              <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('scanned_passport ') }}</strong></span>
              @else
              <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
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
<script src="{{ asset('js/datepicker.min.js') }}"></script>
<script src="{{ asset('js/datepicker.en.js') }}"></script>
<script src="{{ asset('js/datepicker.tm.js') }}"></script>
<script src="{{ asset('js/datepicker.zh.js') }}"></script>
<script src="{{ asset('js/magnific-popup.min.js') }}"></script>

<script>
  $(document).ready(function() {
    const currentLang = '{{ LaravelLocalization::getCurrentLocale() }}';

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
  });
</script>
@endsection