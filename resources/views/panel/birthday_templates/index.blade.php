@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Birthday Template')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Birthday Template') }}</h2>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($messages))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('Name') }}</th>
          <th>{{ __('Lang') }}</th>
          <th>{{ __('Content') }}</th>
          <th>{{ __("Action") }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $message)
          <tr class="tb-tnx-item">
            <td>{{ $message->name }}</td>
            <td>{{ $message->lang }}</td>
            <td>{{ $message->content }}</td>
            <td class="tb-col-action">
              <a href="{{ route('panel.birthday_messages_show', $message->id) }}"
                 class="link-cross d-inline-bl  ock link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>
            </td>
          </tr>
        @endforeach
        <tr class="tb-tnx-item">
          <td>{{ $email->name }}</td>
          <td>{{ $email->lang }}</td>
          <td></td>
          <td class="tb-col-action">
            <a target="_blank" href="{{ route('panel.emails.edit', $email->id) }}"
               class="link-cross d-inline-bl  ock link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  @else
  <p>{{ __('not exist', ['thing' => __('Birthday Template')]) }}</p>
  @endif
</div>

@endsection