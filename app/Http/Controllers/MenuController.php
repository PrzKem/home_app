<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Meals;
use App\Models\Ingredients;
use App\Models\Connections;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MenuController extends Controller
{
  private $meal_types = ['breakfast', 'lunch', 'dinner', 'extra'];

  private function getMenuForDays($startPoint, $offset, $number_of_days)
  {
    //initial values
    $calendarDays = [];
    $days = [];
    $meals_to_print = [];
    for ($i=$startPoint;$i<$number_of_days+$offset;++$i)
    {
      $days[$i] = Carbon::now()->add($i,'day'); //save every day in table
      for($j=0;$j<4;$j++)
      {
        //get each type if meal for selected day
        $tmpQuery = Menu::where('time_of_occuring',$days[$i]->isoFormat("YYYY-MM-DD"))->where('type_of_meal',$this->meal_types[$j])->get();
        if(!empty($tmpQuery)){
          $meals_to_print[$i][$j] = (Meals::where('id',(Menu::where('time_of_occuring',$days[$i]->isoFormat("YYYY-MM-DD"))->where('type_of_meal',$this->meal_types[$j])->get())[0]['meal_id'])->get())[0]['name'];
        }
      }
      //save meals with date info in array, that will be returned
      $calendarDays[$i] = [
        "date"=>$days[$i]->isoFormat("DD.MM.YYYY"), "name"=>$days[$i]->isoFormat("dddd"), "breakfast" => $meals_to_print[$i][0], "lunch" => $meals_to_print[$i][1], "dinner" => $meals_to_print[$i][2], "extra"=> $meals_to_print[$i][3]
      ];
    }

    return $calendarDays;
  }

  public function index()
  {
    //inital values required to function workflow
    $number_of_days = 0;
    $offset=1;
    $f_calendarDays = [];
    $calendarDays = [];
    $queryResult = Menu::select('time_of_occuring')->orderBy('time_of_occuring', 'desc')->distinct()->get();
    $canBeUse = true;
    $indexToUse = 0;

    //if no menu can be found then show empty tables
    if(empty($queryResult[0]))
    {
      return view('menu.menu_mainpage',compact('calendarDays','f_calendarDays'));
    }

    //determine days with full menu to be used in table
    foreach ($queryResult as $qR) {
      $canBeUse = true;
      for($j=0;$j<4;$j++)
      {
        $canBeUse = (!empty(Menu::select('time_of_occuring')->where('time_of_occuring',$qR['time_of_occuring'])->where('type_of_meal',$this->meal_types[$j])->get()[0]) and $canBeUse);
      }
      if ($canBeUse) {
        break;
      }
      $indexToUse++;
    }

    //determine min and max dates
    $topDate = Carbon::parse($queryResult[$indexToUse]['time_of_occuring']);
    $bottomDate = Carbon::parse($queryResult[count($queryResult)-1]['time_of_occuring']);
    $today = Carbon::now();
    $bottomDate = $today->gt($bottomDate)?$today:$bottomDate;
    $max_number_of_days = $topDate->diffInDays($bottomDate);
    $max_number_of_days+=1;

    //if today is bigger than maximum date, then return with empty table as no menu can be displayed from today
    if($topDate->lt($today))
    {
      return view('menu.menu_mainpage',compact('calendarDays','f_calendarDays'));
    }

    //determine number of days according to readings in DB
    if($max_number_of_days>14)
    {
      $number_of_days=7;
      $offset = 7;
    }
    elseif (14>$max_number_of_days and $max_number_of_days>7) {
      $number_of_days=7;
      $offset = $max_number_of_days-$number_of_days+1;
    }
    else{
      $number_of_days = $max_number_of_days;
      $offset = 0;
    }

    //get menu from DB with parameters according to determined number of days
    $calendarDays = $this->getMenuForDays(0,0,$number_of_days);
    $f_calendarDays = $this->getMenuForDays(7,$offset,$number_of_days);

    //return view
    return view('menu.menu_mainpage',compact('calendarDays','f_calendarDays'));
  }

  public function create(Request $request)
  {
    $request->validate([
        'meal_id' => 'required',
        'type_of_meal' => 'required',
        'time_of_occuring' => 'required'
    ]);

    $menu= Menu::create($request->all());
    return response()->json([
        "status" => 1,
        "data" => $menu
    ],201);
  }

  public function store(Request $request)
  {
      $request->validate([
        'meal_id' => 'required',
        'type_of_meal' => 'required',
        'time_of_occuring' => 'required'
      ]);

      $menu= Menu::create($request->all());
      return response()->json([
          "status" => 1,
          "data" => $menu
      ],201);
  }

  public function mealplanner()
  {
    $meals=Meals::all();

    return view('menu.menu_mealplanner', compact('meals'));
  }

  public function mealplannerCreate(Request $request)
  {
    $menu = new Menu;
    $mealType = $request->type_of_meal;
    $date = $request->time_of_occuring;

    $menu->meal_id = $request->meal_id;
    $menu->type_of_meal = $mealType;
    if (isset($date)) {
      //check if meal exists on selected date
      $check_menu = Menu::where('type_of_meal',$mealType)->where('time_of_occuring',$date)->first();
      if($check_menu!=null)
      {
        //if meal exists -> update it
        $toUpdate = ['time_of_occuring'=>$date, 'type_of_meal'=>$mealType, 'meal_id'=>$menu->meal_id];
        $check_menu->where('id',$check_menu->id)->update($toUpdate);
        return redirect('menu/mealplanner')->with('status', ucfirst($mealType).' at '.$date.' has been updated');
      }
      else {
        //if meal doesn't exists -> create it on selected date
        $menu->time_of_occuring = $date;
        $menu->save();
        return redirect('menu/mealplanner')->with('status', ucfirst($mealType).' has been added at '.$menu->time_of_occuring);
      }
    }
    else {
      //if date is not selected, find first place to add meal
      $lastMealDate = Menu::where('type_of_meal',$mealType)->orderByDesc('time_of_occuring')->first();
      $lastMealDate = Carbon::parse($lastMealDate['time_of_occuring']);
      $menu->time_of_occuring = $lastMealDate->addDay();
      $menu->save();
      return redirect('menu/mealplanner')->with('status', ucfirst($mealType).' has been added at '.$menu->time_of_occuring->isoFormat("DD.MM.YYYY"));
    }
  }

  public function stocks()
  {
    $ingredients=Ingredients::all();

    return view('menu.menu_stocks', compact('ingredients'));
  }

  public function addStock(Request $request)
  {

    $name = ucfirst($request->name);
    $quantityOnStock = $request->quantityOnStock;
    $boxSize = $request->boxSize;
    $measureType = $request->measureType;

    //try to get data from DB to update it
    $ingredientFromDB = Ingredients::where("name",$name)->first();
    if($ingredientFromDB == null)
    {
      //request is empty, create new ingredient
      $ingredients= new Ingredients;
      $ingredients->name = $name;
      $ingredients->quantity_on_stock = $quantityOnStock;
      $ingredients->quantity_in_package = $boxSize;
      $ingredients->measure_of_package = $measureType;
      $ingredients->save();
      return redirect('menu/stocks')->with('status',$name." has been added");
    }
    else {
      //request returned value -> ingredient is in DB, update it
      $toUpdate = ["quantity_on_stock"=>$quantityOnStock, "quantity_in_package"=>$boxSize, "measure_of_package"=>$measureType];
      $ingredientFromDB->where("name",$name)->update($toUpdate);
      return redirect('menu/stocks')->with('status',$name." has been updated");
    }
  }

  public function getIngredientBoxSize(Request $request, $id)
  {
    $ingredient = Ingredients::where("id",$id)->get();
    return $ingredient[0]['quantity_in_package'];
  }

  public function deleteIngredient(Request $request, string $id)
  {
    $ingredient = Ingredients::where("id",$id)->delete();
    return "Ingredient has been destroyed";
  }

  public function mealsIngredientsDatabase()
  {
    $meals = Meals::select('id', 'name', 'final_number_of_portions', 'source')->get();
    $ingredient = Ingredients::select('name')->get();
    return view('menu.menu_meals_ingredients_database', compact('meals', 'ingredient'));
  }

  private function inArray($array, $value)
  {
    if(empty($array))
      return false;
    foreach ($array as $key => $value) {
      if($key==$value)
        return true;
    }
    return false;
  }

  public function getShoppingList($dateStart, $dateStop)
  {
    /*
    step 1 -> get all meals for selected date
    */
    $from = date($dateStart);
    $to = date($dateStop);

    //step 1a - get all meal from date
    $meals = Menu::select('meal_id')->whereBetween('time_of_occuring',[$from, $to])->get();
    $numberOfPortions = [];
    $tmp = [];
    foreach ($meals as $mealID) {
      array_push($tmp,$mealID['meal_id']);
      if(!($this->inArray($numberOfPortions,$mealID['meal_id'])))
      {
        $numberOfPortions[strval($mealID['meal_id'])]=0;
      }
    }

    //step 1b - save in array values number of requested meals
    foreach ($tmp as $value) {
      $numberOfPortions[strval($value)]+=1;
    }

    //step 1c - count number of portions to be prepared
    foreach ($numberOfPortions as $key => $value) {
      $multiplier = Meals::select('final_number_of_portions')->where('id',$key)->get();
      $numberOfPortions[$key] = ceil($value/$multiplier[0]['final_number_of_portions']);
    }

    /*
    step 2 -> get all ingredients for requested meals
    */
    $requestedIngredients = [];
    foreach ($numberOfPortions as $key => $value) {
      $connections = Connections::select('ingredient_ID', 'quantity_of_ingredient')->where('meal_ID',$key)->get();
      foreach($connections as $ingredient)
      {
        $requestedIngredients[strval($ingredient['ingredient_ID'])] = $ingredient['quantity_of_ingredient']*$value;
      }
    }

    /*
    step 3 -> search for ingredients in stocks, validate how much is requred to buy
    */
    $toBuy = [];
    $indx = 0;
    foreach ($requestedIngredients as $ingID => $amount) {
      $ingredients = Ingredients::select('name', 'quantity_in_package', 'quantity_on_stock', 'measure_of_package')->where('id',$ingID)->get();
      if($ingredients[0]['quantity_on_stock']<$amount)
      {
        $toBuy[$indx] = array("name"=>$ingredients[0]['name'],
        "packages"=>ceil(($amount-$ingredients[0]['quantity_on_stock'])/$ingredients[0]['quantity_in_package']),
        "quantity"=>$amount-$ingredients[0]['quantity_on_stock'],
        "measure"=>$ingredients[0]['measure_of_package']
      );
      $indx++;
      }
    }

    /*
    step 4 -> calculate estimated price
    */

    return $toBuy;
  }

  public function getShoppingListAsJson($dateStart, $dateStop)
  {
    $toBuy = $this->getShoppingList($dateStart,$dateStop);
    return response()->json([
        "status" => 1,
        "shopping_list" => $toBuy
    ],200);
  }

  public function menuShoppingList()
  {
    if(!isset($startDate))
    {
      $startDate = Carbon::now();
      $startDateFormat = $startDate->isoFormat("DD.MM.YYYY");
      $startDateFunctionFormat = $startDate->isoFormat("YYYY-MM-DD");
    }
    if(!isset($endDate))
    {
      $endDate = $startDate->add(7,'day');
      $endDateFormat = $endDate->isoFormat("DD.MM.YYYY");
      $endDateFunctionFormat = $endDate->isoFormat("YYYY-MM-DD");
    }
    $shoppingList = $this->getShoppingList($startDateFunctionFormat,$endDateFunctionFormat);
    return view('menu.menu_shopping_list', compact('startDateFormat','endDateFormat', 'shoppingList'));
  }

  public function addMealToDB(Request $request)
  {
    $meal = new Meals;
    $meal->final_number_of_portions = $request->number_of_portions;
    $meal->name = $request->name;
    if(isset($request->link))
    {
      $meal->source = $request->link;
    }else {
      $meal->source =  "";
    }
    $meal->for_breakfast = isset($request->breakfast)?true:false;
    $meal->for_lunch = isset($request->lunch)?true:false;
    $meal->for_dinner = isset($request->dinner)?true:false;
    $meal->for_extra_meal = isset($request->extra)?true:false;
    $meal->updated_at = Carbon::now();
    $meal->created_at = Carbon::now();
    $meal->save();
    $createdMeal = Meals::select('id')->where('name', $request->name)->first();
    return redirect('menu/mealsIngredientsDatabase')->with('status', 'Meal added with id: '.$createdMeal['id']);
  }

  public function addMealIngredientConnection(Request $request)
  {
    $validated = $request->validate([
      'meal'=>'required',
      'ingredient.*.amount'=>'required',
      'ingredient.*.name'=>'distinct'
    ],
    [
      'meal.required' => 'Nie wybrano posiłku',
      'ingredient.*.amount.required' => 'Nie podano ilości składnika',
      'ingredient.*.name' => 'Zdublowany składnik'
    ]
  );

    $mealID = (Meals::select('id')->where('name',$request->meal)->first())['id'];

    foreach ($request->ingredient as $in) {
      $ingredientID = (Ingredients::select('id')->where('name',$in['name'])->first())['id'];
      $toPut = new Connections;
      $toPut->meal_ID = $mealID;
      $toPut->ingredient_ID = $ingredientID;
      $toPut->quantity_of_ingredient = $in['amount'];
      $toPut->measure_of_ingredient = $in['measureType'];
      $toPut->created_at = Carbon::now();
      $toPut->updated_at = Carbon::now();
      $toPut->save();
    }
    return redirect('menu/mealsIngredientsDatabase')->with('status_mIC', 'Connection added!');
  }
}
