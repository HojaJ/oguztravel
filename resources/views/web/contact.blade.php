@extends('layouts.app')

@section('title')
  {{ __('Contact us') }}
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css') }}">

  <style>
    .hide {
      display: none;
    }

    .iti.iti--allow-dropdown.iti--separate-dial-code {
      width: 100%
    }
  </style>
@endsection

@section('main')
  @if ($cover && $cover->filename)
    <style>
      .hero_in.contacts:before {
        background-image: url('{{ $cover->getImage() }}');
      }
    </style>
  @endif

  <div id="messages">
    @if (session('success'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
    @endif

    @if (session('error'))
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

  <section class="hero_in contacts">
    <div class="wrapper">
      <div class="container">
        <h1 class="fadeInUp"><span></span>{{ __('Contact us') }}</h1>
      </div>
    </div>
  </section>

  <div class="bg_color_1">
    <div class="container margin_80_55">
      <div class="row justify-content-between">
        <div class="col-lg-5">
          <div class="map" id="map">
          </div>
        </div>
        <div class="col-lg-6">
          <h4>{{ __('Send a message') }}</h4>
          @if ($cover && $cover->filename)
            <p>{{ $cover->subtitle }}</p>
          @endif
          <div id="message-contact"></div>

          <form method="post" action="{{ route('contact.message') }}" id="contactform" autocomplete="off">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">{{ __('Name') }}</label>
                  <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"  name="name" value="{{ old('name') }}">
                  @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="surname">{{ __('Surname') }}</label>
                  <input class="form-control @error('surname') is-invalid @enderror" type="text" id="surname" name="surname" value="{{ old('surname') }}" required>
                  @if ($errors->has('surname'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('surname') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">{{ __('Email') }}</label>
                  <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}">
                  @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">{{ __('Phone') }}</label>
                  <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="phone" name="phone" value="{{ old('phone') }}" required>
                  @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                  <span id="valid-msg" class="hide">Valid</span>
                  <span id="error-msg" class="hide"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="subject">{{ __('Select Gender') }}</label>
                  <select class="custom-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                    <option selected disabled hidden>{{ __('Select Gender') }}</option>
                    <option value="male" {{ old('male') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('female') == 'famale' ? 'selected' : '' }}>{{ __('Female') }}</option>
                  </select>
                  @if ($errors->has('message'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('message') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                @if (count($subjects))
                  <div class="form-group">
                    <label for="subject">{{ __('Select subject') }}</label>
                    <select class="custom-select @error('subject_id') is-invalid @enderror" id="subject" name="subject_id">
                      <option selected disabled hidden>{{ __('Select subject') }}</option>
                      @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->title }} ( {{ $subject->email  }} )</option>
                      @endforeach
                    </select>
                    @if ($errors->has('message'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('message') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="message">{{ __('Message') }}</label>
              <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" style="height:150px;" required>{{ old('message') }}</textarea>
              @if ($errors->has('message'))
                <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('message') }}</strong></span>
              @else
                <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
              @endif
            </div>
            <p class="add_top_30">
              <button class="btn_1 rounded" id="submit-contact" type="submit">{{ __('Send') }}</button>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="bg_color_1">
    <div class="container margin_60_35">
      <div class="main_title_3">
        <span><em></em></span>
        <h2>{{ __('Contact information') }}</h2>
      </div>
      <div class="list_articles add_bottom_30 clearfix">
        @foreach ($contacts->chunk(3) as $triple)
          <ul>
            @foreach ($triple as $contact)
              @if ($contact->type == 'address')
                <li><i>{!! $contact->icon !!}</i> {{ $contact->locale_data }}</li>
              @endif

              @if ($contact->type == 'email')
                <li><a href="mailto:{{ $contact->data }}"><i>{!! $contact->icon !!}</i> {{ $contact->data }}</a></li>
              @endif
              @if ($contact->slug == 'fax')
                <li><a href="fax:{{ $contact->data }}"><i>{!! $contact->icon !!}</i> {{ $contact->data }}</a></li>
              @endif

              @if ($contact->type == 'contact')
                <li><a href="tel:{{ $contact->data }}"><i>{!! $contact->icon !!}</i> {{ $contact->data }}</a></li>
              @endif

            @endforeach
          </ul>
        @endforeach
      </div>
    </div>
  </div>
@endsection

@section('js')
  <script
    src="https://api-maps.yandex.ru/2.1/?apikey=68a1f96f-340d-41f9-8d1e-b0b4f7437eca&lang={{ LaravelLocalization::getCurrentLocale() == 'en' || LaravelLocalization::getCurrentLocale() == 'zh' ? 'en-US' : 'ru-RU' }}"
    type="text/javascript"></script>
  <script src="{{ asset('js/map.js') }}" type="text/javascript"></script>
  <script src="{{ asset('js/intlTelInput.min.js') }}"></script>
  <script>
    $(document).ready(function() {
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
        geoIpLookup: function(callback) {
          $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "us";
            callback(countryCode);
          });
        },
        utilsScript: "{{ asset('js/utils.js') }}"
      });

      // on blur: validate
      telInput.addEventListener('blur', function() {
        reset();
        if (telInput.value.trim()) {
          if (iti.isValidNumber()) {
            // validMsg.classList.remove("hide");
            $(".btn").removeAttr("disabled");
          } else {
            telInput.classList.add("error");
            var errorCode = iti.getValidationError();
            errorMsg.innerHTML = errorMap[errorCode];
            errorMsg.classList.remove("hide");
            $(".btn").attr("disabled", true);
          }
        }
      });

      var reset = function() {
        telInput.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        validMsg.classList.add("hide");
      };

      // on keyup / change flag: reset
      telInput.addEventListener('change', reset);
      telInput.addEventListener('keyup', reset);
    });
  </script>

  @if ($errors->any() || session('success') || session('danger'))
    <script>
      const fadeTarget = document.getElementById("messages");

      setTimeout(function() {
        setInterval(function() {
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
    </script>
  @endif
@endsection