<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <p style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Oguz Travel</p>
            @if(isset($data['type'] ))
                <p style="font-size:1.2em;color: #00466a;text-decoration:none;font-weight:400">{{ucfirst($data['type']) }}</p>
            @endif
        </div>
        @foreach($data as $key => $value)
            @if ($key == 'updated_at'  ||  is_null($value)) @continue;
            @elseif($key == 'filename' && isset($data['filename']))
                @php
                    $json =  json_decode($value);
                @endphp
                <p style="font-size:1em"><b>{{ __('Scanned passport') }}</b>:
                @foreach($json  as $file)
                    <a href="{{ asset('storage/scanned_passport_file/' . $file->filename) }}" download>{{ $file->file_type }}</a>
                @endforeach
                </p>
            @elseif($key == 'attach')
                @foreach($value as $k => $file)
                    <a href="{{ $file }}" download>{{ $k }}</a><br/>
                @endforeach
            @elseif($key == 'created_at')
                <p style="font-size:1em"><b>Date</b>: {{ Carbon\Carbon::parse($value)->format('Y-m-d H:i:s') }}</p>
            @else
                <p style="font-size:1em"><b>{{ $key }}</b>: {{ $value }}</p>
            @endif
        @endforeach
        <hr style="border:none;border-top:1px solid #eee" />
        <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
            <p>Oguz Travel</p>
        </div>
    </div>
</div>
