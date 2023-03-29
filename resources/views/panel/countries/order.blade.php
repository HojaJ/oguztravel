@extends('layouts.panel')

@section('title') {{ __('Ordering thing', ['name' => __('Banner')]) }} @endsection

@section('css')
<link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
<style>
  #sortable {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: 60%;
  }

  #sortable li {
    margin: 0 3px 3px 3px;
    padding: 0.4em 0.4em 0.4em 0;
    float: unset;
    text-align: left;
    cursor: grabbing;
  }
</style>
@endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Ordering'), 'title' => __('Banner')]])

<h5 class="title">{{ __('Ordering') }}</h5>
<form action="{{ route('panel.banners.order') }}" method="post" class="needs-validation mt-4" novalidate>
  @csrf
  <ul id="sortable" class="mb-5">
    @foreach($banners as $banner)
    <li>
      <span class="sort-icon mr-2"><em class="icon ni ni-grid-sq"></em></span>
      <img src="{{ $banner->getImage() }}" alt="{{ $banner->id }}" height="100px" class="mr-2">
      <span>{{ $banner->title }}</span>
      <input type="hidden" name="ids[]" value="{{ $banner->id }}">
    </li>
    @endforeach
  </ul>
  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection

@section('js')
<script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>
<script>
  $(function () {
    let sortable = $("#sortable");

    sortable.sortable();
    sortable.disableSelection();
  });
</script>
@endsection