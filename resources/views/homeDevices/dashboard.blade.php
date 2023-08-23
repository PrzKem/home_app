<!DOCTYPE html>
<html>
<head>
 @include('head')
 <link href="{{ asset('css/checkbox.css') }}" rel="stylesheet">
 <script type="text/javascript" src="{{asset('js/dashboard.js')}}"></script>
</head>
<body onload="bodyLoad()">
  <div class="container mt-3">
    <div class="row mt-3">
      <!-- side bar nav -->
      @include('homeDevices/hd_nav_bar')
      <div class="col-sm-8">
        <!-- actual page in middle -->
        <div class="row mt-3">
          <h2>Home devices dashboard</h2>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <h4>Lamps</h4>
            <label class="switch">
              <input type="checkbox" onclick="sendButtonRequest(8)" id="btn_8">
              <span class="slider"></span>
            </label>
          </div>
          <div class="col-sm-4">
            <h4>Gaming computer</h4>
            <label class="switch">
              <input type="checkbox" onclick="sendButtonRequest(9)" id="btn_9">
              <span class="slider"></span>
            </label>
          </div>
          <div class="col-sm-4">
            <h4>Computer accesories</h4>
            <label class="switch">
              <input type="checkbox" onclick="sendButtonRequest(10)" id="btn_10">
              <span class="slider"></span>
            </label>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-sm-4">
            <h4>Air cleaner</h4>
            <label class="switch">
              <input type="checkbox" onclick="sendButtonRequest(11)" id="btn_11">
              <span class="slider"></span>
            </label>
          </div>
        </div>

      </div>
    </div>
  </div>
</body>
</html>
