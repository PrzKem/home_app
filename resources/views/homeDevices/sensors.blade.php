<!DOCTYPE html>
<html>
<head>
 @include('head')
 <link href="{{ asset('css/sensors.css') }}" rel="stylesheet">
 <script type="text/javascript" src="{{asset('js/sensors.js')}}"></script>
</head>
<body onload="requestTemporary()">
  <div class="container mt-3">
    <div class="row">
      <!-- side bar nav -->
      @include('homeDevices/hd_nav_bar')
      <div class="col-sm-8">
        <div class="row">
          <div class="col-sm-1"><div class="loader"></div></div>
          <div class="col-sm-11"><h3>Sensors [{{$time/1000}}s]</h3></div>
        </div>
        <!-- actual page in middle -->
        <table class="table">
            <thead>
                <th scope="col">ID</th>
                <th scope="col">Controller</th>
                <th scope="col">Last read</th>
                <th scope="col">Last update</th>
                <th scope="col">Status</th>
            </thead>
            <tbody id="tableBody">

            </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
</html>
