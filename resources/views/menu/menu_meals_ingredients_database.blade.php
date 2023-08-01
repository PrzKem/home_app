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
      <div class="row">
         <div class="col-sm-12">
            <!-- Form to add new meal -->
            <h3>Add meal</h3>
            <form class="form" method="POST" action="{{url('menu/addMealToDB')}}">
              @CSRF
                <label for="name" class="form-label ">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                <label for="number_of_portions" class="form-label mt-3">Number of portions</label>
                <input type="number" id="number_of_portions" name="number_of_portions" class="form-control" placeholder="NoP">
                <label for="link " class="form-label mt-3">Link</label>
                <input type="url" id="link" name="link" class="form-control" placeholder="link">
                <div class="row mt-3">
                  <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    <input type="checkbox" id="breakfast" name="breakfast" class="btn-check" autocomplete="off">
                    <label for="breakfast" class="btn btn-outline-secondary">Breakfast</label>

                    <input type="checkbox" id="lunch" name="lunch" class="btn-check" autocomplete="off">
                    <label for="lunch" class="btn btn-outline-secondary">Lunch</label>

                    <input type="checkbox" id="dinner" name="dinner" class="btn-check" autocomplete="off">
                    <label for="dinner" class="btn btn-outline-secondary">Dinner</label>

                    <input type="checkbox" id="extra" name="extra" class="btn-check" autocomplete="off">
                    <label for="extra" class="btn btn-outline-secondary">Extra</label>
                  </div>
                </div>
                <div class="row">
                  <button class="btn btn-success mt-3 mb-2" type="submit">Done!</button>
                </div>
                <div class="row">
                  @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                  @endif
                </div>
            </form>
            <hr>
        </div>
      </div>
      <div class="row">

        <!-- Form to add new ingredient -->
        <h3 class="mt-3">Add ingredient</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
          <form class="form" method="POST" action="{{url('menu/addMealIngredientConnection')}}">
            @CSRF
            <div class="col-sm-12" id="form_content">
              <div class="row">
                <div class="col-sm-2"><label for="meal" class="form-label mt-1">Meal</label></div>
                <div class="col-sm-4">
                  <select class="form-select" id="meal" name="meal" aria-label="" value="{{old('meal')}}">
                    <option>Meal</option>
                    @foreach ($meals as $meal)
                    <option value="{{$meal->name}}">{{$meal->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-sm-12" id="ingredients_place">
                  <div class="row mt-2" id="movable_row_0">
                    <div class="col-sm-2"><label for="ingredient" class="form-label mt-2">Ingredient</label></div>
                    <div class="col-sm-3">
                      <select class="form-select" id="ingredient[0][name]" name="ingredient[0][name]" aria-label="">
                        <option value="" selected>Ingredient</option>
                        @foreach ($ingredient as $i)
                          <option value="{{$i->name}}">{{$i->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-sm-1"><label for="amount" class="form-label mt-2">Amount</label></div>
                    <div class="col-sm-2"><input type="number" id="ingredient[0][amount]" name="ingredient[0][amount]" class="form-control" placeholder="Amount"></div>
                    <div class="col-sm-2">
                      <select class="form-select" aria-label="" id="ingredient[0][measureType]" name="ingredient[0][measureType]">
                          <option value="g" selected>g</option>
                          <option value="szt">szt</option>
                          <option value="ml">ml</option>
                      </select>
                    </div>
                    <div class="col-sm-2" id="button_row">
                      <button type ="button" class="btn btn-secondary" id="add_row" onclick="displayer()">+</button>
                      <button type="button" class="btn btn-danger" onclick="removeIngredient(this)"><i class="fa-solid fa-trash"></i></button>
                    </div>
                  </div>
              </div>

              <div class="row">
                <div class="col-sm-8"><button class="btn btn-success mt-3 mb-3" type="submit" style="width:100%">Done!</button></div>
              </div>
              <div class="row">
                @if(session('status_mIC'))
                  <div class="alert alert-success">
                      {{ session('status_mIC') }}
                  </div>
                @endif
              </div>
          </div>
        </form>

        <hr>
      </div>
        <div class="row justify-content-end mt-3">
            <div class="col-sm-12">
                <h2>Meals database</h2>
                <table class="table">
                    <theader>
                        <th>Name</th>
                        <th>Number of portions</th>
                        <th>Link</th>
                    </theader>
                    <tbody>
                        @foreach ($meals as $meal)
                        <tr id="{{$meal->id}}">
                          <td>{{$meal->name}}</td>
                          <td>{{$meal->final_number_of_portions}}</td>
                          @if ($meal->source == "")
                          <td>-</td>
                          @else
                          <td><a href="{{$meal->source}}">link</a></td>
                          @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

  </div>
</div>
<script type="text/javascript" src="/list_adder.js"></script>
</body>
</html>
