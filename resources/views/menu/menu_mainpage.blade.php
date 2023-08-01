<!DOCTYPE html>
<html>
<head>
 @include('head')
</head>
<body>
<div class="container mt-3">
  <div class="row">
    <!-- side bar nav -->
    @include('menu/menu_nav_bar')
    <div class="col-sm-8">
      <!-- actual menu -->
      <h2>
          Actual menu
      </h2>
      <table class="table">
          <thead>
            <tr>
              <th>Meal type</th>
              @foreach ($calendarDays as $day)
              <th style="text-align: center"><h5 id="weekday_{{$loop->index}}">{{$day['name']}}</h5><h6 id="day_{{$loop->index}}">{{$day['date']}}</h6></th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>breakfast</td>
              @foreach ($calendarDays as $day)
              <td>{{$day['breakfast']}}</td>
              @endforeach
            </tr>
            <tr>
              <td>lunch</td>
              @foreach ($calendarDays as $day)
              <td>{{$day['lunch']}}</td>
              @endforeach
            </tr>
            <tr>
              <td>dinner</td>
              @foreach ($calendarDays as $day)
              <td>{{$day['dinner']}}</td>
              @endforeach
            </tr>
            <tr>
              <td>extras</td>
              @foreach ($calendarDays as $day)
              <td>{{$day['extra']}}</td>
              @endforeach
            </tr>
          </tbody>
      </table>

      <!-- future menu -->
      <h2 class="mt-5">Future menu</h2>
      <div class="row"><button type="button" class="btn btn-outline-secondary col-sm-6" id="prevWeekBtn"><i class="fa-solid fa-backward"></i></button><button type="button" class="col-sm-6 btn btn-outline-secondary" id="nextWeekBtn"><i class="fa-solid fa-forward"></i></button></div>
      <table class="table">
          <thead>
            <tr>
              <th>Meal type</th>
              @foreach ($f_calendarDays as $day)
              <th style="text-align: center"><h5 id="f_weekday_{{$loop->index}}">{{$day['name']}}</h5><h6 id="f_day_{{$loop->index}}">{{$day['date']}}</h6></th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>breakfast</td>
              @foreach ($f_calendarDays as $day)
              <td>{{$day['breakfast']}}</td>
              @endforeach
            </tr>
            <tr>
              <td>lunch</td>
              @foreach ($f_calendarDays as $day)
              <td>{{$day['lunch']}}</td>
              @endforeach
            </tr>
            <tr>
              <td>dinner</td>
              @foreach ($f_calendarDays as $day)
              <td>{{$day['dinner']}}</td>
              @endforeach
            </tr>
            <tr>
              <td>extras</td>
              @foreach ($f_calendarDays as $day)
              <td>{{$day['extra']}}</td>
              @endforeach
            </tr>
          </tbody>
      </table>
    </div>


  </div>
</div>
</body>
</html>
