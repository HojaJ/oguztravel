<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Oguz Travel</a>
        </div>
        @foreach($data as $key => $value)
            @if ($key === '_token' || $key === 'files') @continue;
            @elseif($key === 'attach')
                @foreach($value as $k => $file)
                    <a href="{{ $file }}" download>{{ $k }}</a>
                @endforeach
            @endif
                <p style="font-size:1em">{{ $key }}: {{ $value }}</p>
        @endforeach
        <hr style="border:none;border-top:1px solid #eee" />
        <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
            <p>Oguz Travel</p>
        </div>
    </div>
</div>
