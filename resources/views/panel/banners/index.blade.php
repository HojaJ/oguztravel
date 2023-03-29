@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Banner')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Banners') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        @if(count($banners) > 1)
        <li>
          <a href="{{ route('panel.banners.order.form') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-list"></em><span class="d-none d-sm-inline-block">{{ __('Ordering') }}</span>
          </a>
        </li>
        @endif
        <li>
          <a href="{{ route('panel.banners.create') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Create new') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($banners))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('Image') }}</th>
          <th>{{ __('Title') }}</th>
          <th>{{ __('Subtitle') }}</th>
          <th>{{ __('Link') }}</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach($banners as $banner)
        <tr class="tb-tnx-item">
          <td><a href="{{ $banner->getImage() }}" target="_blank"><img src="{{ $banner->getImage() }}" alt="banner-{{ $banner->id }}" style="height: 70px;"></a></td>
          <td>{{ $banner->title }}</td>
          <td>{{ $banner->subtitle }}</td>
          <td><a href="{{ $banner->link }}" target="_blank">{{ $banner->link }}</a></td>
          <td class="tb-col-action">
            <a href="{{ route('panel.banners.edit', $banner->id) }}" class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>

            <a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $banner->id }}').submit(); }" class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
            <form action="{{ route('panel.banners.destroy', $banner->id) }}" method="post" id="destroy-{{ $banner->id }}">
              @method('delete')
              @csrf
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p>{{ __('not exist', ['thing' => __('Banner')]) }}</p>
  @endif
</div>

@endsection
@section('js')
<script>
  @if(request()->is('*banners*'))
    $(function () {
      $('.nk-nav .nav-item').first().addClass('active', 'current-page')
    });
  @endif
</script>
@endsection