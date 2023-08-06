@extends('layouts.app')

@section('title')
  {{ $service->title }}
@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('css/intlTelInput.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/datepicker.min.css') }}">
  <style>
    .hero_in.general::before {
      background-image: url('{{ $service->getImage() }}');
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

  <section class="hero_in general">
    <div class="wrapper">
      <div class="container">
        <h1 class="fadeInUp"><span></span>{{ $service->title }}</h1>
      </div>
    </div>
  </section>

  <div class="bg_color_1">
    <div class="container margin_80_55">
      <div class="row justify-content-between">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <h4>{{ __('Send an inquiry') }}</h4>
          <p>{{ $service->subtitle }}</p>
          <div id="message-contact"></div>
          <form method="post" action="{{ route('services.store', $service->slug) }}" autocomplete="off" class="oguzform" data-service="{{ $service->slug }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
              @if (($service->slug == 'visa') || ($service->slug == 'hotel'))
                <div class="col-6 mb-4">
                  <div class="form-check">
                    <input class="form-check-input @error('applicant_type') is-invalid @enderror" type="radio" name="applicant_type" id="outbound_applicant" value="outbound"
                      {{ !old('applicant_type') || old('applicant_type') == 'outbound' ? 'checked' : '' }} onfocus="this.setAttribute('autocomplete', 'none');" required>
                    <label class="form-check-label" for="outbound_applicant">{{ __('Outbound') }}</label>
                  </div>
                </div>
                <div class="col-6 mb-4">
                  <div class="form-check">
                    <input class="form-check-input @error('applicant_type') is-invalid @enderror" type="radio" name="applicant_type" onfocus="this.setAttribute('autocomplete', 'none');" id="inbound_applicant" value="inbound"
                      {{ old('applicant_type') == 'inbound' ? 'checked' : '' }} required>
                    <label class="form-check-label" for="inbound_applicant">{{ __('Inbound') }}</label>
                  </div>
                </div>
              @endif

              {{-- here --}}
              @if ($service->slug == 'visa' || $service->slug == 'hotel')
                <div class="col-md-6" id="countryWrap">
                  <div class="form-group">
                    <label for="country">{{ __('Planned Country') }} <span class="text-danger">*</span></label>
                    <select name="country" id="country" class="form-control" required>
                      <option value="empty" disabled hidden selected>{{ __('Choose country') }}</option>
                      @foreach ($countries as $country)
                        <option value="{{ $country->name }}" {{ old('country' == $country->name) ? 'selected' : '' }}>{{ $country->name }}</option>
                      @endforeach
                    </select>
                    {{-- <input class="form-control @error('country') is-invalid @enderror" type="text" id="country" --}}
                    {{-- name="country" value="{{ old('country') }}"> --}}
                    @if ($errors->has('country'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('country') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>
              @endif

              @if ($service->slug == 'hotel')
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="city">{{ __('City') }}</label>
                    <input class="form-control @error('city') is-invalid @enderror" type="text" id="city" onfocus="this.setAttribute('autocomplete', 'none');" name="city" value="{{ old('city') }}" required>
                    @if ($errors->has('city'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('city') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="booking_date">{{ __('Booking date') }}</label>
                    <input class="form-control air-pick-range @error('booking_date') is-invalid @enderror" type="text" onfocus="this.setAttribute('autocomplete', 'none');" id="booking_date" name="booking_date"
                      value="{{ old('booking_date') }}" required>
                    <i class="icon_calendar"></i>
                    @if ($errors->has('booking_date'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('booking_date') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="room_type">{{ __('Room type') }}</label>
                    <select name="room_type" id="room_type" class="form-control @error('room_type') is-invalid @enderror" required>
                      <option value="single_bed" {{ old('room_type') == 'single_bed' ? 'selected' : '' }}>
                        {{ __('Single Bed') }}</option>
                      <option value="double_bed" {{ old('room_type') == 'double_bed' ? 'selected' : '' }}>
                        {{ __('Double Bed') }}</option>
                      <option value="king_size_bed" {{ old('room_type') == 'king_size_bed' ? 'selected' : '' }}>
                        {{ __('King Size Bed') }}</option>
                      <option value="double_room" {{ old('room_type') == 'double_room' ? 'selected' : '' }}>
                        {{ __('Double Room') }}</option>
                    </select>
                    @if ($errors->has('room_type'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('room_type') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>

                <div class="col-md-6">
                  <label for="guests">{{ __('Guests') }}</label>
                  <div class="panel-dropdown">
                    <a href="#">{{ __('Guests') }} <span class="qtyTotal">1</span></a>
                    <div class="panel-dropdown-content right">
                      <div class="qtyButtons">
                        <label>{{ __('Adults') }}</label>
                        <input type="text" name="adult_qty" data-guest="qtyInput" value="{{ old('adult_qty', '1') }}">
                      </div>
                      <div class="qtyButtons">
                        <label>{{ __('Children') }}</label>
                        <input type="text" name="child_qty" data-guest="qtyInput" value="{{ old('adult_qty', '0') }}">
                      </div>
                    </div>
                  </div>
                </div>
              @endif

              @if ($service->slug == 'ticket')
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="ticket_from">{{ __('From') }}</label>
                    <input class="form-control @error('ticket_from') is-invalid @enderror" type="text" id="ticket_from" name="ticket_from" value="{{ old('ticket_from') }}" required>
                    @if ($errors->has('ticket_from'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('ticket_from') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="ticket_to">{{ __('To') }}</label>
                    <input class="form-control @error('ticket_to') is-invalid @enderror" type="text" id="ticket_to" name="ticket_to" value="{{ old('ticket_to') }}" required>
                    @if ($errors->has('ticket_to'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('ticket_to') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>
            </div>

            <div class="row">
              <div class="col-6 mb-4">
                <div class="form-check">
                  <input class="form-check-input @error('ticket_type') is-invalid @enderror" type="radio" name="ticket_type" id="oneway" value="oneway"
                    {{ !old('ticket_type') || old('ticket_type') == 'oneway' ? 'checked' : '' }} required>
                  <label class="form-check-label" for="oneway">{{ __('One way') }}</label>
                </div>
              </div>
              <div class="col-6 mb-4">
                <div class="form-check">
                  <input class="form-check-input @error('ticket_type') is-invalid @enderror" type="radio" name="ticket_type" id="round" value="round"
                    {{ old('ticket_type') == 'round' ? 'checked' : '' }} required>
                  <label class="form-check-label" for="round">{{ __('Round trip') }}</label>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6" id="boardingDateWrap">
                <div class="form-group">
                  <label for="boarding_date">{{ __('Boarding date') }}</label>
                  <input class="form-control air-pick @error('boarding_date') is-invalid @enderror" type="text" id="boarding_date" name="boarding_date"
                    value="{{ old('boarding_date') }}" required>
                  <i class="icon_calendar"></i>
                  @if ($errors->has('boarding_date'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('boarding_date') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>

              <div class="col-md-6" id="returning_dateWrap">
                <div class="form-group">
                  <label for="returning_date">{{ __('Returning date') }}</label>
                  <input class="form-control air-pick @error('returning_date') is-invalid @enderror" type="text" id="returning_date"
                    name="returning_date" value="{{ old('returning_date') }}" disabled>
                  <i class="icon_calendar"></i>
                  @if ($errors->has('returning_date'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('returning_date') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
              @endif

              <div class="col-md-6">
                <div class="form-group">
                  <label for="surname">{{ __('Surname') }} <span class="text-danger">*</span></label>
                  <input class="form-control @error('surname') is-invalid @enderror" type="text" id="surname" onfocus="this.setAttribute('autocomplete', 'none');" name="surname" value="{{ old('surname') }}" required>
                  @if ($errors->has('surname'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('surname') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="name">{{ __('Name') }} <span class="text-danger">*</span></label>
                  <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" onfocus="this.setAttribute('autocomplete', 'none');" name="name" value="{{ old('name') }}" required>
                  @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('name') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="patronymic">{{ __('Patronymic') }}</label>
                  <input class="form-control @error('patronymic') is-invalid @enderror" type="text" onfocus="this.setAttribute('autocomplete', 'none');" id="patronymic" value="{{ old('patronymic') }}" name="patronymic">
                  @if ($errors->has('patronymic'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('patronymic') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="gender">{{ __('Select Gender') }} <span class="text-danger">*</span></label>
                  <select class="custom-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                    <option disabled value="" selected hidden>{{ __('Select Gender') }}</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
                  </select>
                  @if ($errors->has('gender'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('gender') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="email">{{ __('Email') }} <span class="text-danger">*</span></label>
                  <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" onfocus="this.setAttribute('autocomplete', 'none');" name="email" value="{{ old('email') }}" required>
                  @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('email') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">{{ __('Mobile number') }} <span class="text-danger">*</span></label>
                  <input class="form-control @error('phone') is-invalid @enderror" type="tel" id="phone" onfocus="this.setAttribute('autocomplete', 'none');" name="phone" value="{{ old('phone') }}" required>
                  @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('phone') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                  <span id="valid-msg" class="hide">Valid</span>
                  <span id="error-msg" class="hide"></span>
                </div>
              </div>

              @if ($service->slug != 'translation')
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date_of_birth">{{ __('Date of birth') }} <span class="text-danger">*</span></label>
                    <input class="form-control air-pick @error('date_of_birth') is-invalid @enderror" type="text" id="date_of_birth" name="date_of_birth"
                      value="{{ old('date_of_birth') }}" required>
                    <i class="icon_calendar"></i>
                    @if ($errors->has('date_of_birth'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('date_of_birth') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>
              @endif

              @if ($service->slug == 'visa')
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="planned_date">{{ __('Planned date') }} <span class="text-danger">*</span></label>
                    <input class="form-control air-pick-range @error('planned_date') is-invalid @enderror" type="text" name="planned_date" id="planned_date"
                      value="{{ old('planned_date') }}" required>
                    <i class="icon_calendar"></i>
                    @if ($errors->has('planned_date'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('planned_date') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>
              @endif
            </div>

            @if ($service->slug != 'translation')
              <div class="row">
                <div class="col-6 mb-4">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="passport_info_type" id="passport_info_type" value="typing"
                      {{ !old('passport_info_type') || old('passport_info_type') == 'typing' ? 'checked' : '' }} required>
                    <label class="form-check-label @error('passport_info_type') is-invalid @enderror" for="passport_info_type">{{ __('Type passport information') }}</label>
                  </div>
                </div>
                <div class="col-6 mb-4">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="passport_info_type" id="passport_info_upload" value="upload"
                      {{ old('passport_info_type') == 'upload' ? 'checked' : '' }}>
                    <label class="form-check-label @error('passport_info_type') is-invalid @enderror" for="passport_info_upload">{{ __('Upload passport') }}</label>
                  </div>
                </div>
              </div>
            @endif

            <div class="row">
              @if ($service->slug != 'translation')
                <div class="col-md-6" id="passportNumberWrap">
                  <div class="form-group">
                    <label for="passport_number">{{ __('Passport number') }}</label>
                    <input class="form-control @error('passport_number') is-invalid @enderror" type="text" id="passport_number" name="passport_number"
                      value="{{ old('passport_number') }}">
                    @if ($errors->has('passport_number'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('passport_number') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>

                <div class="col-md-6" id="passportExpirationWrap">
                  <div class="form-group" id="expiry_date">
                    <label for="expiry_date">{{ __('Passport expiry date') }}</label>
                    <input class="form-control air-pick @error('expiry_date') is-invalid @enderror" type="text" id="expiry_date" name="expiry_date"
                      value="{{ old('expiry_date') }}">
                    <i class="icon_calendar"></i>
                    @if ($errors->has('expiry_date'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('expiry_date') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>

                <div class="col-12 d-none" id="scannedPassportWrap">
                  <div class="form-group">
                    <label for="scanned_passport">{{ __('Scanned passport') }}</label>
                    <input type="file" class="form-control @error('scanned_passport') is-invalid @enderror" name="scanned_passport_file[]" id="scanned_passport" multiple>
                    @if ($errors->has('scanned_passport'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('scanned_passport') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>
              @endif

              @if ($service->slug == 'translation')
                <div class="col-12">
                  <div class="form-group">
                    <label for="scanned_document">{{ __('Scanned document') }}</label>
                    <input type="file" class="form-control @error('scanned_document') is-invalid @enderror" name="scanned_documents[]" id="scanned_document" multiple>
                    @if ($errors->has('scanned_document'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('scanned_document') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>
              @endif

              @if ($service->slug == 'visa')
                <div class="col-12" id="innerPassportWrap">
                  <div class="form-group">
                    <label for="extra_doc">{{ __('Inner passport and birth certificate') }}</label>
                    <input type="file" class="form-control @error('extra_doc') is-invalid @enderror" name="extra_docs[]" id="extra_doc" multiple>
                    @if ($errors->has('extra_doc'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('extra_doc') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>
              @endif

              @if ($service->slug == 'visa' || $service->slug == 'hotel')
                <div class="col-12">
                  <div class="form-group">
                    <label for="doc_photo">{{ __('Document photo') }}</label>
                    <input type="file" class="form-control @error('doc_photo') is-invalid @enderror" name="doc_photos[]" id="doc_photo" multiple>
                    @if ($errors->has('doc_photo'))
                      <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('doc_photo') }}</strong></span>
                    @else
                      <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                    @endif
                  </div>
                </div>
              @endif

              <div class="col-12">
                <div class="form-group">
                  <label for="note">{{ __('Note') }}</label>
                  <textarea name="note" id="note" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                  @if ($errors->has('note'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('note') }}</strong></span>
                  @else
                    <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
                  @endif
                </div>
              </div>
            </div>
            <label class="d-flex justify-content-start mt-2 mb-4 align-items-baseline" for="terms"><input id="terms" class="h-auto mr-2" type="checkbox" required /><p class="mb-0">{{ __('Check here to indicate that you have read and agree to the terms of the') }} Oguztravel <a target="_blank" href="{{ route('privacy') }}"> {{ __("Privacy Policy") }}</a></p>
            </label>
            <p class="add_top_30">
              <button class="btn_1 rounded" type="submit" id="submit-service">{{ __('Send') }}</button>
            </p>
          </form>
        </div>
        <div class="col-lg-3"></div>
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

      $('.air-pick').datepicker({
        language: currentLang,
        autoClose: true,
        dateFormat: 'yyyy-mm-dd',
      });

      $('.air-pick-range').datepicker({
        language: currentLang,
        autoClose: true,
        range: true,
        dateFormat: 'yyyy-mm-dd',
      });

      const service = $('form.oguzform').attr('data-service');

      const passportNumberWrap = $('#passportNumberWrap');
      const passportExpirationWrap = $('#passportExpirationWrap');
      const scannedPassportWrap = $('#scannedPassportWrap');

      $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
        const countryCode = (resp && resp.country) ? resp.country : "ru";
        iti.setCountry(countryCode)
      });
      if (service === 'ticket') {
        const boardingDateWrap = $('#boardingDateWrap');
        const boardingDateRangeWrap = $('#boardingDateRangeWrap');
        let returningDate = $('#returning_date');

        $('input[name=ticket_type]').change(function() {
          console.log($(this).val())
          if ($(this).val() === 'oneway') {
            returningDate.prop('disabled',true)
          }

          if ($(this).val() === 'round') {
            returningDate.prop('disabled',false);
          }
        });
      }

        if (service === 'visa') {
        const countryWrap = $('#countryWrap');
        const innerPassportWrap = $('#innerPassportWrap');

        if ($('input[name=applicant_type]').val() === 'inbound') {
          countryWrap.find('#country').val('Turkmenistan').attr('disabled',true);
          iti.setCountry("tm");
        }

        if ($('input[name=applicant_type]').val() === 'outbound') {
          countryWrap.find('#country').val('empty').attr('disabled',false);
          $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
            const countryCode = (resp && resp.country) ? resp.country : "ru";
            iti.setCountry(countryCode)
          });
        }

        $('input[name=applicant_type]').change(function() {
          if ($(this).val() === 'inbound') {
            countryWrap.find('#country').val('Turkmenistan').attr('disabled',true);
            innerPassportWrap.removeClass('d-none');
          }

          if ($(this).val() === 'outbound') {
            countryWrap.find('#country').val('empty').attr('disabled',false);
            innerPassportWrap.addClass('d-none');
          }
        });
      }

      $('input[name=passport_info_type]').change(function() {
        const applicantType = $('input[name=applicant_type]');

        if ($(this).val() === 'typing') {
          passportNumberWrap.removeClass('d-none');
          passportExpirationWrap.removeClass('d-none');
          scannedPassportWrap.addClass('d-none');
        }

        if ($(this).val() === 'upload') {
          passportNumberWrap.addClass('d-none');
          passportExpirationWrap.addClass('d-none');
          scannedPassportWrap.removeClass('d-none');
        }
      });

      if (service !== 'translation') {
        $('input[name=applicant_type]').change(function() {
          if ($(this).val() === 'inbound') {
            iti.setCountry("tm");
          }

          if ($(this).val() === 'outbound') {
            $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
              const countryCode = (resp && resp.country) ? resp.country : "ru";

              iti.setCountry(countryCode)
            });
          }
        });
      }

      var reset = function() {
        telInput.classList.remove("error");
        errorMsg.innerHTML = "";
        errorMsg.classList.add("hide");
        validMsg.classList.add("hide");
      };

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
