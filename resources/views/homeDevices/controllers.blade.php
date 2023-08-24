<!DOCTYPE html>
<html>
<head>
 @include('head')
 <link href="{{ asset('css/controllers.css') }}" rel="stylesheet">
 <script type="text/javascript" src="{{asset('js/controllers.js')}}"></script>
</head>
<body>
  <div class="container mt-3">
    <div class="row">
      <!-- side bar nav -->
      @include('homeDevices/hd_nav_bar')
      <!-- actual page in middle -->
      <div class="col-sm-8">
        <div class="row">
          @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
        </div>
        <div class="row">
          <div class="col-sm-10"></div>
          <div class="col-sm-2">
            <button class="btn btn-success" onclick="location.href='{{url('hd/addController')}}'">Add new</button>
          </div>
        </div>
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
            <div class="col-sm-5">
              <div class="row">
                <h3>{{$device->name}}<h3>
                <h6 id="device_time_{{$loop->index}}">Last seen at: {{$device->updated_at}}<h6>
              </div>
              <div class="row">
                <h4>{{$device->location}}<h4>
              </div>
              <div class="row">
                @if ($device->updated_at<$deadline )
                <h4 id="device_workmode_{{$loop->index}}" style="color:#DC143C">{{$device->actual_work_mode}}</h4>
                @elseif ($device->actual_work_mode == "manu")
                <h4 id="device_workmode_{{$loop->index}}" style="color:#BF8715">{{$device->actual_work_mode}}</h4>
                @elseif ($device->actual_work_mode == "auto")
                <h4 id="device_workmode_{{$loop->index}}" style="color:#25733A">{{$device->actual_work_mode}}</h4>
                @endif
              </div>
              <div class="row">
                <h5>ID: {{$device->id}}<h5>
              </div>
            </div>
            <div class="col-sm-4">
              @if(array_key_exists($device->id,$sensors->toArray()))
                <h4>Connected sensors: {{count($sensors[$device->id])}}</h4>
              @else
                <h4>Connected sensors: 0</h4>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</body>
</html>
