<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $event->title }}</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ asset('css/style2.css') }}" rel="stylesheet"> --}}
    <style>
        * {
            transition: all 0.6s;
        }

        html {
            height: 100%;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: #888;
            margin: 0;
        }

        #main {
            display: table;
            width: 100%;
            height: 100vh;
            text-align: center;
        }

        .fof {
            display: table-cell;
            vertical-align: middle;
        }

        .fof h1 {
            font-size: 50px;
            display: inline-block;
            padding-right: 12px;
            animation: type .5s alternate infinite;
        }

        @keyframes type {
            from {
                box-shadow: inset -3px 0px 0px #888;
            }

            to {
                box-shadow: inset -3px 0px 0px transparent;
            }
        }

    </style>

</head>

<body>
    <div class="container-fluid">
        {{-- <div style="position:absolute;
            top:0;
            right:0;
            margin-right:20px;">Tes</div> --}}
        @if ($event->status != 'Ongoing')
            <div id="main">
                <div class="fof">
                    <h1>Event Not Available</h1>
                </div>
            </div>
        @else
            <div id="main">
                <div class="fof">
                    <h1 style="color:dimgrey" id="change-text"></h1>
                </div>
            </div>
        @endif
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

@if ($event->status == 'Ongoing')
    <script>
        let ws;
        if (ws) {
            ws.onerror = ws.onopen = ws.onclose = null;
            ws.close();
        }

        ws = new WebSocket(
            'wss://s3858.sgp1.piesocket.com/v3/1?api_key=6MMSFSXcCtghCYgRUdX8rmfSyPy5LCDl4EF7MuTK&notify_self');
        ws.onopen = () => {
            // console.log('Connection opened!');
        }
        var text = "Welcome";
        ws.onmessage = ({
            data
        }) => {
            let parsed = JSON.parse(data);

            if (parsed.event == "{{ $event->slug }}") {
                $("#change-text").fadeOut(1000);
                setTimeout(function() {
                    document.getElementById("change-text").innerText = parsed.user;
                    $("#change-text").fadeIn(1500);
                    responsiveVoice.speak(parsed.user);
                }, 1000);
            }

            //  responsiveVoice.speak(text,{pitch: 13,rate: 0.8});
        };
    </script>
@endif

</html>
