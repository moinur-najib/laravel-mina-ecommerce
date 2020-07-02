<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use Image;
Use File;

class SlidersController extends Controller
{
     public function index()
    {
      $sliders = Slider::orderBy('priority', 'asc')->get();

      return view('backend.pages.sliders.index', compact('sliders'));
    }

    public function create() 
    {
      return view('backend.pages.sliders.create');
    }

  
    public function edit($id)
    {
      $slider = Slider::find($id);
      
      if(!is_null($slider)) {
        return view('backend.pages.sliders.edit')->with('slider', $slider);
      } else {
          return redirect()->route('admin.sliders');
      }
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'title'       => 'required',
        'image' => 'required|image',
        'priority' => 'required',
        'button_link' => 'nullable|url'
      ],
      [
        'title.required' => 'Please provide a slider name',
        'image.required' => 'Please provide a slider image',
        'image.image' => 'Please provide a valid slider image',
        'priority.required' => 'Please provide a priority',
        'button_link.url' => 'Please provide a slider button link'
      ]
    );

      $slider = new Slider();

      $slider->title = $request->title;
      $slider->button_text = $request->button_text;
      $slider->button_link = $request->button_link;
      $slider->priority = $request->priority;

      if($request->image > 0) {
         $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/sliders/' .$img);
            Image::make($image)->save($location);
            $slider->image = $img;
      }
      $slider->save();

    session()->flash('success', 'A new slider has been created successfully');
    return redirect()->route('admin.sliders');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
          'title'       => 'required',
          'image' => 'nullable|image',
          'priority' => 'required',
          'button_link' => 'nullable|url'
      ],
      [
          'title.required' => 'Please provide a slider name',
          'image.image' => 'Please provide a valid slider image',
          'priority.required' => 'Please provide a priority',
          'button_link.url' => 'Please provide a slider button link'
        ]
      );
  
        $slider = new Slider;

        $slider->title = $request->title;
        $slider->button_text = $request->button_text;
        $slider->button_link = $request->button_link;
        $slider->priority = $request->priority;
        
        if($request->image > 0) {
        // Delete the old Slider

        if(File::exists('images/sliders/'.$slider->image)) {
          File::delete('images/sliders/'. $slider->image);
        }
         $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/sliders/' .$img);
            Image::make($image)->save($location);
            $slider->image = $img;
      }

        $slider->save();
      session()->flash('success', 'The slider has been updated successfully');
      return redirect()->route('admin.sliders');
      }

    public function delete($id)
    {
      $slider = Slider::find($id);
      if(!is_null($slider)) {
        if(File::exists('images/sliders/'.$slider->image)) {
          File::delete('images/sliders/'. $slider->image);
        }
        $slider->delete();
      }
      session()->flash('success', 'The slider has been deleted');
      return back();
  }
}
