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
        <form class="form" method="POST" action="{{url('hd/addController')}}">
          @CSRF
          <div class="row input-group">
            <div class="col-sm-2"><label for="name" class="form-label mt-1">Name</label></div>
            <div class="col-sm-6"><input type="text" id="name" name="name" placeholder="name" class="form-control"></div>
          </div>
          <div class="row input-group">
            <div class="col-sm-2"><label for="location" class="form-label mt-1">Location</label></div>
            <div class="col-sm-6"><input type="text" id="location" name="location" placeholder="location" class="form-control"></div>
          </div>
          <div class="row input-group">
            <div class="col-sm-2"><label for="workmode" class="form-label mt-1">Actual work mode</label></div>
            <div class="col-sm-6">
              <select class="form-select" id="workmode" name="workmode" aria-label="">
                <option value="auto">Auto</option>
                <option value="manu">Manual</option>
              </select>
            </div>
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
