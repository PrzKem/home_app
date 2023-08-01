<div class="col-sm-4">
    <h3 class="mt-4">Links</h3>
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
          <a class="nav-link" href="{{url('menu')}}">Main menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('menu/mealplanner')}}">Meal planner</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('menu/stocks')}}">Stocks</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('menu/menuShoppingList')}}">Shopping list</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('menu/mealsIngredientsDatabase')}}">Meals-ingredients database</a>
        </li>
      </ul>
      <h3 class="mt-5">Navigation</h3>
    @include('pages_nav_bar')
  </div>
