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
}
