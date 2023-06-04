@extends('layouts.panel')

@section('title') {{ __('index page', ['name' => trans('Contact us')]) }} @endsection

@section('content')
<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ __('Contact us') }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a href="{{ route('panel.contact.create') }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">{{ __('Create new social link') }}</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>

<div class="card card-bordered mt-3 mb-5">
  <table class="table">
    <thead>
      <tr class="tb-tnx-head">
        <th>{{ __('SVG') }}</th>
        <th>{{ __('Slug') }}</th>
        <th>{{ __('Data') }}</th>
        <th></th>
        <th>{{ __('Action') }}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($contacts as $contact)
      <tr class="tb-tnx-item">
        <td>{!! $contact->icon !!}</td>
        <td>{{ $contact->slug }}</td>
        <td>
          @if ($contact->data)
            @if ($contact->data == 'phone')
              <a href="tel:{{ $contact->data }}" target="_blank">{{ $contact->data }}</a>
            @elseif ($contact->data == 'email')
              <a href="mailto:{{ $contact->data }}" target="_blank">{{ $contact->data }}</a>
            @else
              <a href="{{ $contact->data }}" target="_blank">{{ $contact->data }}</a>
            @endif
          @elseif($contact->type == 'social')
            <a href="{{ $contact->data }}" target="_blank">{{ $contact->data }}</a>
          @else
          @foreach(LaravelLocalization::getSupportedLocales() as $locale => $properties)
          <p>
            <em class="d-block">{{ $properties['native'] }}</em>
            {!! $contact->getTranslation('locale_data', $locale) !!}
          </d>
          @endforeach
          @endif
        </td>
        <td>
          @if($contact->is_active)
          <span class="text-success">{{ __('Active') }}</span>
          @else
          <span class="text-danger">{{ __('Not active') }}</span>
          @endif
        </td>
        <td class="tb-col-action">
          <a href="{{ route('panel.contact.edit', $contact->id) }}" class="link-cross d-inline-block link-edit mr-2"><em class="icon ni ni-edit-alt"></em></a>

          @if(!in_array($contact->type, $contact_lists))
          <a href="#" onclick="if (confirm('{{ __('want to remove') }}')) { document.getElementById('destroy-{{ $contact->id }}').submit(); }" class="link-cross d-inline-block"><em class="icon ni ni-trash"></em></a>
          <form action="{{ route('panel.contact.destroy', $contact->id) }}" method="post" id="destroy-{{ $contact->id }}">
            @method('delete')
            @csrf
          </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection