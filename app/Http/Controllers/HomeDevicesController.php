<?php

namespace App\Http\Controllers;
use App\Models\Controllers;
use App\Models\Sensors;
use App\Models\IoTTags;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeDevicesController extends Controller
{
  private $directoryPath = 'homeDevices';
  private $refreshTime = 5000;

  public function index()
  {
    return view($this->directoryPath.'.dashboard');
  }

    public function getControllers()
    {
      $ctrl = Controllers::orderBy('id', 'desc')->get();
      $deadline = Carbon::now()->subHour();
      return view($this->directoryPath.'.controllers', compact('ctrl', 'deadline'));
    }

    public function getTags()
    {
      $tags = IoTTags::all();
      return view($this->directoryPath.'.tags', compact('tags'));
    }

    public function addTag(Request $request)
    {
      $alias = $request->alias;
      $value = $request->value;
      $tag = new IoTTags;
      $tag->value = $value;
      $tag->alias = $alias;
      $tag->timestamps = false;
      $tag->save();
      return redirect('hd/tags')->with('status',"Tag has been added");
    }

    public function getSensors()
    {
      $time = $this->refreshTime;
      return view($this->directoryPath.'.sensors', compact('time'));
    }

    public function getCharts()
    {
      $sensors = Sensors::get(['id']);
      return view($this->directoryPath.'.charts', compact('sensors'));
    }
}
