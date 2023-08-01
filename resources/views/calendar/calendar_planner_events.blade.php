<!DOCTYPE html>
<html>
<head>
 @include('head')
</head>
<body>
<div class="container mt-3">
  <div class="row">
    <!-- side bar nav -->
    <div class="col-sm-3">
      @include('calendar/calendar_nav_bar')
    </div>
    <div class="col-sm-9">
        <div class="row"><a href="{{url('calendar/createNewTrip')}}"><input type="button" class="btn btn-success" value="Create new event" style="width:45%"></a></div>
        <div class="row mt-3">
            <h2>Events</h2>
            <table>
                <thead>
                    <th>Name</th>
                    <th>Time start</th>
                    <th>Time end</th>
                    <th>Cost per person</th>
                    <th>OK/NOK</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                  @foreach($events as $event)
                    <tr>
                      <td>{{$event['name']}}</td>
                      <td>{{$event['time_start']}}</td>
                      <td>{{$event['time_end']}}</td>
                      <td>{{$event['estimated_cost_per_person']}}</td>
                      <td>{{$event['accepted']}}</td>
                      <td>
                        <button type="button" class="btn" onclick="editTripInfo({{$event['id']}})"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="button" class="btn" onclick="deleteTrip({{$event['id']}})"><i class="fa-solid fa-trash" style="color:#DC143C"></i></button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>


  </div>
</div>
</body>
</html>
