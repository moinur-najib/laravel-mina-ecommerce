<?php

namespace App\Http\Controllers\Backend;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\ProductImage;
use Image;
class ProductController extends Controller
{

  public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
  public function index()
  {
    $products = Product::orderBy('id', 'desc')->get();

    return view('backend.pages.product.index', compact('products'));
  }

    public function create()
    {
      return view('backend.pages.product.create');
    }

  
    public function edit($id)
    {
      $products = Product::find($id);

      return view('backend.pages.product.edit')->with('products', $products);
    }

    public function store(Request $request)
    {
      $request->validate([
        'title'       => 'required|max:150',
        'description' => 'required',
        'price'       => 'required|numeric',
        'quantity'    => 'required|numeric',
        'category_id'    => 'required|numeric',
        'brand_id'    => 'required|numeric',

      ]);

      $product = new Product;

      $product->title = $request->title;
      $product->description = $request->description;
      $product->price = $request->price;
      $product->quantity = $request->quantity;

      $product->slug = Str::slug($request->title);
      $product->category_id = $request->category_id;
      $product->brand_id = $request->brand_id;
      $product->admin_id = 1;
      $product->save();

      // Product Image Model Insert Image
    
      // if($request->hasFile('image')) {
      //   $image = $request->file('image');
      //   $img = time() . '.' . $image->getClientOriginalExtension();
      //   $location = public_path('images/categories/' .$img);
      //   Image::make($image)->save($location);
      //   $category->image = $img;
      //   $category->save();
      // }

      if(count($request->product_image) > 0) {
        foreach($request->product_image as $image) {
          // insert image
          // $image = $request->file('product_image');
          $img = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/products/' .$img);
          Image::make($image)->save($location);

          $product_image = new ProductImage;
          $product_image->product_id = $product->id;
          $product_image->image = $img;
          $product_image->save();
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
          'category_id'    => 'required|numeric',
          'brand_id'    => 'required|numeric',
        ]);

        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        $product->slug = Str::slug($request->title);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->admin_id = 1;
        $product->save();

      return redirect()->route('backend.products');
    }

    public function delete($id)
    {
      $product = Product::find($id);
      if(!is_null($product)) {
        $product->delete();
      }
      session()->flash('success', 'The product has been deleted');
      return back();
  }
}
