<?php

namespace App\Http\Controllers;

use App\Models\Readings;
use Illuminate\Http\Request;

class ReadingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readings = Readings::latest()->paginate(10);
        return [
            "status" => 1,
            "data" => $readings
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
          'sensor_id' => 'required',
          'reading_value' => 'required'
      ]);

      $readings= Readings::create($request->all());
      return response()->json([
          "status" => 1,
          "data" => $readings
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
            'sensor_id' => 'required',
            'reading_value' => 'required'
        ]);

        $readings= Readings::create($request->all());
        return response()->json([
            "status" => 1,
            "data" => $readings
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Readings $readings, string $id)
    {
      if ($id!="")
      {
        return response()->json([
            "status" => 1,
            "data"=>$readings->where('id',$id)->get()
          ],200);
      }
      else{
        return response()->json([
            "status" => 1,
            "data" =>$readings
        ],200);
      }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Readings $readings,string $id)
    {
      $request->validate([
          'sensor_id' => 'required',
          'reading_value' => 'required'
      ]);

      $readings->update($request->query('id',$id));

      return response()->json([
          "status" => 1,
          "data" => $readings,
          "msg" => "Data updated successfully"
      ],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Readings  $readings
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Readings $readings,string $id)
    {
      $request->validate([
          'sensor_id' => 'required',
          'reading_value' => 'required'
      ]);
      $input = $request->all();
      $readings->where('id',$id)->update($input);
      $updated_reading = $readings->where('id',$id)->get();
      return response()->json([
          "status" => 1,
          "data" => $updated_reading,
          "msg" => "Data updated successfully"
      ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Readings $readings, string $id)
    {
        $readings->where('id',$id)->delete();
        return response()->json(null,204);
    }
}
