@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('About us')]) }} @endsection

@section('css')
<style>
  .occ {
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
    -o-object-position: center;
    object-position: center;
  }

  .galleries .iw-half {
    position: relative;
    height: 300px;
  }

  .galleries .iw-half {
    margin-bottom: 30px;
    overflow: hidden;
  }

  .buttons {
    position: absolute;
    top: 7px;
    right: 22px;
  }
</style>
@endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('About us') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        @if ($about)
        @if($about->images()->count() > 1)
        <li>
          <a href="{{ route('panel.about.images.order', $about->id) }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-list"></em><span class="d-none d-sm-inline-block">{{ __('Ordering') }}</span>
          </a>
        </li>
        @endif
        <li>
          <a href="{{ route('panel.about.images.create', $about->id) }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-image"></em><span class="d-none d-sm-inline-block">{{ __('Add image') }}</span>
          </a>
        </li>
        <li>
          <a href="{{ route('panel.about.edit', $about->id) }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">{{ __('Edit') }}</span>
          </a>
        </li>
        <li>
          <a href="#" class="btn btn-white btn-dim btn-outline-danger" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $about->id }}').submit(); }">
            <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">{{ __('Delete') }}</span>
          </a>
        </li>
        <form action="{{ route('panel.about.destroy', $about->id) }}" method="post" id="destroy-{{ $about->id }}">
          @method('delete')
          @csrf
        </form>
        @else
        <li>
          <a href="{{ route('panel.about.create') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Create new') }}</span>
          </a>
        </li>
        @endif
      </ul>
    </div>
  </div>
</div>

<div class="nk-block">
  @if ($about)
  <div class="row galleries">
    @foreach($about->imagesOrderBy() as $image)
    <div class="col-md-6">
      <div class="iw-half">
        <img src="{{ $image->getImage() }}" alt="image-{{ $image->id }}" class="occ">
        <div class="buttons">
          <form action="{{ route('panel.about.images.destroy', $image->id) }}" method="post" id="delete-image-{{ $image->id }}" class="change-type-form d-inline-block">
            @csrf
            @method('delete')
            <a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('delete-image-{{ $image->id }}').submit(); }" class="btn btn-sm btn-white btn-dim btn-outline-danger" title="{{ __('delete') }}">
              <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">{{ __('Delete') }}</span>
            </a>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <h5>{{ __('Title') }}</h5>
  <div class="card card-bordered mb-4">
    <div class="px-3 pb-4">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="mt-2">
        <strong>{{ $properties['native'] }}:</strong> {{ $about->getTranslation('title', $localeCode) }}
      </div>
      @endforeach
    </div>
  </div>
  <h5>{{ __('Subtitle') }}</h5>
  <div class="card card-bordered mb-4">
    <div class="px-3 pb-4">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="mt-2">
        <strong>{{ $properties['native'] }}:</strong> {{ $about->getTranslation('subtitle', $localeCode) }}
      </div>
      @endforeach
    </div>
  </div>
  <h5>{{ __('Description') }}</h5>
  <div class="card card-bordered mb-4">
    <div class="px-3 pb-4">
      @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
      <div class="mt-4"><strong>{{ $properties['native'] }}</strong></div>
      {!! $about->getTranslation('desc', $localeCode) !!}
      @endforeach
    </div>
  </div>

  @else
  <p>{{ __('not exist', ['thing' => __('About us')]) }}</p>
  @endif
</div>

@endsection