@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Birthday Messages')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Birthday Messages') }}</h2>
    </div>
    <ul class="nk-block-tools gx-3">
      <li>
        <a data-toggle="modal" data-target="#add" class="btn btn-white btn-dim btn-outline-primary">
          <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Add Birthday Message') }}</span>
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
          <th>{{ __('En') }}</th>
          <th>{{ __('Ru') }}</th>
          <th>{{ __('Tm') }}</th>
          <th>{{ __('Zh') }}</th>
          <th>{{ __("Action") }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $message)
          <tr class="tb-tnx-item">
            <td>{{ $message->id }}</td>
            <td>{{ $message->name }}</td>
            <td>{{ $message->en }}</td>
            <td>{{ $message->ru }}</td>
            <td>{{ $message->tm }}</td>
            <td>{{ $message->zh }}</td>
            <td class="tb-col-action">
              <a href="{{ route('panel.birthday_messages.edit', $message->id) }}"
                 class="link-cross d-inline-bl  ock link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>

              <a href="#"
                 onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $message->id }}').submit(); }"
                 class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
              <form action="{{ route('panel.birthday_messages.destroy', $message->id) }}" method="post"
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
  <p>{{ __('not exist', ['thing' => __('Birthday Messages')]) }}</p>
  @endif
</div>

<div class="modal fade show" tabindex="-1" role="dialog" id="add">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
      <div class="modal-body modal-body-lg">
        <h5 class="title">{{ __('Add Birthday Message') }}</h5>
        <form action="{{ route('panel.birthday_messages.store') }}" method="POST">
          @csrf

          <div class="form-group">
            <label class="form-label" for="name">{{ __('Name') }}</label>
            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="username" name="name"  required>
            @error ('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="tm">{{ __('TM') }}</label>
            <textarea class="form-control form-control-lg @error('tm') is-invalid @enderror" id="tm" name="tm" required></textarea>
            @error ('tm')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="ru">{{ __('RU') }}</label>
            <textarea class="form-control form-control-lg @error('ru') is-invalid @enderror" id="ru" name="ru" required></textarea>
            @error ('ru')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="en">{{ __('EN') }}</label>
            <textarea class="form-control form-control-lg @error('en') is-invalid @enderror" id="en" name="en" required></textarea>
            @error ('en')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>

          <div class="form-group">
            <label class="form-label" for="zh">{{ __('ZH') }}</label>
            <textarea class="form-control form-control-lg @error('zh') is-invalid @enderror" id="zh" name="zh" required></textarea>
            @error ('zh')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
          </div>




          <div class="col-12 mt-5">
            <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
              <li>
                <button class="btn btn-lg btn-primary">{{ __('Set new Mailing') }}</button>
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