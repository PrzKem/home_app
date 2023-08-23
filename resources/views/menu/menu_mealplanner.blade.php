<!DOCTYPE html>
<html>
<head>
@include('head')
<script type="text/javascript" src="{{asset('js/setMeals.js')}}"></script>
</head>
<body>

<div class="container mt-3">
 <div class="row">
    <!-- side bar nav -->
    @include('menu/menu_nav_bar')

      <div class="col-sm-8">
          <h2 class="mt-3">Add or replace meal</h2>
          <form id="addNewMeal" action="{{url('menu/addMealToPlan')}}" method="POST">
            @CSRF
              <label for="time_of_occuring" class="form-label mt-2">Date:</label>
              <input class="form-control" type="date" id="time_of_occuring" name="time_of_occuring">

              <label for="type_of_meal" class="form-label mt-2">Pick type of meal</label>
              <select class="form-select" id="type_of_meal" name="type_of_meal" aria-label="Meal type picker" onchange="setMeals(this.value)">
                  <option selected>Open to pick meal type</option>
                  <option value="breakfast">Breakfast</option>
                  <option value="lunch">Lunch</option>
                  <option value="dinner">Dinner</option>
                  <option value="extra">Extra</option>
              </select>

              <label for="meal_id" class="form-label mt-2">Pick meal</label>
              <select class="form-select" id="meal_id" name="meal_id" aria-label="Meal picker">
                <option selected>Open to pick meal</option>
                @foreach ($meals as $key)
                  <option value="{{$key['id']}}">{{$key['name']}}</option>
                @endforeach

              </select>

              <input class="btn mt-3 btn-success" type="submit" value="Submit"></input>
          </form>
          <div class="mt-4 col-sm-8" id="request_result-ingredients">
            @if(session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
            @endif
          </div>
          <div class="mt-4 col-sm-8" id="request_result-ingredients">
            @if (isset($ingredients))
            {{$ingredients}}
            @endif
          </div>
      </div>
    </div>
</div>

</body>
</html>
