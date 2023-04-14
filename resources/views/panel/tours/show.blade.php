@extends('layouts.panel')

@section('title') {{ $tour->title }}@endsection

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
  <div class="nk-block-head-sub"><span>{{ __(ucfirst($type)) }}</span></div>
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ $tour->title }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        @if($tour->images()->count() > 1)
        <li>
          <a href="{{ route('panel.tours.images.order', ['tour' => $tour->id, 'type' => $type]) }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-list"></em><span class="d-none d-sm-inline-block">{{ __('Ordering') }}</span>
          </a>
        </li>
        @endif
        <li>
          <a href="{{ route('panel.tours.images.create', ['tour' => $tour->id, 'type' => $type]) }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-image"></em><span class="d-none d-sm-inline-block">{{ __('Add image') }}</span>
          </a>
        </li>
        <li>
          <a href="{{ route('panel.tours.edit', ['tour' => $tour->id, 'type' => $type]) }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit-alt"></em><span class="d-none d-sm-inline-block">{{ __('Edit') }}</span>
          </a>
        </li>
        <li>
          <a href="#" class="btn btn-white btn-dim btn-outline-danger" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $tour->id }}').submit(); }">
            <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">{{ __('Delete') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<form action="{{ route('panel.tours.destroy', ['tour' => $tour->id, 'type' => $type]) }}" method="post" id="destroy-{{ $tour->id }}">
  @method('delete')
  @csrf
</form>

<div class="card card-bordered mb-4">
  <div class="nk-data data-list">
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Title') }}</span>
        <span class="data-value">
          @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
          <em>{{ $properties['native'] }}:</em> {{ $tour->getTranslation('title', $locale) }} <br>
          @endforeach
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Description') }}</span>
        <span class="data-value">
          @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
          <em class="d-block @if($locale == 'tm') mt-3 @endif">{{ $properties['native'] }}:</em>
          {!! $tour->getTranslation('description', $locale) !!}
          @endforeach
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Include / Exclude') }}</span>
        <span class="data-value">
          @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
          <em class="d-block @if($locale == 'tm') mt-3 @endif">{{ $properties['native'] }}:</em>
          {!! $tour->getTranslation('include', $locale) !!}
          @endforeach
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Details') }}</span>
        <span class="data-value">
          @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
          <em class="d-block @if($locale == 'tm') mt-3 @endif">{{ $properties['native'] }}:</em>
          {!! $tour->getTranslation('details', $locale) !!}
          @endforeach
        </span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Category') }}</span>
        <span class="data-value">{{ $tour->category->name }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Bound') }}</span>
        <span class="data-value">{{ $tour->bound }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
  </div>
</div>

<div class="row galleries">
  @foreach($tour->imagesOrderBy() as $image)
  <div class="col-md-6">
    <div class="iw-half">
      <img src="{{ $image->getImage() }}" alt="image-{{ $image->id }}" class="occ">
      <div class="buttons">
        <form action="{{ route('panel.tours.images.destroy', ['image' => $image->id, 'type' => $type]) }}" method="post" id="delete-image-{{ $image->id }}" class="change-type-form d-inline-block">
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
@endsection