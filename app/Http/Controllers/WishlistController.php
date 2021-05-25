<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cookie;

class WishlistController extends Controller
{

    public function index()
    {
        $wishlists= wishlist::where('user_id',Auth::id())->get();
        return view('wishlist',compact('wishlists'));
    }
    public function add_wishlist($product_id)
    {
        if (Cookie::get('generate_cart_id')) {
            $generate_cart_id = Cookie::get('generate_cart_id');
        } else {
            $generate_cart_id = Str::random(20) . time();
            Cookie::queue(Cookie::make('generate_cart_id', $generate_cart_id, 10080)); //10080 = 7 day thakbe
        }
        if (wishlist::where('generate_cart_id', Cookie::get('generate_cart_id'))->where('product_id', $product_id)->exists()) {
            wishlist::where('generate_cart_id', Cookie::get('generate_cart_id'))->where('product_id', $product_id)->increment('product_quantity', 1);
        }
        else{
            wishlist::insert([
                'product_id' => $product_id,
                'generate_cart_id' => Cookie::get('generate_cart_id'),
                'user_id' => Auth::id(),
                'product_name' => Product::find($product_id)->product_name,
                'product_price' => Product::find($product_id)->product_price,
                'product_quantity' => 1,
                'product_image' => Product::find($product_id)->product_photo,
                'created_at' => Carbon::now(),
            ]);
        }
        return redirect('shop');
    }
    public function delete_wishlist($product_id){
        wishlist::where('product_id', $product_id)->delete();
        return back();
    }
}
