<!DOCTYPE html>
<html lang="en" class="js">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="{{ __('app') }}">
  <meta name="author" content="subo">
  <meta name="csrf-token" content="{{ csrf_token() }}">

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
  <title>@yield('title') | {{ __('app') }}</title>
  <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
  @yield('css')
</head>

<body class="nk-body npc-subscription has-aside ui-clean">
  <div id="messages">
    @include('panel.include.messages')
  </div>
  <div class="nk-app-root">
    <div class="nk-main ">
      <div class="nk-wrap ">
        <div class="nk-header nk-header-fixed is-light">
          <div class="container-lg wide-xl">
            <div class="nk-header-wrap">
              <div class="nk-header-brand">
                <a href="{{ route('index') }}" class="logo-link">
                  {{-- <img class="logo-light logo-img" src="{{ asset('images/logo-light.svg') }}" srcset="{{ asset('images/logo-light-2x.svg 2x') }}" alt="logo"> --}}
                  <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.svg') }}" srcset="{{ asset('images/logo-dark-2x.svg 2x') }}" alt="logo-dark">
                  {{-- <span class="nio-version">Menu</span> --}}
                </a>
              </div>
              <div class="nk-header-tools">

                <ul class="nk-quick-nav">
                  @php $notifications = auth()->user()->unreadNotifications; @endphp
                  <li class="dropdown notification-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="font-size: 25px;">
                      <div class="@if($notifications->count() > 0) icon-status icon-status-info @endif"><em class="icon ni ni-bell"></em></div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      <div class="dropdown-head">
                        <span class="sub-title nk-dropdown-title">Notifications</span>
{{--                        <a href="#">Mark All as Read</a>--}}
                      </div>
                      <div class="dropdown-body">
                        <div class="nk-notification">
                          <div class="d-flex p-4 dropdown-inner flex-column">
                            @forelse($notifications as $notification)

                              <a href="@if($notification->data['request_type'] === 'tour' || $notification->data['request_type'] === 'turkmenistan' )
                                {{ route('panel.tour_requests.index', ['type' => $notification->data['request_type']]) }}"
                                 @else
                                {{ route('panel.service_requests.index', ['type' => $notification->data['request_type']]) }}"
                                 @endif

                                 data-id="{{ $notification->id }}" class="d-flex mark-as-read mb-2">
                                <div class="nk-notification-icon">
                                  <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                </div>
                                <div class="nk-notification-content">
                                  <div class="nk-notification-text">You have requested to <span>{{$notification->data['request_type']}}</span>
                                  </div>
                                  <div class="nk-notification-time">{{$notification->created_at}}</div>
                                </div>
                              </a>
                            @empty
                            @endforelse

                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                  <li class="dropdown user-dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <div class="user-toggle">
                        <div class="user-avatar sm">
                          <em class="icon ni ni-user-alt"></em>
                        </div>
                        <div class="user-name dropdown-indicator d-none d-sm-block">{{ auth()->user()->name }}</div>
                      </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                      <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                        <div class="user-card">
                          <div class="user-avatar">
                            <span><em class="icon ni ni-user-alt"></em></span>
                          </div>
                          <div class="user-info">
                            <span class="lead-text">{{ auth()->user()->name }}</span>
                            <span class="sub-text">{{ auth()->user()->username }}</span>
                          </div>
                          <div class="user-action">
                            <a class="btn btn-icon mr-n2" href="{{ route('panel.profile') }}"><em class="icon ni ni-setting"></em></a>
                          </div>
                        </div>
                      </div>
                      <div class="dropdown-inner">
                        <ul class="link-list">
                          <li><a href="{{ route('panel.profile') }}"><em class="icon ni ni-user-alt"></em><span>{{ __('View profile') }}</span></a></li>
                        </ul>
                      </div>
                      <div class="dropdown-inner">
                        <ul class="link-list">
                          <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                              <em class="icon ni ni-signout"></em><span>{{ __('Log out') }}</span>
                            </a>
                            <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">@csrf</form>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </li>





                  <li class="d-lg-none">
                    <a href="#" class="toggle nk-quick-nav-icon mr-n1" data-target="sideNav"><em class="icon ni ni-menu"></em></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="nk-content">
          <div class="container wide-xl">
            <div class="nk-content-inner">
              <div class="nk-aside" data-content="sideNav" data-toggle-overlay="true" data-toggle-screen="lg" data-toggle-body="true">
                <div class="nk-sidebar-menu" data-simplebar>
                  <ul class="nk-menu">
                    <li class="nk-menu-heading">
                      <h6 class="overline-title">{{ __('Menu') }}</h6>
                    </li>

                    <li class="nk-menu-item">
                      <a href="{{ route('panel.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span><span class="nk-menu-text">{{ __('Dashboard') }}</span>
                      </a>
                    </li>
                    <!-- Pages -->
                    <li class="nk-menu-item has-sub {{request()->is('contact*') || request()->is('covers*') || request()->is('countries*') || request()->is('turkmenistan_index*') || request()->is('tours_index*') || request()->is('banners*') || request()->is('about*') ? 'active' : '' }}">
                      <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-grid-alt-fill"></em></span>
                        <span class="nk-menu-text">{{ __('Pages') }}</span>
                      </a>
                      <ul class="nk-menu-sub" style="display: none;">
                        <li class="nk-menu-item {{ request()->is('banners*') ? 'active' : '' }}">
                          <a href="{{ route('panel.banners.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Banners') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item {{ request()->is('about*') ? 'active' : '' }}">
                          <a href="{{ route('panel.about.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('About us') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item {{ request()->is('contact*') ? 'active' : '' }}">
                          <a href="{{ route('panel.contact.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Contact us') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item {{ request()->is('tours_index*') ? 'active' : '' }}">
                          <a href="{{ route('panel.tours_index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Tours Page') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item {{ request()->is('turkmenistan_index*') ? 'active' : '' }}">
                          <a href="{{ route('panel.turkmenistan_index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Turkmenistan Page') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item {{ request()->is('countries*') ? 'active' : '' }}">
                          <a href="{{ route('panel.countries.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Countries') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item {{ request()->is('covers*') ? 'active' : '' }}">
                          <a href="{{ route('panel.covers.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Covers') }}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <!-- End Pages -->

                    <!-- Services -->
                    <li class="nk-menu-item {{ request()->is('services*') ? 'active' : '' }}">
                      <a href="{{ route('panel.services.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-bag-fill"></em></span>
                        <span class="nk-menu-text">{{ __('Services') }}</span>
                      </a>
                    </li>
                    <!-- End Services -->

                    <!-- Service Requests -->
                    <li class="nk-menu-item has-sub" data-active="{{ (request()->get('type') && (request()->get('type') == 'visa' || request()->get('type') == 'ticket' || request()->get('type') == 'hotel' || request()->get('type') == 'translation')) ? 'active' : '' }}">
                      <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                        <span class="nk-menu-text">{{ __('Service Requests') }}</span>
                      </a>
                      <ul class="nk-menu-sub" style="display: {{ (request()->get('type') && (request()->get('type') == 'visa' || request()->get('type') == 'ticket' || request()->get('type') == 'hotel' || request()->get('type') == 'translation')) ? 'block;' : 'none;' }}">
                        <li class="nk-menu-item" data-active="{{ (request()->get('type') && request()->get('type') == 'visa') ? 'active' : '' }}">
                          <a href="{{ route('panel.service_requests.index', ['type' => 'visa']) }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Visa') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item" data-active="{{ (request()->get('type') && request()->get('type') == 'ticket') ? 'active' : '' }}">
                          <a href="{{ route('panel.service_requests.index', ['type' => 'ticket']) }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Ticket') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item" data-active="{{ (request()->get('type') && request()->get('type') == 'hotel') ? 'active' : '' }}">
                          <a href="{{ route('panel.service_requests.index', ['type' => 'hotel']) }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Hotel') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item" data-active="{{ (request()->get('type') && request()->get('type') == 'translation') ? 'active' : '' }}">
                          <a href="{{ route('panel.service_requests.index', ['type' => 'translation']) }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Translation') }}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <!-- End Service Requests -->

                    <!-- Tours -->
                    <li class="nk-menu-item has-sub" data-active="{{ request()->is('categories*') || (request()->get('type') && (request()->get('type') == 'turkmenistan' || request()->get('type') == 'tour')) ? 'active' : '' }}">
                      <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-article"></em></span>
                        <span class="nk-menu-text">{{ __('Tours') }}</span>
                      </a>
                      <ul class="nk-menu-sub" style="display: {{ request()->is('categories*') || (request()->get('type') && (request()->get('type') == 'turkmenistan' || request()->get('type') == 'tour')) ? 'block;' : 'none;' }}">
                        <li class="nk-menu-item {{ request()->is('categories*') ? 'active' : '' }}">
                          <a href="{{ route('panel.categories.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Categories') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item" data-active="{{ (request()->get('type') && request()->get('type') == 'turkmenistan') ? 'active' : '' }}">
                          <a href="{{ route('panel.tours.index', ['type' => 'turkmenistan']) }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Turkmenistan') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item" data-active="{{ (request()->get('type') && request()->get('type') == 'tour') ? 'active' : '' }}">
                          <a href="{{ route('panel.tours.index', ['type' => 'tour']) }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Tours') }}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <!-- End Tours -->

                    <!-- Requests -->
                    <li class="nk-menu-item has-sub" data-active="{{ request()->get('kind') && (request()->get('kind') == 'turkmenistan' || request()->get('kind') == 'tour') ? 'active' : '' }}">
                      <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-cc-new"></em></span>
                        <span class="nk-menu-text">{{ __('Tour Requests') }}</span>
                      </a>
                      <ul class="nk-menu-sub" style="display: {{ request()->get('kind') && (request()->get('kind') == 'turkmenistan' || request()->get('kind') == 'tour') ? 'block;' : 'none;' }}">
                        <li class="nk-menu-item" data-active="{{ (request()->get('kind') && request()->get('kind') == 'turkmenistan') ? 'active' : '' }}">
                          <a href="{{ route('panel.tour_requests.index', ['kind' => 'turkmenistan']) }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('TM requests') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item" data-active="{{ (request()->get('kind') && request()->get('kind') == 'tour') ? 'active' : '' }}">
                          <a href="{{ route('panel.tour_requests.index', ['kind' => 'tour']) }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Tour requests') }}</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                    <!-- End Requests -->

                    <!-- Requests -->
                    <li class="nk-menu-item has-sub" data-active="{{ request()->is('birthday*')  ||  request()->is('birthday_messages*') }}">
                      <a href="#" class="nk-menu-link nk-menu-toggle">
                        <span class="nk-menu-icon"><em class="icon ni ni-happy"></em></span>
                        <span class="nk-menu-text">{{ __('Birthday') }}</span>
                      </a>

                      <ul class="nk-menu-sub" style="display: {{ request()->is('birthday*')  ||  request()->is('birthday_messages*') }}">
                        <li class="nk-menu-item" data-active="{{ request()->is('birthday*') ? 'active' : '' }}">
                          <a href="{{ route('panel.birthday.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Today Birthday') }}</span>
                          </a>
                        </li>
                        <li class="nk-menu-item" data-active="{{ request()->is('birthday_messages*') ? 'active' : '' }}">
                          <a href="{{ route('panel.birthday_messages.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Client Messages') }}</span>
                          </a>
                        </li>

                      </ul>
                    </li>

                    <li class="nk-menu-item {{ request()->is('clients*') ? 'active' : '' }}">
                      <a href="{{ route('panel.clients.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-user"></em></span><span class="nk-menu-text">{{ __('Clients') }}</span>
                      </a>
                    </li>



                    <li class="nk-menu-item {{ request()->is('subjects*') ? 'active' : '' }}">
                      <a href="{{ route('panel.subjects.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-browser"></em></span><span class="nk-menu-text">{{ __('Subjects') }}</span>
                      </a>
                    </li>
                    <li class="nk-menu-item {{ request()->is('mailing*') ? 'active' : '' }}">
                      <a href="{{ route('panel.mailing.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-emails"></em></span><span class="nk-menu-text">{{ __('Mailing') }}</span>
                      </a>
                    </li>

                    <li class="nk-menu-item {{ request()->is('messages*') ? 'active' : '' }}">
                      <a href="{{ route('panel.messages.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-msg"></em></span><span class="nk-menu-text">{{ __('Messages') }}</span>
                      </a>
                    </li>

                    <li class="nk-menu-item {{ request()->is('emails*') ? 'active' : '' }}">
                      <a href="{{ route('panel.emails.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-emails-fill"></em></span><span class="nk-menu-text">{{ __('Emails') }}</span>
                      </a>
                    </li>



                    <li class="nk-menu-item {{ request()->is('privacy*') ? 'active' : '' }}">
                      <a href="{{ route('panel.privacy.index') }}" class="nk-menu-link">
                        <span class="nk-menu-icon"><em class="icon ni ni-policy"></em></span><span class="nk-menu-text">{{ __('Privacy Policy') }}</span>
                      </a>
                    </li>

                    <li class="nk-menu-heading">
                      <h6 class="overline-title">{{ __('Languages') }}</h6>
                    </li>
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if($localeCode == app()->getLocale())
                    <li class="nk-menu-item active">
                      <span class="nk-menu-link"><span class="nk-menu-text">{{ $properties['native'] }}</span></span>
                    </li>
                    @else
                    <li class="nk-menu-item">
                      <a hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="nk-menu-link">
                        <span class="nk-menu-text">{{ $properties['native'] }}</span>
                      </a>
                    </li>
                    @endif
                    @endforeach
                  </ul>
                </div>
                <div class="nk-aside-close"><a href="#" class="toggle" data-target="sideNav"><em class="icon ni ni-cross"></em></a></div>
              </div>
              <div class="nk-content-body">
                <div class="nk-content-wrap">
                  @yield('content')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('js/bundle.js') }}"></script>
  <script src="{{ asset('js/scripts.js') }}"></script>
  <script>
    function sendMarkRequest(id = null) {
      return $.ajax("{{ route('panel.admin.markNotification') }}", {
        method: 'POST',
        data: {
          _token: "{{ csrf_token() }}",
          id
        }
      });
    }

    (function() {
      'use strict';
      window.addEventListener('load', function() {
        let forms = document.getElementsByClassName('needs-validation');
        Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();

    $(function() {

      $('.mark-as-read').click(function(e) {
        e.preventDefault();
        let href = this.href;
        let request = sendMarkRequest($(this).data('id'));
        window.location = href;
      });

      @if($errors->any() || session('success') || session('error') || session('warning') || session('danger'))
      setTimeout(function() {
        $('#messages').fadeOut('slow');
      }, 5000);
      @endif

      @if(!request()->is(app()->getLocale()))
      $(function() {
        $('.nk-menu-item').first().removeClass('active', 'current-page')
      });
      @endif

      $('.nk-menu-item[data-active=active]').addClass('active');
    });
  </script>

  @yield('js')

</body>

</html>