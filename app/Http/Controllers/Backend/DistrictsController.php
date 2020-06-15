<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Divisions;

class DistrictsController extends Controller
{
    public function index()
    {
      $districts = District::orderBy('name', 'asc')->get();

      return view('backend.pages.districts.index', compact('districts'));
    }

    public function create() 
    {
      $divisions = Divisions::orderBy('priority', 'asc')->get();
      return view('backend.pages.districts.create', compact("divisions"));
    }

  
    public function edit($id)
    {
      $divisions = Divisions::orderBy('priority', 'asc')->get();
      $district = District::find($id);
      
      if(!is_null($district)) {
        return view('backend.pages.districts.edit', compact('district', 'divisions'));
      } else {
          return redirect()->route('admin.districts');
      }
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name'       => 'required',
        'division_id' => 'required',
      ],
      [
        'name.required' => 'Please provide a district name',
        'division_id.required' => 'Please provide a division id',
      ]
    );

      $district = new District();

      $district->name = $request->name;
      $district->division_id = $request->division_id;
      $district->save();

    session()->flash('success', 'A new district has been created successfully');
    return redirect()->route('admin.district.create');
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'name'       => 'required',
        'division_id' => 'required',
      ],
      [
        'name.required' => 'Please provide a district name',
        'division_id.required' => 'Please provide a division id',
      ]
    );
  
        $district = District::Find($id);
  
        $district->name = $request->name;
        $district->division_id = $request->division_id;
        $district->save();
  
      session()->flash('success', 'The district has been updated successfully');
      return redirect()->route('admin.districts');
      }

    public function delete($id)
    {
      $division = Divisions::find($id);
      if(!is_null($division)) {
        // Delete all the districts for this division
        $districts = District::where('division_id', $division->id)->get();
        foreach ($districts as $district) {
          $district->delete();
        }
        $division->delete();
      }
      session()->flash('success', 'The district has been deleted');
      return back();
  }
}
