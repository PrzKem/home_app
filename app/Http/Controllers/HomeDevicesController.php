<?php

namespace App\Http\Controllers;
use App\Models\Controllers;
use App\Models\Sensors;
use App\Models\IoTTags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
      $sensors = Sensors::get()->groupBy('controller_id');
      return view($this->directoryPath.'.controllers', compact('ctrl', 'deadline', 'sensors'));
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
      $sensors = Sensors::orderBy('id','asc')->get(['id', 'description']);
      return view($this->directoryPath.'.charts', compact('sensors'));
    }

    public function addControllerForm()
    {
      return view($this->directoryPath.'.addControllerForm');
    }

    public function addController(Request $request)
    {
      $controller = new Controllers;
      $controller->name = $request->name;
      $controller->location = $request->location;
      $controller->actual_work_mode = $request->workmode;
      $controller->save();
      return redirect("hd/controllers")->with('status', 'Controller has been added');
    }

    public function addSensorForm()
    {
      $controllers = Controllers::get('id');
      return view($this->directoryPath.'.addSensorForm', compact('controllers'));
    }

    public function addSensor(Request $request)
    {
      $sensor = new Sensors;
      $sensor->controller_id = $request->controller_id;
      $sensor->measurement_unit = $request->measurement_unit;
      $sensor->description = $request->description;
      $sensor->last_read_value = 0.0;
      $sensor->save();
      return redirect("hd/sensors")->with('status', 'Sensor has been added');
    }
}
