@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('History')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('History') }}</h2>
    </div>
{{--    <ul class="nk-block-tools gx-3">--}}
{{--      <li>--}}
{{--        <a data-toggle="modal" data-target="#add" class="btn btn-white btn-dim btn-outline-primary">--}}
{{--          <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Add SMS Template') }}</span>--}}
{{--        </a>--}}
{{--      </li>--}}
{{--    </ul>--}}
  </div>
</div>

<div class="nk-block">
  @if (count($messages))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('ID') }}</th>
          <th>{{ __('Phone') }}</th>
          <th>{{ __('Type') }}</th>
          <th>{{ __('Content') }}</th>
          <th>{{ __('Date') }}</th>
{{--          <th>{{ __("Action") }}</th>--}}
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $message)
          <tr class="tb-tnx-item">
            <td>{{ $message->id }}</td>
            <td>{{ $message->to }}</td>
            <td>{{ $message->type }}</td>
            <td>{!!  $message->content !!}</td>
            <td>{{ $message->sent_time }}</td>
{{--            <td class="tb-col-action">--}}
{{--              <a href="{{ route('panel.sms_messages.edit', $message->id) }}"--}}
{{--                 class="link-cross d-inline-bl  ock link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>--}}

{{--              <a href="#"--}}
{{--                 onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $message->id }}').submit(); }"--}}
{{--                 class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>--}}
{{--              <form action="{{ route('panel.sms_messages.destroy', $message->id) }}" method="post"--}}
{{--                    id="destroy-{{ $message->id }}">--}}
{{--                @method('delete')--}}
{{--                @csrf--}}
{{--              </form>--}}
{{--            </td>--}}
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
    @include('panel.include.paginate', ['data' => ['items' => $messages, 'limit' => 30]])
  @else
  <p>{{ __('not exist', ['thing' => __('SMS Template')]) }}</p>
  @endif
</div>
@endsection