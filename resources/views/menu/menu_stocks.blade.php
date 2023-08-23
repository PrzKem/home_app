<!DOCTYPE html>
<html>
<head>
 @include('head')
 <script type="text/javascript" src="{{ asset('js/stocks.js') }}"></script>
</head>
<body>
<div class="container mt-3">
  <div class="row">
    <!-- side bar nav -->
    @include('menu/menu_nav_bar')

    <div class="col-sm-8">
        <h2>Stocks</h2>
        <form class="form" method="POST" action="{{url('menu/addStock')}}" id="mainForm">
          @CSRF
            <div class="row">
              <div class="col"><input type="text" placeholder="Name" class="form-control" id="name" name="name"></input></div>
              <div class="col"><input type="number" placeholder="Quantity on stock" class="form-control" id="quantityOnStock" name="quantityOnStock"></input></div>
            </div>
            <div class="row">
            <div class="col"><input type="number" placeholder="Box size" class="form-control" id="boxSize" name="boxSize"></input></div>
            <div class="col">
              <select class="form-select" aria-label="" id="measureType" name="measureType">
                  <option selected>Measure type</option>
                  <option value="g">g</option>
                  <option value="szt">szt</option>
                  <option value="ml">ml</option>
              </select>
            </div>
            </div>
            <button type="submit" id="updateButton" class="btn btn-success mt-3 mb-5">Add</button>
        </form>
        <div class="mt-4 col-sm-8" id="request_result">
          @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
        </div>
        <table class="table">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity on stock</th>
                <th>Measure</th>
                <th>Actions</th>
            </thead>
            <tbody>
              @foreach ($ingredients as $ingredient)
                <tr id="{{$ingredient->id}}.tr">
                  <td id="{{$ingredient->id}}">{{$ingredient->id}}</td>
                  <td id="{{$ingredient->id}}.name">{{$ingredient->name}}</td>
                  <td id="{{$ingredient->id}}.qos">{{$ingredient->quantity_on_stock}}</td>
                  <td id="{{$ingredient->id}}.mop">{{$ingredient->measure_of_package}}</td>
                  <td>
                    <button type="button" class="btn" onclick="updateIngredient({{$ingredient->id}})"><i class="fa-solid fa-pen-to-square"></i></button>
                    <button type="button" class="btn" onclick="deleteIngredient({{$ingredient->id}})"><i class="fa-solid fa-trash" style="color:#DC143C"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
  </div>
</div>
</body>
</html>
