<!DOCTYPE html>
<html lang="en">
<head>
 @include('head')
</head>
<body>

<div class="container mt-3 p-5 text-center">
 <div class="row" style="height:200px">
  <div class="col-sm-4">
    <button type="button" class="btn btn-primary btn-lg">
      <i class="fa-solid fa-sack-dollar"></i>
      Budget
    </button></div>
  <div class="col-sm-4">
    <button type="button" class="btn btn-primary btn-lg" onclick="location.href='{{url('menu')}}';">
    <i class="fa-solid fa-utensils"></i>
      Menu
    </button></div>
  <div class="col-sm-4">
    <button type="button" class="btn btn-primary btn-lg" onclick="location.href='{{url('calendar')}}';">
    <i class="fa-solid fa-calendar-days"></i>
    Events
    </button></div>
  </div>
 <div class="row" style="height:200px">
  <div class="col-sm-4">
    <button type="button" class="btn btn-primary btn-lg">
    <i class="fa-solid fa-server"></i>
    Home devices
    </button></div>
  <div class="col-sm-4"><button type="button" class="btn btn-primary btn-lg">
    <i class="fa-solid fa-sliders"></i>
    Settings
    </button></div>
  <div class="col-sm-4">
    <button type="button" class="btn btn-danger btn-lg">
    <i class="fa-solid fa-door-open"></i>
    Log out</button></div>
</div>
</div>

</body>
</html>
