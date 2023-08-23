<?php

namespace App\Http\Controllers;

use App\Models\Sensors;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SensorsController extends Controller
{
  public function index()
  {
      $sensors = Sensors::latest()->paginate(10);
      return [
          "status" => 1,
          "data" => $sensors
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
        'controller_id' => 'required',
        'measurement_unit' => 'required'
    ]);

    $sensors= Sensors::create($request->all());
    return [
        "status" => 1,
        "data" => $sensors
    ];
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
        'controller_id' => 'required',
        'measurement_unit' => 'required'
      ]);

      $sensors= Sensors::create($request->all());
      return [
          "status" => 1,
          "data" => $sensors
      ];
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function show(Sensors $sensors, string $id)
  {
    if ($id!="")
    {
      $data = $sensors->where('id',$id)->get();
      return [
          "status" => Arr::exists($data,'id')?1:0,
          "data"=>$data
        ];
    }
    else{
      return [
          "status" => Arr::exists($sensors,'id')?1:0,
          "data" =>$sensors->get()
      ];
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function showConnectedToController(Sensors $sensors, string $id)
  {
    if ($id!="")
    {
      return [
          "status" => 1,
          "data"=>$sensors->where('controller_id',$id)->get()
        ];
    }
    else{
      return [
          "status" => 1,
          "data" =>$sensors
      ];
    }
  }


  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function edit(Sensors $sensors,string $id)
  {
    $request->validate([
      'controller_id' => 'required',
      'measurement_unit' => 'required'
    ]);

    $sensors->update($request->query('id',$id));

    return [
        "status" => 1,
        "data" => $sensors,
        "msg" => "Data updated successfully"
    ];
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\sensors  $sensors
   * @param  string  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Sensors $sensors,string $id)
  {
    $request->validate([
      'controller_id' => 'required',
      'measurement_unit' => 'required'
    ]);
    $input = $request->all();
    $sensors->where('id',$id)->update($input);
    $updated_reading = $sensors->where('id',$id)->get();
    return [
        "status" => 1,
        "data" => $updated_reading,
        "msg" => "Data updated successfully"
    ];
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Blog  $blog
   * @return \Illuminate\Http\Response
   */
  public function destroy(Sensors $sensors, string $id)
  {
      $sensors->where('id',$id)->delete();
      return [
          "status" => 1,
          "data" => $sensors,
          "msg" => "Value deleted successfully"
      ];
  }
}
