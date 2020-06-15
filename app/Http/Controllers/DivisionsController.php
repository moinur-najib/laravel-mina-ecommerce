<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Divisions;

class DivisionsController extends Controller
{
    public function index()
    {
      $divisions = Divisions::orderBy('priority', 'asc')->get();

      return view('backend.pages.division.index', compact('divisions'));
    }

    public function create() 
    {
      return view('backend.pages.division.create');
    }

  
    public function edit($id)
    {
      $division = Divisions::find($id);
      
      if(!is_null($division)) {
        return view('backend.pages.division.edit')->with('division', $division);
      } else {
          return redirect()->route('admin.division');
      }
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'name'       => 'required',
        'priority' => 'required',
      ],
      [
        'name.required' => 'Please provide a division name',
        'priority.required' => 'Please provide a division priority',
      ]
    );

      $division = new Divisions();

      $division->name = $request->name;
      $division->priority = $request->priority;
      $division->save();

    session()->flash('success', 'A new division has been updated successfully');
    return redirect()->route('admin.division.create');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'name'       => 'required',
          'priority' => 'required'
        ],
        [
            'name.required' => 'Please provide a division name',
            'priority.required' => 'Please provide a division priority'
        ]
      );
  
        $division = new Divisions;
  
        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();
  
      session()->flash('success', 'The division has been updated successfully');
      return redirect()->route('admin.division.create');
      }

    public function delete($id)
    {
      $division = Divisions::find($id);
      if(!is_null($division)) {
        $division->delete();
      }
      session()->flash('success', 'The division has been deleted');
      return back();
  }
}
