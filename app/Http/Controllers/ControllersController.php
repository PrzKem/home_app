<?php

namespace App\Http\Controllers;

use App\Models\Controllers;
use Illuminate\Http\Request;

class ControllersController extends Controller
{
  public function index()
  {
      $controllers = Controllers::latest()->paginate(10);
      return [
          "status" => 1,
          "data" => $controllers
      ];
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
    $request->validate([
        'name' => 'required',
        'location' => 'required'
    ]);

    $controllers= Controllers::create($request->all());
    return response()->json([
        "status" => 1,
        "data" => $controllers
    ], 201);
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
          'name' => 'required',
          'location' => 'required'
      ]);

      $controllers= Controllers::create($request->all());
      return response()->json([
          "status" => 1,
          "data" => $controllers
      ], 201);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function show(Controllers $controllers, string $id)
  {
    if ($id!="")
    {
      $data = $controllers->where('id',$id)->get();
      return [
          "status" => Arr::exists($data,'id')?1:0,
          "data"=>$data
        ];
    }
    else{
      return [
          "status" => Arr::exists($controllers,'id')?1:0,
          "data" =>$controllers
      ];
    }
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function edit(Controllers $controllers,string $id)
  {
    $request->validate([
      'name' => 'required',
      'location' => 'required'
    ]);

    $controllers->update($request->query('id',$id));

    return [
        "status" => 1,
        "data" => $controllers,
        "msg" => "Data updated successfully"
    ];
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\controllers  $controllers
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Controllers $controllers,string $id)
  {
    $request->validate([
      'name' => 'required',
      'location' => 'required'
    ]);
    $input = $request->all();
    $controllers->where('id',$id)->update($input);
    $updated_reading = $controllers->where('id',$id)->get();
    return response()->json([
        "status" => 1,
        "data" => $updated_reading,
        "msg" => "Data updated successfully"
    ], 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function destroy(Controllers $controllers, string $id)
  {
      $controllers->where('id',$id)->delete();
      return response()->json(null, 204);
  }
}
