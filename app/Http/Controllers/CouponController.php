<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('admincheck');
    }
    public function index()
    {

        return view('coupon.coupon', [
            'coupon' => Coupon::orderBy('created_at', 'desc')->paginate(5)
        ]);
    }
    public function insert(Request $request)
    {
        $request->validate([
            'coupon_name' => 'unique:coupons,coupon_name',
            'coupon_discount' => 'numeric|max:99'
        ]);
        Coupon::insert($request->except('_token') + [
            'created_at' => Carbon::now()
        ]); // ek line e insert hoye jabe but (Database er column namd r input field er name same hote hobe)

        return back()->with('coupon_msg', 'Coupon Succesfully Added');
    }

    //Delete Coupon
    public function delete_coupon($coupon_id)
    {
        Coupon::find($coupon_id)->delete();
        return back()->with('coupon_del_msg',"Coupon Successfully Deleted");
    }
}
