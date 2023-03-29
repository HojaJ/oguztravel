@extends('layouts.panel')

@section('title') {{ __('Add image') }} @endsection

@section('css')
<style>
  .tag-remove {
    padding: 0;
    line-height: 1.1;
    border: none;
    margin-top: 10px;
  }
</style>
@endsection

@section('content')
@include('panel.include.block-header.min', ['data' => ['sub' => __('Add image'), 'title' => 'About us']])

<form action="{{ route('panel.about.images.store', $about->id) }}" class="form-contact needs-validation" method="POST" enctype="multipart/form-data" novalidate>
  @csrf
  <div class="text-right mb-2">
    <button type="button" id="add-more" class="btn btn-white btn-dim btn-outline-primary"><em class="icon ni ni-plus-c"></em><span class="d-none d-sm-inline-block">{{ __('Add more image') }}</span></button>
  </div>

  <div class="row append">
    <div class="col-md-6 copy">
      <div class="form-group">
        <label for="images" class="form-label">
          {{ __('Image') }} <span class="text-danger">*</span>
          <span class="fs-9px btn btn-white btn-dim btn-outline-danger tag-remove"><em class="icon ni ni-cross-c"></em></span>
        </label>
        <div class="input-group mb-3">
          <input type="file" name="images[]" id="image" class="form-control " required="">
          @if ($errors->has('images'))
          <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('images') }}</strong></span>
          @else
          <span class="invalid-feedback" role="alert"><strong>{{ __('Field required') }}</strong></span>
          @endif
        </div>
      </div>
    </div>
  </div>

  <button class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection

@section('js')
<script>
  $(function() {
    $(".tag-remove").click(function() {
      $(this).parents('.copy').remove();
    });

    let cloneDiv = $('.copy').clone(true);

    $('#add-more').click(function () {
      $('.append').append(cloneDiv.clone(true));
    });

    $(".tag-remove").remove();
  });
</script>
@endsection