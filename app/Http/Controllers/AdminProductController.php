<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\ProductImage;
use Illuminate\Support\Str;
use Image;
class AdminProductController extends Controller
{
  public function index()
  {
    $products = Product::orderBy('id', 'desc')->get();

    return view('admin.pages.product.index')->with('products', $products);
  }

    public function create()
    {
      return view('admin.pages.product.create');
    }

  
    public function edit($id)
    {
      $products = Product::find($id);

      return view('admin.pages.product.edit')->with('products', $products);
    }

    public function store(Request $request)
    {
      $request->validate([
        'title'       => 'required|max:150',
        'description' => 'required',
        'price'       => 'required|numeric',
        'quantity'    => 'required|numeric',

      ]);

      $product = new Product;

      $product->title = $request->title;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->quantity = $request->quantity;

      $product->slug = Str::slug($request->title);
      $product->category_id = 1;
      $product->brand_id = 1;
      $product->admin_id = 1;
      $product->admin_id = 1;
      $product->save();

      // Product Image Model Insert Image
    
      // if($request->hasFile('image')){
      //   // inset image
      //   $image = $request->file('image');
      //   $img= time() . "." . $image->getClientOriginalExtension();
      //   $location = public_path('images/products/' .$img);
      //   Image::make($image)->save($location);

      //   $image = new ProductImage;
      //   $image->id = $product->id;
      //   $image->image = $img;
      //   $image->save();

      // }
      if(count($request->image) > 0) {
        foreach($request->image as $image) {
          // insert image
          // $image = $request->file('image');
          $img= time() . "." . $image->getClientOriginalExtension();
          $location = public_path('images/products/' .$img);
          Image::make($image)->save($location);

          $image = new ProductImage;
          $image->id = $product->id;
          $image->image = $img;
          $image->save();

        }
      }
    
    return redirect()->route('admin.product.create');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
          'title'       => 'required|max:150',
          'description' => 'required',
          'price'       => 'required|numeric',
          'quantity'    => 'required|numeric',

        ]);

        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        $product->slug = Str::slug($request->title);
        $product->category_id = 1;
        $product->brand_id = 1;
        $product->admin_id = 1;
        $product->admin_id = 1;
        $product->save();

      return redirect()->route('admin.products');
    }

    public function delete($id)
    {
      $product = Product::find($id);
      if(!is_null($product)) {
        $product->delete();
      }
    return back();
  }
}
