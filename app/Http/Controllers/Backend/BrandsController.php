<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Image;

class BrandsController extends Controller
{
    public function index() 
    {
        $brands = Brand::orderBy('id', 'desc')->get();
        return view('backend.pages.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('backend.pages.brands.create');
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'image' => 'nullable|image',
        ],
        [
            'name.required' =>'Please provide a brand name',
            'image.image' => 'Please provide a jpg / png image'
        ]);

        $brand = new brand();
        $brand->name = $request->name;
        $brand->description = $request->description;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/brands/' .$img);
            Image::make($image)->save($location);
            $brand->image = $img;
            $brand->save();
          }

        $brand->save();
        
        session()->flash('success', 'A new brand has been succesfully added');
        return redirect()->route('admin.brands');
    }

    public function delete($id)
    {
      $brand = brand::find($id);
      if(!is_null($brand)) {
        
        // Delete brands img
        if(File::exists('images/brands/' .$brand->image)) {
            File::delete('images/brands/' .$brand->image);
        }
        $brand->delete();
      }
      session()->flash('success', 'The brand has been deleted');
      return back();
  }

  public function edit($id)
  {
      $brand = Brand::find($id);
      if(!is_null($brand)) {
          return view('backend.pages.brands.edit', compact('brand'));
      } else {
          return redirect()->route('admin.brands');
      }
  }

  public function update(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'image' => 'nullable|image',
        ],
        [
            'name.required' =>'Please provide a brand name',
            'image.image' => 'Please provide a jpg / png image'
        ]);

        $brand = brand::Find($request->id);
        $brand->name = $request->name;
        $brand->description = $request->description;

        if($request->hasFile('image')) {
            // Delete the old image

            if(File::exists('images/brands/' .$brand->image)) {
                File::delete('images/brands/' .$brand->image);
            }
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/brands/' .$img);
            Image::make($image)->save($location);
            $brand->image = $img;
            $brand->save();
          }

        $brand->save();
        
        session()->flash('success', 'A new brand has been succesfully added');
        return redirect()->route('admin.brands');
    }
}
