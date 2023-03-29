@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Subject')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Subjects') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a href="{{ route('panel.messages.index') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-msg"></em><span class="d-none d-sm-inline-block">{{ __('Messages') }}</span>
          </a>
        </li>
        <li>
          <a href="{{ route('panel.subjects.create') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Create new') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($subjects))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('Title') }}</th>
          <th>{{ __('Message qty') }}</th>
          <th>{{ __('Email') }}</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach($subjects as $subject)
        <tr class="tb-tnx-item">
          <td>{{ $subject->title }}</td>
          <td>{{ $subject->messages()->count() }}</td>
          <td>{{ $subject->email }}</td>
          <td class="tb-col-action">
            <a href="{{ route('panel.subjects.edit', $subject->id) }}" class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>

            <a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $subject->id }}').submit(); }" class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
            <form action="{{ route('panel.subjects.destroy', $subject->id) }}" method="post" id="destroy-{{ $subject->id }}">
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
  <p>{{ __('not exist', ['thing' => __('Subject')]) }}</p>
  @endif
</div>

@endsection
@section('js')
<script>
  @if(request()->is('*subjects*'))
    $(function () {
      $('.nk-nav .nav-item').first().addClass('active', 'current-page')
    });
  @endif
</script>
@endsection