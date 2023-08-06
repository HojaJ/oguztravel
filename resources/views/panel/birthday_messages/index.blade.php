@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Birthday Messages')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('SMS Template') }}</h2>
    </div>
    <ul class="nk-block-tools gx-3">
      <li>
        <a data-toggle="modal" data-target="#add" class="btn btn-white btn-dim btn-outline-primary">
          <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Add SMS Template') }}</span>
        </a>
      </li>
    </ul>
  </div>
</div>

<div class="nk-block">
  @if (count($messages))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('ID') }}</th>
          <th>{{ __('Name') }}</th>
          <th>{{ __('Lang') }}</th>
          <th>{{ __('Content') }}</th>
          <th>{{ __("Action") }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $message)
          <tr class="tb-tnx-item">
            <td>{{ $message->id }}</td>
            <td>{{ $message->name }}</td>
            <td>{{ $message->lang }}</td>
            <td>{{ $message->content }}</td>
            <td class="tb-col-action">
              <a href="{{ route('panel.sms_messages.edit', $message->id) }}"
                 class="link-cross d-inline-bl  ock link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>

              <a href="#"
                 onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $message->id }}').submit(); }"
                 class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
              <form action="{{ route('panel.sms_messages.destroy', $message->id) }}" method="post"
                    id="destroy-{{ $message->id }}">
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
  <p>{{ __('not exist', ['thing' => __('SMS Template')]) }}</p>
  @endif
</div>

<div class="modal fade show" tabindex="-1" role="dialog" id="add">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
      <div class="modal-body modal-body-lg">
        <h5 class="title">{{ __('Add SMS Template') }}</h5>
        <form action="{{ route('panel.sms_messages.store') }}" method="POST">
          @csrf

          <div class="form-group">
            <label class="form-label" for="name">{{ __('Name') }}</label>
            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="username" name="name"  required>
            @error ('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="content">{{ __('Language') }}</label>
            <select  class="form-control form-control-lg @error('lang') is-invalid @enderror" name="lang" id="lang" required>
              <option value="tm">Tm</option>
              <option value="ru">Ru</option>
              <option value="en">En</option>
              <option value="zh">Zh</option>
            </select>
            @error ('lang')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>


          <div class="form-group">
            <label class="form-label" for="content">{{ __('Content') }}</label>
            <textarea class="form-control form-control-lg @error('content') is-invalid @enderror" id="zh" name="content" required></textarea>
            @error ('content')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>


          <div class="col-12 mt-5">
            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
              <li>
                <button class="btn btn-lg btn-primary">{{ __('Add SMS Template') }}</button>
              </li>
              <li>
                <a href="#" data-dismiss="modal" class="link link-light">{{ __('Cancel') }}</a>
              </li>
            </ul>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection