<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

/*
Meal planner section
*/

Route::get('meals/{type}', [MealsController::class, 'getByType']);
Route::resource('meals', MealsController::class);
Route::get('menu/mealplanner', [MenuController::class, 'mealplanner']);
Route::post('menu/addMealToPlan', [MenuController::class, 'mealplannerCreate']);
Route::get('menu/stocks', [MenuController::class, 'stocks']);
Route::post('menu/addStock', [MenuController::class, 'addStock']);
Route::get('menu/getIngredientBoxSize/{id}',[MenuController::class, 'getIngredientBoxSize']);
Route::get('menu/deleteIngredient/{id}',[MenuController::class, 'deleteIngredient']);
Route::get('menu/mealsIngredientsDatabase',[MenuController::class, 'mealsIngredientsDatabase']);
Route::get('menu/menuShoppingList',[MenuController::class, 'menuShoppingList']);
Route::post('menu/addMealToDB', [MenuController::class, 'addMealToDB']);
Route::post('menu/addMealIngredientConnection', [MenuController::class, 'addMealIngredientConnection']);
Route::get('menu/addMealToDBShow', [MenuController::class, 'addMealToDBShow']);
Route::get('menu/getShoppingList',[MenuController::class, 'menuShoppingList']);
Route::get('menu/getShoppingList/{dateStart}/{dateStop}',[MenuController::class, 'getShoppingListAsJson']);
Route::resource('menu', MenuController::class);

/*
Calendar section
*/
Route::get('calendar/{yearNumber}/{monthNumber}', [CalendarController::class, 'getMonthlyEvents']);
Route::get('calendar/tripPlannerMainPage', [CalendarController::class, 'tPMainPage']);
Route::get('calendar/tmp', [CalendarController::class, 'temporaryView']);
Route::get('calendar/tripPlanner/{id}', [CalendarController::class, 'getEventWithID']);
Route::get('calendar/createNewTrip', [CalendarController::class, 'createNewTripID']);
Route::resource('calendar', CalendarController::class);
