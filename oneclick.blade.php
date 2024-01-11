
@extends('device.index')

@section('tab')

<html>
  <head>
    <title>Oneclick Diagnostics Button Below</title>
  </head>

  <body>

    @if(isset($result))
      <p>{{ $result }} </p>
    @elseif(isset($error))
      <p>{{ $error }} </p>
    @endif

    <form method = "post" action = "" id = "myForm">
      @csrf
      <button type = "submit" onclick = "handleButtonClick(event)"> Click for Diagnostics </button>
    </form>

    <div id = "result"> </div>

    <script>
        function handleButtonClick() {
            event.preventDefault();
            document.getElementById('myForm').insertAdjacentHTML('afterend', '<p>Button has been clicked</p>');
            fetch('/run-python-script', {
              method: 'POST',
              headers: {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name = "csrf-token"]').getAttribute('content'),
              },
              body: JSON.stringify({}),
            })
          .then(response => response.json())
          .then(data => {
            document.getElementById('result').innerHTML = '<p>' + data.output.join('<br>') + '</p>';
          })
          .catch(error => console.error('Error.', error));
        }
      
    </script>

  </body>
</html>
@endsection
