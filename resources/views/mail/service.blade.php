<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <p style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Oguz Travel</p>
            @if(isset($data['type'] ))
                <p style="font-size:1.2em;color: #00466a;text-decoration:none;font-weight:400">{{ucfirst($data['type']) }}</p>
            @endif
        </div>
        @foreach($data as $key => $value)
            @if ($key == 'updated_at' || $key === 'files' ||  is_null($value)) @continue;
            @elseif($key == 'scanned_passport' && isset($data['scanned_passport']))
                @php
                    $json =  json_decode($value);
                    $url = asset('storage/scanned_passport_file/' . $json[0]->filename);
                @endphp
                <p style="font-size:1em"><b>{{ $key }}</b>: <a href="{{ $url }}" download>{{ $json[0]->filename }}</a></p>
            @elseif($key == 'attach')
                @foreach($value as $k => $files)
                    <p style="font-size:1em"><b>{{ $k }}</b>:
                @foreach($files as $file)
                        <a href="{{ $file }}" download >Download</a>
                    @endforeach
                    </p>
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
