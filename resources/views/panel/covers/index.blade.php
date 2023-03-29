@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Cover')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Cover') }}</h2>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($covers))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('Image') }}</th>
          <th></th>
          <th>{{ __('Name') }}</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($covers as $cover)
        <tr>
          <td>
            @if ($cover->filename)
            <a href="{{ $cover->getImage() }}" target="_blank"><img src="{{ $cover->getImage() }}" alt="cover-{{ $cover->id }}" style="height: 70px;"></a>
            @endif
          </td>
          <td>
            @if($cover->is_active)
            <span class="text-success">{{ __('Active') }}</span>
            @else
            <span class="text-danger">{{ __('Not active') }}</span>
            @endif
          </td>
          <td>{{ __(ucwords($cover->slug)) }}</td>
          <td>
            <a href="{{ route('panel.covers.edit', $cover->id) }}" class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p>{{ __('not exist', ['thing' => __('covers')]) }}</p>
  @endif
</div>
@endsection