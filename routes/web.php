<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeDevicesController;

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



Route::group(['namespace' => 'App\Http\Controllers'], function()
{
    /**
     * Home Routes
     */
     Route::get('/', function () {
         return view('index');
     });



    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');

        Route::get('index', function () {
            return view('index');
        });

    });

    Route::group(['middleware' => ['auth']], function() {

        /*
        Budget section
        */

        /*
        Menu section
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
        Events section
        */
        Route::get('calendar/{yearNumber}/{monthNumber}', [CalendarController::class, 'getMonthlyEvents']);
        Route::get('calendar/tripPlannerMainPage', [CalendarController::class, 'tPMainPage']);
        Route::get('calendar/tmp', [CalendarController::class, 'temporaryView']);
        Route::get('calendar/tripPlanner/{id}', [CalendarController::class, 'getEventWithID']);
        Route::get('calendar/createNewTrip', [CalendarController::class, 'createNewTripID']);
        Route::resource('calendar', CalendarController::class);

        /*
        Home devices section
        */
        Route::get('hd/tags', [HomeDevicesController::class, 'getTags']);
        Route::get('hd/sensors', [HomeDevicesController::class, 'getSensors']);
        Route::get('hd/controllers', [HomeDevicesController::class, 'getControllers']);
        Route::post('hd/addController', [HomeDevicesController::class, 'addController']);
        Route::get('hd/addController', [HomeDevicesController::class, 'addControllerForm']);    
        Route::post('hd/addSensor', [HomeDevicesController::class, 'addSensor']);
        Route::get('hd/addSensor', [HomeDevicesController::class, 'addSensorForm']);
        Route::post('hd/addTag', [HomeDevicesController::class, 'addTag']);
        Route::get('hd/charts', [HomeDevicesController::class, 'getCharts']);
        Route::resource('hd', HomeDevicesController::class);
        /*
        Settings section
        */

        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');


    });
});
