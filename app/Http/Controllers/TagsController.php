<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IoTTags;

class TagsController extends Controller
{
  public function index()
  {
      $controllers = TagsController::latest()->paginate(10);
      return [
          "status" => 1,
          "data" => $controllers
      ];
  }

  public function show(IoTTags $controllers, string $id)
  {
    if ($id!="")
    {
      $data = $controllers->where('id',$id)->get();
      return $data[0]['value'];
    }
    else{
      return [
          "status" => Arr::exists($controllers,'id')?1:0,
          "data" =>$controllers
      ];
    }
  }

  public function edit(IoTTags $tag)
  {
    $request->validate([
      'value' => 'required',
      'id' => 'required'
    ]);

    $tag->update($request->query('id',$request['id']), ['timestamps' => false]);

    return [
        "status" => 1,
        "data" => $tag,
        "msg" => "Data updated successfully"
    ];
  }

  public function update(Request $request, IoTTags $tag)
  {
    $request->validate([
      'value' => 'required',
      'id' => 'required'
    ]);
    $input = $request->all();
    //$tag->where('id',$input['id'])->update(['value' => $input['value'], 'timestamps' => false]);
    $tag = IoTTags::find($input['id']);
    $tag->value = $input['value'];
    $tag->timestamps=false;
    $tag->save();

    $updated_tag = $tag->where('id',$request['id'])->get();
    return response()->json([
        "status" => 1,
        "data" => $updated_tag,
        "msg" => "Data updated successfully"
    ], 200);
  }

  public function store(Request $request, IoTTags $tag)
  {
    return $this->update($request, $tag);
  }

}
