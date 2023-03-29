@extends('layouts.panel')

@section('title')
  {{ __('index page', ['name' => __('Country')]) }}
@endsection

@section('content')
  <div class="nk-block-head nk-block-head-sm mt-4">
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h2 class="nk-block-title fw-normal">{{ __('Countries') }}</h2>
      </div>
      <div class="nk-block-head-content">
        <ul class="nk-block-tools gx-3">
          <li>
            <a href="{{ route('panel.countries.create') }}" class="btn btn-white btn-dim btn-outline-primary">
              <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Create new') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="nk-block">
    <form action="{{ route('panel.countries.index') }}" method="GET">
      <div class="input-group mb-3">
        <input type="text" class="form-control" name="q" value="{{ $q ?? $q }}"
          placeholder="{{ __('Country name') }}" aria-label="{{ __('Country name') }}" aria-describedby="form-query">
        <button type="submit" id="form-query" class="btn btn-primary">{{ __('Search') }}</button>
      </div>
    </form>

    @if (count($countries))
      <div class="card card-bordered mb-5">
        <table class="table">
          <thead>
            <tr class="tb-tnx-head">
              @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <th>{{ $properties['native'] }}</th>
              @endforeach
              <th>{{ __('Status') }}</th>
              <th>{{ __('Action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($countries as $country)
              <tr class="tb-tnx-item">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                  <td>{{ $country->getTranslation('name', $localeCode) }}</td>
                @endforeach

                <td>
                  @if ($country->is_active)
                    <span class="text-success">{{ __('Active') }}</span>
                  @else
                    <span class="text-danger">{{ __('Not active') }}</span>
                  @endif
                </td>
                <td class="tb-col-action">
                  <a href="{{ route('panel.countries.edit', $country->id) }}"
                    class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>

                  <a href="#"
                    onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $country->id }}').submit(); }"
                    class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
                  <form action="{{ route('panel.countries.destroy', $country->id) }}" method="post"
                    id="destroy-{{ $country->id }}">
                    @method('delete')
                    @csrf
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      @include('panel.include.paginate', ['data' => ['items' => $countries, 'limit' => $page_limit]])
    @else
      <p>{{ __('not exist', ['thing' => __('Country')]) }}</p>
    @endif
  </div>
@endsection

@section('js')
  <script>
    @if (request()->is('*countries*'))
      $(function() {
        $('.nk-nav .nav-item').first().addClass('active', 'current-page')
      });
    @endif
  </script>
@endsection
