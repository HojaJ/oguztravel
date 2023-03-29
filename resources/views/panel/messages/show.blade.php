@extends('layouts.panel')

@section('title') {{ $message->subject ? $message->subject->title : $message->email }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-head-sub"><span>{{ __('Message') }}</span></div>
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ $message->subject ? $message->subject->title : $message->email }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a href="#" class="btn btn-white btn-dim btn-outline-danger" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $message->id }}').submit(); }">
            <em class="icon ni ni-trash"></em><span class="d-none d-sm-inline-block">{{ __('Delete') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
<form action="{{ route('panel.messages.destroy', $message->id) }}" method="post" id="destroy-{{ $message->id }}">
  @method('delete')
  @csrf
</form>

<div class="card card-bordered mb-4">
  <div class="nk-data data-list">
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Name') }}</span>
        <span class="data-value">{{ $message->name }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Surname') }}</span>
        <span class="data-value">{{ $message->surname }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Email') }}</span>
        <span class="data-value"><a href="mailto:{{ $message->email }}" target="_blank">{{ $message->email }}</a></span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Phone') }}</span>
        <span class="data-value"><a href="tel:{{ $message->phone }}" target="_blank">{{ $message->phone }}</a></span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Subject') }}</span>
        <span class="data-value">{{ $message->subject->title }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
    <div class="data-item">
      <div class="data-col">
        <span class="data-label">{{ __('Message') }}</span>
        <span class="data-value">{{ $message->message }}</span>
      </div>
      <div class="data-col data-col-end"></div>
    </div>
  </div>
</div>
@endsection