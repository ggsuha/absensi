<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $event->title }} Check in</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link href="{{ asset('css/style2.css') }}" rel="stylesheet">
    <style>
        #change-text{
            text-align: center;
            padding-top: 20%;
            font-size: 40px;
            font-weight: 700;
        }

    </style>

</head>

<body>

<div class="container-fluid">
<div class="row">
    <div class="col-md-12">
  <p id="change-text">Shining Text Animation Effects</p>
    </div>
</div>
</div>
</body>

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.min.js"
        integrity="sha512-X7kCKQJMwapt5FCOl2+ilyuHJp+6ISxFTVrx+nkrhgplZozodT9taV2GuGHxBgKKpOJZ4je77OuPooJg9FJLvw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-socket-js/1.0.0/web_socket.min.js"
        integrity="sha512-jtr9/t8rtBf1Sv832XjG1kAtUECQCqFnTAJWccL8CSC82VGzkPPih8rjtOfiiRKgqLXpLA1H/uQ/nq2bkHGWTQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/scripts2.js') }}"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=wzVtuAca"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
   

<script>

let ws;
if (ws) {
    ws.onerror = ws.onopen = ws.onclose = null;
    ws.close();
  }

  ws = new WebSocket('wss://s3858.sgp1.piesocket.com/v3/1?api_key=6MMSFSXcCtghCYgRUdX8rmfSyPy5LCDl4EF7MuTK&notify_self');
  ws.onopen = () => {
    console.log('Connection opened!');
  }
  var text = "Welcome";
  ws.onmessage = ({ data }) => {
     
     console.log(data);
     document.getElementById("change-text").innerText=data;
     text = String(data);
    //  responsiveVoice.speak(text,{pitch: 13,rate: 0.8});
     responsiveVoice.speak(text);
 
};
  
</script>

</html>
