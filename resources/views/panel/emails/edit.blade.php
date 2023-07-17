<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Email editor</title>
  <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body>
<main  class="container">
  <div class="py-2 d-flex justify-content-end">
    <button class="btn btn-primary" id="save">Save design</button>
  </div>
<div id="editor-container" style="margin: 10px auto 0; height: 900px;">
  </div>
</main>
<script src="{{ asset('js/common_scripts.js') }}"></script>

<script src="https://editor.unlayer.com/embed.js"></script>
<script>
  unlayer.init({
    id: 'editor-container',
    displayMode: 'email',
    appearance: {
      theme: 'dark',
    },
  });
  let design = @php echo $email->data; @endphp;
  unlayer.loadDesign(design);
  document.getElementById("save").addEventListener("click",function () {
    unlayer.exportHtml(function(data) {
        $.ajax({
          type:'PUT',
          url: '{{ route('panel.emails.update',['email' => $email->id]) }}',
          data: {
            _token:'{{ csrf_token() }}',
            data: data.design,
            html: data.html,
          },
          success: function (data) {
           if(data.success){
              window.location.href = "{{route('panel.emails.index')}}"
           }
          }
        })
    });
  });
</script>
</body>
</html>