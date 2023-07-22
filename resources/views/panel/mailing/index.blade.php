@extends('layouts.panel')

@section('title')
  {{ __('index page', ['name' => __('Mailing')]) }}
@endsection

@section('content')
  <div class="nk-block-head nk-block-head-sm mt-4">
    <div class="nk-block-between-md g-4">
      <div class="nk-block-head-content">
        <h2 class="nk-block-title fw-normal">{{ __('Mailing') }}</h2>
      </div>
      <div class="nk-block-head-content">
        <ul class="nk-block-tools gx-3">
          <li>
            <a data-toggle="modal" data-target="#add" class="btn btn-white btn-dim btn-outline-primary">
              <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Set new Mailing') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="nk-block">
    @if (count($mailings))
      <div class="card card-bordered mb-5">
        <table class="table">
          <thead>
            <tr class="tb-tnx-head">
              <th>{{ __('Name') }}</th>
              <th>{{ __('Type') }}</th>
              <th>{{ __('Message') }}</th>
              <th>{{ __('Emails') }}</th>
              <th>{{ __('Category') }}</th>
              <th>{{ __('Status') }}</th>
              <th>{{ __('Action') }}</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mailings as $mailing)
              <tr class="tb-tnx-item">
                <td>{{ $mailing->name }}</td>
                <td>{{ $mailing->type }}</td>
                <td>{{ $mailing->message }}</td>
                <td>
                  {{ $mailing->email->id }} {{ $mailing->email->name }}
                </td>
                <td>{{ $mailing->category }}</td>
                <td>
                  @if($mailing->status)
                    Sent
                  @else
                    <form id="start"  method="post" action="{{ route('panel.mailing.start',$mailing->id) }}">
                      @csrf
                      <input name="mailing_id" type="hidden" value="{{$mailing->id}}">
                      <button type="submit" class="btn-warning btn-sm">Start</button>
                    </form>
                  @endif
                </td>
                <td class="tb-col-action">
                  <a href="#"
                    onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $mailing->id }}').submit(); }"
                    class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
                  <form action="{{ route('panel.mailing.destroy', $mailing->id) }}" method="post"
                    id="destroy-{{ $mailing->id }}">
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
      <p>{{ __('not exist', ['thing' => __('Mailing')]) }}</p>
    @endif
  </div>

  <div class="modal fade show" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
        <div class="modal-body modal-body-lg">
          <h5 class="title">{{ __('Set new Mailing') }}</h5>
          <form action="{{ route('panel.mailing.store') }}" method="POST">
            @csrf

              <div class="form-group">
                <label class="form-label" for="name">{{ __('Name') }}</label>
                <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" id="username" name="name"  required>
                @error ('name')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
              </div>

            <div class="form-group">
              <label class="form-label" for="type">{{ __('Select type') }}</label>
              <select id="type" class="form-control form-control-lg @error('type') is-invalid @enderror" name="type" required>
                <option value="email">Email</option>
                <option value="sms">SMS</option>
              </select>
              @error ('type')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>


            <div class="form-group">
              <label class="form-label" for="message">{{ __('Message') }}</label>
              <textarea class="form-control form-control-lg @error('name') is-invalid @enderror" id="message" name="message" required></textarea>
              @error ('message')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>

            <div class="form-group">
                  <label class="form-label" for="email_design">{{ __('Select email design') }}</label>
                  <select class="form-control form-control-lg @error('email_design') is-invalid @enderror" name="mail" required>
                    @foreach($emails as $email)
                      <option value="{{$email->id}}">{{$email->id}} {{$email->name}}</option>
                    @endforeach
                  </select>
                  @error ('email_design')
                  <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                  @enderror
              </div>

            <div class="form-group">
              <label class="form-label" for="client_type">{{ __('Select Client Type') }}</label>
              <select class="form-control form-control-lg @error('client_type') is-invalid @enderror" name="client_type" required>
                <option value="all">All</option>
                <option value="female">Female</option>
                <option value="male">male</option>
              </select>

              @error ('client_type')
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
@section('js')
  <script>
    $(document).ready(function() {
      $('#type').on('change', function() {
        if(this.value === 'sms'){

        }else{

        }

      });

      $('#start').submit(function(e){
        e.preventDefault();
        let form = $(this);
        let actionUrl = form.attr('action');
          $.ajax(actionUrl, {
            method: 'POST',
            data: {
              _token: "{{ csrf_token() }}",
              start:true,
            }
          });
      });
    });
  </script>

@endsection
