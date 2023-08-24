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
          @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
        </div>
        <div class="row">
          <div class="col-sm-1"><div class="loader orbit"></div></div>
          <div class="col-sm-9"><h3>Sensors [{{$time/1000}}s]</h3></div>
          <div class="col-sm-2">
            <button class="btn btn-success" onclick="location.href='{{url('hd/addSensor')}}'">Add new</button>
          </div>
        </div>
        <!-- actual page in middle -->
        <div class="table-responsive">
          <table class="table">
              <thead>
                  <th scope="col">ID</th>
                  <th scope="col">Controller</th>
                  <th scope="col">Last read</th>
                  <th scope="col">Last update</th>
                  <th scope="col">Status</th>
                  <th scope="col">Description</th>
                  <th scope="col">Actions</th>
              </thead>
              <tbody id="tableBody">

              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
