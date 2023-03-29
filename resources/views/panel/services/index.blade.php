@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Services')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Services') }}</h2>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($services))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('Image') }}</th>
          <th></th>
          <th>{{ __('Title') }}</th>
          <th>{{ __('Subtitle') }}</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($services as $service)
        <tr>
          <td>
            @if ($service->filename)
            <a href="{{ $service->getImage() }}" target="_blank"><img src="{{ $service->getImage() }}" alt="service-{{ $service->id }}" style="height: 70px;"></a>
            @endif
          </td>
          <td>
            @if($service->is_active)
            <span class="text-success">{{ __('Active') }}</span>
            @else
            <span class="text-danger">{{ __('Not active') }}</span>
            @endif
          </td>
          <td>{{ $service->title }}</td>
          <td>{{ $service->subtitle }}</td>
          <td>
            <a href="{{ route('panel.services.edit', $service->id) }}" class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p>{{ __('not exist', ['thing' => __('Services')]) }}</p>
  @endif
</div>
@endsection