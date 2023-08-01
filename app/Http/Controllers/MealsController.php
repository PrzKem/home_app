<?php

namespace App\Http\Controllers;
use App\Models\Meals;
use Illuminate\Http\Request;

class MealsController extends Controller
{
    //
    public function index()
    {
      $meals = Meals::orderBy('id', 'desc')->paginate(5);
      return view('meals.index', compact('meals'));
    }

    public function create()
    {
      return view('meals.create');
    }

    public function store(Request $request)
    {
      $request->validate([
        'final_number_of_portions'=> 'required',
        'type_of_meal'=> 'required',
        'name'=> 'required'
      ]);

      Meals::create($request->post());
      return redirect()->route('meals.index')->with('success','Meal has been added.');
    }

    public function show(Meals $meals)
    {
      return view('meals.show', compact('meals'));
    }

    public function edit(Meals $meals)
    {
      return view('meals.edit',compact('meals'));
    }

    public function update(Request $request, Meals $meals)
    {
      $request->validate([
        'final_number_of_portions'=> 'required',
        'type_of_meal'=> 'required',
        'name'=> 'required',
        'source'=> 'required'
      ]);

      $meals->fill($request->post())->save();
      return redirect()->route('meals.index')->with('success', 'Meal has been updated.');
    }

    public function destroy(Meals $meals)
    {
      $meals->delete();
      return redirect()->route('meals.index')->with('success','Meal has been deleted.');
    }

    public function getByType(string $type)
    {
      $result = [];
      if ($type=="extra") {
        $resultTmp = Meals::select('id', 'name')->where('for_'.$type.'_meal', 1)->get();
      } else {
        $resultTmp = Meals::select('id', 'name')->where('for_'.$type, 1)->get();
      }

      return response()->json($resultTmp);
    }
}
