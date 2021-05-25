<?php

namespace App\Http\Controllers;

use App\Models\CartTable;
use App\Models\cities;
use App\Models\countries;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Order_billing_details;
use App\Models\Order_details;
use Cookie;
use App\Models\Product;
use App\Models\wishlist;
use Carbon\Carbon;
use CreateOrderBillingDetailsTable;
use Illuminate\Http\Request;
use Monolog\Handler\IFTTTHandler;
use Str;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {

        if (Cookie::get('generate_cart_id')) {
            $generate_cart_id = Cookie::get('generate_cart_id');
        } else {
            $generate_cart_id = Str::random(20) . time();
            Cookie::queue(Cookie::make('generate_cart_id', $generate_cart_id, 10080)); //10080 = 7 day thakbe
        }
        if (CartTable::where('generate_cart_id', $generate_cart_id)->where('product_id', $request->product_id)->exists()) { //Checking jodi oi product ekbar add kore thake
            // echo "already exesists";
            CartTable::where('generate_cart_id', $generate_cart_id)->where('product_id', $request->product_id)->increment('quantity', $request->quantity);
        }  else {
            // echo "nai";
            CartTable::insert([
                'generate_cart_id' => $generate_cart_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'created_at' => Carbon::now(),
            ]);
        }

        wishlist::where('product_id', $request->product_id)->delete();

        return back()->with('cart_success', 'Your Product succesfully added');
        // Cookie::queue(Cookie::make('product_id',$request->product_id,10080));
        // Cookie::queue(Cookie::make('quantity',$request->quantity,10080));
        // Cookie::queue(Cookie::make('product_price',Product::find($request->product_id)->product_price,10080));
        // Cookie::queue(Cookie::make('product_price',Product::find($request->product_id)->product_price,20));
        //    echo Cookie::get('generate_cart_id')."</br>";
        //    echo Cookie::get('product_id')."</br>";
        //    echo Cookie::get('product_price')."</br>";
        //    echo Cookie::get('quantity')."</br>";
        //    echo $request->quantity * Product::find($request->product_id)->product_price;
        //    die;


    }

    //Delete Cart items
    public function deletecart($cart_id)
    {
        CartTable::find($cart_id)->delete();
        return back();
    }

    //Cart Page

    public function cart($coupon_code = '')
    {
        //Coupon validate START
        if ($coupon_code == '') {
            $discount = 0;
            $coupun_msg = '';
        } else {
            if (Coupon::where('coupon_name', $coupon_code)->exists()) {
                $coupon_validity = Coupon::where('coupon_name', $coupon_code)->first()->coupon_validity_till;
                $current_date = Carbon::now()->format('Y-m-d');
                if ($coupon_validity > $current_date) {
                    $discount = Coupon::where('coupon_name', $coupon_code)->first()->coupon_discount;
                    $coupun_msg = '';
                } else {
                    // return back()->with('coupun_msg','Coupon Date Expierd');
                    $coupun_msg = 'Coupon Date Expierd';
                    $discount = 0;
                }
            } else {
                $discount = 0;
                // return back()->with('coupun_msg','There Is No Coupon That you Entered');
                $coupun_msg = 'There Is No Coupon That you Entered';
            }
        }
        //Coupon validate END

        $name = Cookie::get('generate_cart_id');
        $cart_items = CartTable::where('generate_cart_id', $name)->latest()->get();
        return view('cart', [
            'discount' => $discount,
            'coupon_code' => $coupon_code,
            'coupun_msg' => $coupun_msg,
            'cart_items' => $cart_items
        ]);
    }

    //Update cart Quantity

    public function updatequantity(Request $request)
    {
        // print_r($request->quantity);
        foreach ($request->quantity as $cart_id => $cart_quantity) {
            CartTable::find($cart_id)->update([
                'quantity' => $cart_quantity
            ]);
        }
        return back();
    }

    //Checkout
    public function checkout()
    {
        return view('checkout', [
            'countries' => countries::all(),
            'cities' => cities::all(),
        ]);
    }
    // Get Country to City list via Ajax Request
    public function getCityList(Request $request)
    {
        $cites = cities::where('country_id', $request->county_id)->get();
        $send_city = '<option value=""> -Select City</option>';
        foreach ($cites as $key => $city) {
            $send_city .= '<option value="' . $city->id . '">' . $city->name . '</option>';
        }
        echo $send_city;
    }

    // Order

    public function order(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'note' => 'required',
            'payment' => 'required',
        ]);
        if ($request->payment == 1 || $request->payment == 2) {
            $order_id = Order::insertGetId([
                'total' => session('subtotal'),
                'user_id' => Auth::id(),
                'discount' => session('discount'),
                'subtotal' => session('subtotal') - session('discount'),
                'payment_status' => $request->payment,
                'created_at' => Carbon::now()
            ]);
            Order_billing_details::insert([
                'order_id' => $order_id,
                'user_id' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country_id' => $request->country,
                'city_id' => $request->city,
                'address' => $request->address,
                'postcode' => $request->zipcode,
                'house_flat' => $request->house_flat,
                'note' => $request->note,
                'created_at' => Carbon::now()
            ]);
            $cart_items = CartTable::where('generate_cart_id', Cookie::get('generate_cart_id'))->get();
            foreach ($cart_items as $key => $cart_item) {
                Order_details::insert([
                    'user_id' => Auth::id(),
                    'order_id' => $order_id,
                    'product_name' => Product::find($cart_item->product_id)->product_name,
                    'product_price' => Product::find($cart_item->product_id)->product_price,
                    'product_quantity' => $cart_item->quantity,
                    'created_at' => Carbon::now()
                ]);
            }
            if ($request->payment == 1) {
                CartTable::where('generate_cart_id', Cookie::get('generate_cart_id'))->delete();
                return redirect('cart');
            } else {
                CartTable::where('generate_cart_id', Cookie::get('generate_cart_id'))->delete();
                return redirect('online/payment');
            }
        } else {
            echo "This Payment Type not Available";
        }
    }
}
