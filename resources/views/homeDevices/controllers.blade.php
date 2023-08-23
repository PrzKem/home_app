<!DOCTYPE html>
<html>
<head>
 @include('head')

 <style>
  .devrow {
    background-color: lightgrey;
    border: 1px solid grey;
    border-radius: 25px;
    padding: 10px;
  }
</style>
</head>
<body>
  <div class="container mt-3">
    <div class="row">
      <!-- side bar nav -->
      @include('homeDevices/hd_nav_bar')
      <div class="col-sm-8">
        <!-- actual page in middle -->
        @foreach ($ctrl as $device)
          <div class="row devrow mt-2">
            <div class="col-sm-3">
              @if (str_contains($device->name,'RPi'))
              <img src = "/img/noun-raspberry-pi-1109534.svg" alt=""/>
              @endif
              @if (str_contains($device->name,'Arduino'))
              <img src = "../img/noun-arduino-34403.svg" alt=""/>
              @endif
            </div>
            <div class="col-sm-9">
              <div class="row">
                <h3>{{$device->name}}<h3>
                <h6>Last seen at: {{$device->updated_at}}<h6>
              </div>
              <div class="row">
                <h4>{{$device->location}}<h4>
              </div>
              <div class="row">
                @if ($device->updated_at<$deadline )
                <h4 style="color:#DC143C">{{$device->actual_work_mode}}</h4>
                @elseif ($device->actual_work_mode == "manu")
                <h4 style="color:#BF8715">{{$device->actual_work_mode}}</h4>
                @elseif ($device->actual_work_mode == "auto")
                <h4 style="color:#25733A">{{$device->actual_work_mode}}</h4>
                @endif

              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</body>
</html>
