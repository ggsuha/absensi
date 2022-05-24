<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">

  </head>
  <body>
    <div class="container" style="margin-top: 8%;">
      
      <div >     
        </div>
        <div >     
      <div class="row">
      <div id="logo" class="text-center">
      <h1>{{ asset('') }}This is Logo</h1><p>Slogan of thematic</p>
      </div>
      
      <div class="form-group">
      <div class="input-group"> 
      <input id="search" onchange="myFunction()" class="form-control" type="text" name="search" autofocus placeholder="Search..." required/>
      <span class="input-group-btn">
      <button class="btn btn-success" type="submit">
      <i class="glyphicon glyphicon-search" aria-hidden="true"></i> Search
      </button>
      </span>
      </div>
      </div>
      </div>            
      </div>
      <div >     
      </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.min.js" integrity="sha512-X7kCKQJMwapt5FCOl2+ilyuHJp+6ISxFTVrx+nkrhgplZozodT9taV2GuGHxBgKKpOJZ4je77OuPooJg9FJLvw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-socket-js/1.0.0/web_socket.min.js" integrity="sha512-jtr9/t8rtBf1Sv832XjG1kAtUECQCqFnTAJWccL8CSC82VGzkPPih8rjtOfiiRKgqLXpLA1H/uQ/nq2bkHGWTQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/scripts2.js"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=wzVtuAca"></script>
    <script>

let ws;

if (ws) {
        ws.onerror = ws.onopen = ws.onclose = null;
        ws.close();
      }
      ws = new WebSocket('wss://ws.ahaamedia.com:6969');
      ws.onopen = () => {
        console.log('Connection opened!');
      }
      ws.onmessage = ({ data }) => {
         
         console.log(data);
     
     
 };
function kirimsocket(data){
  ws.send(data);
}

 function myFunction(){
  var input = document.getElementById("search").value
  console.log(input);
 
  var form = new FormData();
form.append("email", "isabel_lalenoh@hotmail.com");

var settings = {
  "url": "http://127.0.0.1:8000/api/event/1/scan_checkin",
  "method": "POST",
  "timeout": 0,
  "processData": false,
  "mimeType": "multipart/form-data",
  "contentType": false,
  "dataType": "json",
  "data": form
};

$.ajax(settings).done(function (response) {
  console.log(response.name);
  kirimsocket(response.name);
  document.getElementById("search").value="";
});

}

    </script>
  </body>
</html>