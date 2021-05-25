<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\product_tumbnail_photo;
use App\Models\SubCategory;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('admincheck');
    }
    public function Product()
    {

        return view('product.Product', [
            'products' => Product::orderBy('created_at','desc')->paginate(5),
            'categories' => Category::all(),
            'sub_categories' => SubCategory::all(),
            'Deleted_Product' => Product::orderBy('deleted_at', 'desc')->onlyTrashed()->get()
        ]);
    }
    //Insert
    public function insert(Request $request)
    {


        $request->validate([
            'cat_id' => 'required',
            'subcat_id' => 'required',
            'product_name' => 'required',
            'product_details' => 'required',
            'thumbnails_photos'=>'required'
        ]);
        $product_id =  Product::insertGetId([  // last je id te insert hoyeche seit id dibe
            'cat_id' => $request->cat_id,
            'user_id' => Auth::id(),
            'subcat_id' => $request->subcat_id,
            'product_name' => $request->product_name,
            'product_details' => $request->product_details,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'created_at' => Carbon::now()
        ]);
        $request->validate([
            'product_photo' => 'required | mimes:jpg,bmp,png,svg,gif'
        ]);
        $new_product_photo = $request->file('product_photo'); //Fetch the photo tem file
        $extention = $new_product_photo->getClientOriginalExtension(); //Get Extention jpg

        $new_photo_name = $product_id . "-" . str_replace(" ", "-", $request->product_name) . "." . $extention; // New Name
        // echo $new_photo_name;
        Image::make($new_product_photo)->save(base_path('public/uploads/product_photos/' . $new_photo_name));
        Product::where('id', $product_id)->update([
            'product_photo' => $new_photo_name
        ]);
        $start= 1;
      foreach ($request->file('thumbnails_photos') as  $single_thumbnails) {
        //  echo $single_thumbnails."<br>";
         $single_tubmbnails_product_photo_name= $product_id."-".$start++.".".$single_thumbnails->getClientOriginalExtension();
        //  echo $single_tubmbnails_product_photo . "<br>";
        Image::make($single_thumbnails)->save(base_path('public/uploads/tumb_product/' . $single_tubmbnails_product_photo_name));
         product_tumbnail_photo::insert([
            'product_id'=>$product_id,
            'thumbnails_photos_name'=>$single_tubmbnails_product_photo_name,
            'created_at'=>Carbon::now()
         ]);

      }
        return back()->with('status', 'Product uploaded Successfully');
    }
    //Soft Delete Product
    public function softdelete($delId)
    {
        Product::find($delId)->delete();
        return back()->with('delstatus', 'Product Succesfully Deleted');
    }
}
