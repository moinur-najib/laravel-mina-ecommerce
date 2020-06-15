<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Image;
use File;

class CategoriesController extends Controller
{
    public function index() 
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('backend.pages.categories.index', compact('categories'));
    }

    public function create()
    {
        $main_categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
        
        return view('backend.pages.categories.create', compact('main_categories'));
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'image' => 'nullable|image',
        ],
        [
            'name.required' =>'Please provide a category name',
            'image.image' => 'Please provide a jpg / png image'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        if($request->hasFile('image')) {
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/categories/' .$img);
            Image::make($image)->save($location);
            $category->image = $img;
            $category->save();
          }

        $category->save();
        
        session()->flash('success', 'A new category has been succesfully added');
        return redirect()->route('admin.categories');
    }

    public function delete($id)
    {
      $category = Category::find($id);
      if(!is_null($category)) {
        // if it is primary category, then delete all 

        if ($category->parent_id == NULL) {
            //Delete sub cat
            $sub_category = Category::orderBy('name', 'desc')->where('parent_id', $category->id)->get();
           
            foreach ($sub_category as $sub) {
                if(File::exists('images/categories/' .$sub->image)) {
                    File::delete('images/categories/' .$sub->image);
                }
               $sub->delete();
            }
        }

        // Delete cat img
        if(File::exists('images/categories/' .$category->image)) {
            File::delete('images/categories/' .$category->image);
        }
        $category->delete();
      }
      session()->flash('success', 'The category has been deleted');
      return back();
  }

  public function edit($id)
  {
        $main_categories = Category::orderBy('name', 'desc')->where('parent_id', NULL)->get();
      $category = Category::find($id);
      if(!is_null($category)) {
          return view('backend.pages.categories.edit', compact('category', 'main_categories'));
      } else {
          return redirect()->route('admin.categories');
      }
  }

  public function update(Request $request)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'image' => 'nullable|image',
        ],
        [
            'name.required' =>'Please provide a category name',
            'image.image' => 'Please provide a jpg / png image'
        ]);

        $category = Category::Find($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;

        if($request->hasFile('image')) {
            // Delete the old image

            if(File::exists('images/categories/' .$category->image)) {
                File::delete('images/categories/' .$category->image);
            }
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/categories/' .$img);
            Image::make($image)->save($location);
            $category->image = $img;
            $category->save();
          }

        $category->save();
        
        session()->flash('success', 'A new category has been succesfully added');
        return redirect()->route('admin.categories');
    }

}
