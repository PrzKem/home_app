<!DOCTYPE html>
<html>
<head>
 @include('head')

 <script type="text/javascript" src="{{asset('js/charts.js')}}"></script>
</head>
<body>
  <div class="container mt-3">
    <div class="row">
      <!-- side bar nav -->
      @include('homeDevices/hd_nav_bar')
      <div class="col-sm-8">
        <!-- actual page in middle -->
        <div class="row">
          <select name="sensors" id="sensors">
            @foreach ($sensors as $sensor):
              <option value="{{$sensor['id']}}">{{$sensor['id']}}</option>
            @endforeach
          </select>
        </div>
        <div class="row">
          <div id="chartContainer" style="height: 370px; width:100%;"></div>
        </div>
      </div>
    </div>
  </div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>
