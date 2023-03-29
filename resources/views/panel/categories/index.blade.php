@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Category')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-head-sub"><span>{{ __('All') }}</span></div>
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Categories') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a href="{{ route('panel.categories.create') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Create new') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($categories))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          @foreach(LaravelLocalization::getSupportedLocales() as $properties)
          <th>{{ $properties['native'] }}</th>
          @endforeach
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach($categories as $category)
        <tr class="tb-tnx-item">
          @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
          <td>{{ $category->getTranslation('name', $locale) }}</td>
          @endforeach
          <td class="tb-col-action">
            <span class="mr-1"><a href="{{ route('panel.categories.edit', $category->id) }}" class="link-cross link-edit mr-sm-n1"><em class="icon ni ni-edit-alt"></em></a></span>
            <span><a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $category->id }}').submit(); }" class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a></span>
            <form action="{{ route('panel.categories.destroy', $category->id) }}" method="post" id="destroy-{{ $category->id }}">
              @method('delete')
              @csrf
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  @include('panel.include.paginate', ['data' => ['items' => $categories, 'limit' => $page_limit]])
  @else
  <p>{{ __('not exist', ['thing' => __('Category')]) }}</p>
  @endif
</div>

@endsection