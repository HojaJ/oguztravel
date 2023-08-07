@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => __('Emails')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm mt-4">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Emails') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a target="_blank" href="{{ route('panel.emails.create') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Create Email') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="nk-block">
  @if (count($datas))
  <div class="card card-bordered mb-5">
    <table class="table">
      <thead>
        <tr class="tb-tnx-head">
          <th>{{ __('Name') }}</th>
          <th>{{ __('Lang') }}</th>
          <th>{{ __('Action') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach($datas as $data)
          <tr class="tb-tnx-item">
            <td>{{ $data->name }}</td>
            <td>{{ $data->lang }}</td>
            <td class="tb-col-action">
              <a target="_blank" href="{{ route('panel.emails.edit', $data->id) }}"
                 class="link-cross d-inline-bl  ock link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>

              <a href="#"
                 onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $data->id }}').submit(); }"
                 class="link-cross mr-sm-n1"><em class="icon ni ni-trash"></em></a>
              <form action="{{ route('panel.emails.destroy', $data->id) }}" method="post"
                    id="destroy-{{ $data->id }}">
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
  <p>{{ __('not exist', ['thing' => __('Emails  ')]) }}</p>
  @endif
</div>

@endsection