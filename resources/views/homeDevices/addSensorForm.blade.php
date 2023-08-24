<!DOCTYPE html>
<html>
<head>
 @include('head')
</head>
<body>
  <div class="container mt-3">
    <div class="row">
      <!-- side bar nav -->
      @include('homeDevices/hd_nav_bar')
      <!-- actual page in middle -->
      <div class="col-sm-8">
        <form class="form" method="POST" action="{{url('hd/addSensor')}}">
          @CSRF
          <div class="row input-group">
            <div class="col-sm-2"><label for="controller_id" class="form-label mt-1">Controller ID</label></div>
            <div class="col-sm-6">
              <select class="form-select" id="controller_id" name="controller_id" aria-label="">
                @foreach($controllers as $controller)
                  <option value="{{$controller['id']}}">{{$controller['id']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="row input-group">
            <div class="col-sm-3"><label for="measurement_unit" class="form-label mt-1">Measurement unit</label></div>
            <div class="col-sm-5"><input type="text" id="measurement_unit" name="measurement_unit" placeholder="" class="form-control"></div>
          </div>
          <div class="row input-group">
            <div class="col-sm-2"><label for="description" class="form-label mt-1">Description</label></div>
            <div class="col-sm-6"><input type="text" id="description" name="description" placeholder="" class="form-control"></div>
          </div>
          <div class="row">
            <div class="col-sm-8"><button class="btn btn-success mt-3 mb-3" type="submit" style="width:100%">Add</button></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
