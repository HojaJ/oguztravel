@extends('layouts.panel')

@section('title') {{ __('Ordering thing', ['name' => trans('About image')]) }} @endsection

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
@include('panel.include.block-header.min', ['data' => ['sub' => __('Ordering thing', ['name' => __($about->page)]), 'title' => $about->name]])

<h5 class="title">{{ __('Ordering') }}</h5>
<form action="{{ route('panel.about.images.order.update', $about->id) }}" method="post" class="needs-validation mt-4" novalidate>
  @csrf
  @method('patch')
  <ul id="sortable" class="mb-5">
    @foreach($images as $image)
    <li>
      <span class="sort-icon mr-2"><em class="icon ni ni-grid-sq"></em></span>
      <img src="{{ $image->getImage() }}" alt="{{ $image->id }}" height="100px" class="mr-2">
      <input type="hidden" name="ids[]" value="{{ $image->id }}">
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