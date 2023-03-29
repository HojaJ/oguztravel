<div class="nk-block-head nk-block-head-sm">
  <div class="nk-block-head-sub"><span>@lang('main.all')</span></div>
  <div class="nk-block-between-md g-4">
    <div class="nk-block-head-content">
      <h2 class="nk-block-title fw-normal">{{ $data['title'] }}</h2>
    </div>
    <div class="nk-block-head-content">
      <ul class="nk-block-tools gx-3">
        <li>
          <a href="{{ $data['route'] }}" class="btn btn-white btn-dim btn-outline-primary">
            <em class="icon ni ni-edit"></em><span class="d-none d-sm-inline-block">@lang('main.create_new')</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>