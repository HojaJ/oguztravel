@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Message')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Messages') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a href="{{ route('panel.subjects.index') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-browser"></em><span class="d-none d-sm-inline-block">{{ __('Subjects') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($messages))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('Subject') }}</th>
          <th>{{ __('Name') }}</th>
          <th>{{ __('Surname') }}</th>
          <th>{{ __('Email') }}</th>
          <th>{{ __('Phone') }}</th>
          <th>{{ __('Date') }}</th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $message)
        <tr class="tb-tnx-item">
          <td>
            @if ($message->is_read)
            {{ $message->subject->title }}
            @else
            <strong>{{ $message->subject->title }}</strong>
            @endif
          </td>
          <td>
            @if ($message->is_read)
            {{ $message->name }}</td>
            @else
            <strong>{{ $message->name }}</strong>
            @endif
          <td>{{ $message->surname }}</td>
          <td><a href="mailto:{{ $message->email }}" target="_blank">{{ $message->email }}</a></td>
          <td><a href="tel:{{ $message->phone }}" target="_blank">{{ $message->phone }}</a></td>
          <td>{{ $message->created_at }}</td>
          <td class="tb-col-action">
            <a href="{{ route('panel.messages.show', $message->id) }}" class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-eye"></em></a>
            <a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $message->id }}').submit(); }" class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
            <form action="{{ route('panel.messages.destroy', $message->id) }}" method="post" id="destroy-{{ $message->id }}">
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
  <p>{{ __('not exist', ['thing' => __('Message')]) }}</p>
  @endif
</div>

@endsection
@section('js')
<script>
  @if(request()->is('*messages*'))
    $(function () {
      $('.nk-nav .nav-item').first().addClass('active', 'current-page')
    });
  @endif
</script>
@endsection