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
        <div class="col-sm-8">
            <div class="row mt-5" style="visibility: hidden"><h3>Total cost: 10,9 PLN</h3></div>
            <div class="row">
              <button type="button" class="btn btn-outline-secondary col-sm-3" id="prevWeekBtn" onclick="substractWeek()"><i class="fa-solid fa-backward"></i></button>
              <div class="col-sm-6 mt-2" id="dateDisplayer"><h4>{{$startDateFormat}} - {{$endDateFormat}}</h4></div>
              <button type="button" class="col-sm-3 btn btn-outline-secondary" id="nextWeekBtn" onclick="addWeek()"><i class="fa-solid fa-forward"></i></button>
            </div>
            <div class="row">
                <table class="table">
                    <theader>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Measure</th>
                        <th>Packages</th>
                        <th style="visibility: hidden">Estimated total price</th>
                    </theader>
                    <tbody id="shopping_list_body">
                      @foreach($shoppingList as $item)
                        <tr>
                            <td>{{$item['name']}}</td>
                            <td>{{$item['quantity']}}</td>
                            <td>{{$item['measure']}}</td>
                            <td>{{$item['packages']}}</td>
                            <td style="visibility: hidden">2,4</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript" src="/getShoppingList.js"></script>
</body>
</html>
