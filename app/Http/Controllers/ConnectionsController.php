<?php

namespace App\Http\Controllers;

use App\Models\Connections;
use Illuminate\Http\Request;

class ConnectionsController extends Controller
{
  public function index()
  {
      $connections = Connections::all();
      return response()->json([
          "status" => 1,
          "data" => $connections
      ],200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $request->validate([
      'meal_ID' => 'required',
      'ingredient_ID' => 'required',
      'quantity_of_ingredient' => 'required',
      'measure_of_ingredient' => 'required'
    ]);

    $connections= Connections::create($request->all());
    return response()->json([
        "status" => 1,
        "data" => $connections
    ],201);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      $request->validate([
        'meal_ID' => 'required',
        'ingredient_ID' => 'required',
        'quantity_of_ingredient' => 'required',
        'measure_of_ingredient' => 'required'
      ]);

      $connections= Connections::create($request->all());
      return response()->json([
          "status" => Arr::exists($connections,'ingredient_ID')?1:0,
          "data" => $connections
      ],Arr::exists($connections,'ingredient_ID')?201:206);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function show(Connections $connections, string $id)
  {
    if ($id!="")
    {
      $data = $connections->where('ingredient_ID',$id)->get();
      return [
          "status" => Arr::exists($data,'ingredient_ID')?1:0,
          "data"=>$data
        ];
    }
    else{
      return [
          "status" => Arr::exists($connections,'ingredient_ID')?1:0,
          "data" =>$connections
      ];
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function showConnectedToMeal(Connections $connections, string $id)
  {
    $data = $connections->where('meal_ID',$id)->get();
    return [
      //"status" => Arr::exists($data,'meal_ID')?1:0,
      "status" => count($data)>0?1:0,
      "data"=> $data
    ];
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function showConnectedToIngredient(Connections $connections, string $id)
  {
    $data = $connections->where('ingredient_ID',$id)->get();
    return [
      "status" => count($data)>0?1:0,
      "data"=> $data
    ];
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function edit(Connections $connections,string $meal_id, string $ingredient_id)
  {
    $request->validate([
      'meal_ID' => 'required',
      'ingredient_ID' => 'required',
      'quantity_of_ingredient' => 'required',
      'measure_of_ingredient' => 'required'
    ]);

    $connections->update($request->where('meal_ID',$meal_id)->where('ingredient_ID', $ingredient_id));

    return response()->json([
        "status" => 1,
        "data" => $connections,
        "msg" => "Data updated successfully"
    ],202);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\connections  $connections
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Connections $connections, string $ingredient_id, string $meal_id)
  {
    $request->validate([
      'meal_ID' => 'required',
      'ingredient_ID' => 'required',
      'quantity_of_ingredient' => 'required',
      'measure_of_ingredient' => 'required'
    ]);
    $input = $request->all();
    $connections->where('meal_ID',$meal_id)->where('ingredient_ID', $ingredient_id)->update($input);
    $updated_reading = $connections->where('meal_ID',$meal_id)->where('ingredient_ID', $ingredient_id)->get();

    return response()->json([
        "status" => count($updated_reading)>0?1:0,
        "data" => $updated_reading,
        "msg" => count($updated_reading)>0?"Data updated successfully":"Cannot update"
    ],count($updated_reading)>0?202:206);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function destroy(Connections $connections, string $ingredient_id, string $meal_id)
  {
      $connections->where('ingredient_ID',$ingredient_id)->where('meal_ID',$meal_id)->delete();
      return response()->json(null, 204);
  }
}
