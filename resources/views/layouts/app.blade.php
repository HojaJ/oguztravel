<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Oguztravel - have fun and enjoy">
  <meta name="author" content="subo">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title') | {{ __('app') }}</title>

  <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}" type="image/x-icon" />
  <link rel="apple-touch-icon" href="{{ asset('images/favicon/apple-touch-icon.png') }}" />
  <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-touch-icon-57x57.png') }}" />
  <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-touch-icon-72x72.png') }}" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-touch-icon-76x76.png') }}" />
  <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicon/apple-touch-icon-114x114.png') }}" />
  <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-touch-icon-120x120.png') }}" />
  <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicon/apple-touch-icon-144x144.png') }}" />
  <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-touch-icon-152x152.png') }}" />
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon-180x180.png') }}" />

  <link href="{{ asset('css/all.css') }}" rel="stylesheet">
{{--  <link href="{{ asset('css/style.css') }}" rel="stylesheet">--}}
{{--  <link href="{{ asset('css/vendors.css') }}" rel="stylesheet">--}}
{{--  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">--}}
{{--  <script src="{{ asset('js/modernizr.js') }}"></script>--}}

  @yield('css')

</head>

<body>
  @yield('messages')
  <div id="page" class="theia-exception">

    <header class="header menu_fixed">
      <div id="preloader">
        <div data-loader="circle-side"></div>
      </div>
      <div id="logo">
        <a href="{{ route('index') }}">
          <img src="{{ asset('images/logo.svg') }}" height="36" alt="logo" class="logo_normal">
          <img src="{{ asset('images/logo-dark.svg') }}" height="36" alt="logo-sticky" class="logo_sticky">
        </a>
      </div>
      <a href="#menu" class="btn_mobile">
        <div class="hamburger hamburger--spin" id="hamburger">
          <div class="hamburger-box">
            <div class="hamburger-inner"></div>
          </div>
        </div>
      </a>
      <nav id="menu" class="main-menu">
        <ul>
          <li> <span><a href="{{ route('index') }}">{{ __('Home') }}</a></span></li>
          <li>
            <span><a href="{{ route('services.index') }}">{{ __('Services') }}</a></span>
            @if(count($share['services']))
            <ul>
              @foreach ($share['services'] as $service)
              <li><a href="{{ route('services.show', $service->slug) }}">{{ $service->title }}</a></li>
              @endforeach
            </ul>
            @endif
          </li>
          <li><span><a href="{{ route('tours.index') }}">{{ __('Tours') }}</a></span></li>
          <li><span><a href="{{ route('turkmenistan.index') }}">{{ __('Turkmenistan') }}</a></span></li>
          <li><span><a href="{{ route('about.index') }}">{{ __('About us') }}</a></span></li>
          <li><span><a href="{{ route('contact.index') }}">{{ __('Contact us') }}</a></span></li>
          <li>
            <span class="locale">
              <i>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="#444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M7.99998 3H8.99998C7.04998 8.84 7.04998 15.16 8.99998 21H7.99998" stroke="#444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M15 3C16.95 8.84 16.95 15.16 15 21" stroke="#444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M3 16V15C8.84 16.95 15.16 16.95 21 15V16" stroke="#444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  <path d="M3 9.0001C8.84 7.0501 15.16 7.0501 21 9.0001" stroke="#444" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </i>
              {{ LaravelLocalization::getCurrentLocaleName() }}</span>
            <ul>
              @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
              <li><a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="{{ $localeCode == app()->getLocale() ? 'd-none' : '' }}">{{ $properties['native'] }}</a></li>
              @endforeach
            </ul>
          </li>
        </ul>
      </nav>
    </header>
    <main>
      @yield('main')
    </main>

    <footer>
      <div class="container margin_60_35">
        <div class="row">
          <div class="col-lg-5 col-md-12 p-r-5">
            <p><img src="{{ asset('images/logo.svg') }}" height="36" alt="logo-footer"></p>
            <div class="follow_us">
              <ul>
                <li>{{ __('Follow us') }}</li><br/>
                @foreach ($share['socials'] as $social)
                <li><a href="{{ $social->data }}" target="_blank"><i>{!! $social->icon !!}</i></a></li>
                @endforeach
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 ml-lg-auto">
            <h5>{{ __('Useful links') }}</h5>
            <ul class="links">
              <li><a href="{{ route('services.index') }}">{{ __('Services') }}</a></li>
              <li><a href="{{ route('tours.index') }}">{{ __('Tours') }}</a></li>
              <li><a href="{{ route('turkmenistan.index') }}">{{ __('Turkmenistan') }}</a></li>
              <li><a href="{{ route('about.index') }}">{{ __('About us') }}</a></li>
              <li><a href="{{ route('contact.index') }}">{{ __('Contact us') }}</a></li>
            </ul>
          </div>
          <div class="col-lg-3 col-md-6">
            <h5>{{ __('Contact with Us') }}</h5>
            <ul class="contacts">
              @foreach ($share['contacts'] as $contact)
              @if($contact->type == 'email')
              <li><a href="mailto:{{ $contact->data }}" target="_blank"><i>{!! $contact->icon !!}</i> {{ $contact->data }}</a></li>
              @endif

              @if($contact->type == 'contact')
              <li><a href="tel://{{ $contact->data }}" target="_blank"><i>{!! $contact->icon !!}</i> {{ $contact->data }}</a></li>
              @endif
              @endforeach

            </ul>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-lg-6"></div>
          <div class="col-lg-6">
            <ul id="additional_links">
              @if ($share['copyright'])
              <li><span>{!! $share['copyright']->locale_data !!}</span></li>
              @endif
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <div id="toTop"></div>

  <script src="{{ asset('js/all.js') }}"></script>
{{--  <script src="{{ asset('js/common_scripts.js') }}"></script>--}}
{{--  <script src="{{ asset('js/main.js') }}"></script>--}}
{{--  <script src="{{ asset('js/assets/validate.js') }}"></script>--}}

  @yield('js')

</body>

</html>